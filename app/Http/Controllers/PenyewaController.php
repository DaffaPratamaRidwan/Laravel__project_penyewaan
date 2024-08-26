<?php

namespace App\Http\Controllers;

use App\Models\AlatBerat;
use App\Models\Sewa;
use App\Models\SewaDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Google\Client as Google_Client;
use Google\Service\Drive as Google_Service_Drive;
use Google\Service\Drive\DriveFile as Google_Service_Drive_DriveFile;


class PenyewaController extends Controller
{
    public function companyProfile()
    {
        return view('penyewa.companyProfile');
    }

    public function penyewaDashboard()
    {
        $alatBerats = AlatBerat::all();

        // notify()->success('asikkk!!!!!');
        return view('penyewa.dashboard', compact('alatBerats'));
    }

    public function show($id)
    {
        $alatBerat = AlatBerat::findOrFail($id);
        return view('penyewa.show', compact('alatBerat'));
    }

    // fitur sewa
    public function sewaForm()
    {
        $alatBerats = AlatBerat::all();
        return view('penyewa.sewa', compact('alatBerats'));
    }
    
    public function sewaStore(Request $request)
    {
        $request->validate([
            // 'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'npwp' => 'required|string|max:255',
            'no_telp' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
            // 'bukti_bayar' => null,
            'alat_berat' => 'required|array',
            'alat_berat.*' => [
                'required',
                'integer',
                'exists:alat_berat,id',
                function ($attribute, $value, $fail) use ($request) {
                    $alat_berat = AlatBerat::find($value);
                    $index = (int)str_replace('alat_berat.', '', $attribute);
                    $requestedQuantity = $request->jumlah[$index];
                    
                    if ($alat_berat->stok < $requestedQuantity) {
                        notify()->error('Stok tidak mencukupi untuk disewakan.');
                        $fail("Stok {$alat_berat->nama} tidak mencukupi untuk disewakan.");
                    }
                },
            ],
            'jumlah.*' => 'required|integer|min:1',
        ]);

        // Check if there was an error related to stock
        if ($errors = $request->session()->get('errors')) {
            $errorMessages = $errors->all();
            foreach ($errorMessages as $message) {
                if (strpos($message, 'Stok') !== false) {
                    return redirect()->back()->with('stock_error', $message);
                }
            }
        }

        // if ($request->hasFile('bukti_bayar')) {
        //     $file = $request->file('bukti_bayar');
        //     $filePath = $file->getRealPath();
        //     $fileName = $file->getClientOriginalName();

        //     $disk = Storage::disk('google');
        //     $stream = fopen($filePath, 'r+');
        //     $disk->writeStream($fileName, $stream);
        // }
    
        $tanggal_awal = Carbon::parse($request->tanggal_awal);
        $tanggal_akhir = Carbon::parse($request->tanggal_akhir);
        $hari_sewa = $tanggal_awal->diffInDays($tanggal_akhir) + 1;
    
        if ($hari_sewa < 3) {
            return redirect()->back()->with('warning', 'Minimal sewa 3 hari.');
        }
    
        $sewa = Sewa::create([
            'user_id' => auth()->id(),
            'nama_perusahaan' =>  auth()->user()->nama_perusahaan,
            'alamat' => $request->alamat,
            'npwp' => $request->npwp,
            'no_telp' => $request->no_telp,
            'keterangan' => $request->keterangan,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            // 'bukti_bayar' => $request->bukti_bayar,
            'disetujui' => false,
            'pengembalian' => false,
        ]);
    
        foreach ($request->alat_berat as $index => $alat_berat_id) {
            $alatBerat = AlatBerat::find($alat_berat_id);
            $jumlah = $request->jumlah[$index];

            SewaDetail::create([
                'sewa_id' => $sewa->id,
                'alat_berat_id' => $alat_berat_id,
                'jumlah' => $jumlah,
            ]);

            // Pengurangan stok untuk setiap detail penyewaan
            $alatBerat->stok -= $jumlah;
            $alatBerat->save();
        }
    
        return redirect()->route('penyewa.sewa.payment', $sewa->id);
    }

    public function paymentForm($id)
    {
        $sewa = Sewa::findOrFail($id);
        $expiredAt = $sewa->created_at->addHours(2);

        if (now()->gt($expiredAt)) {
            // Redirect to home if the 2-hour window has passed
            $sewa->delete(); // Optionally delete the Sewa record
            notify()->error('Waktu pembayaran telah habis, penyewaan dibatalkan');
            return redirect()->route('home')->with('error', 'Waktu pembayaran telah habis, penyewaan dibatalkan.');
        }

        $tanggalAwal = Carbon::parse($sewa->tanggal_awal);
        $tanggalAkhir = Carbon::parse($sewa->tanggal_akhir);

        $totalHarga = $sewa->sewaDetail->sum(function ($detail) use ($tanggalAwal, $tanggalAkhir) {
            return $detail->alatBerat->harga_sewa * $detail->jumlah * (($tanggalAwal->diffInDays($tanggalAkhir)) + 1);
        });

        $totalHargaFormatted = number_format($totalHarga, 0, ',', '.');

        return view('penyewa.payment', compact('sewa', 'expiredAt', 'totalHargaFormatted'));
    }

    public function cancelSewa($id)
    {
        // System.out.println($id);
        $sewa = Sewa::findOrFail($id);

        foreach ($sewa->sewaDetail as $detail) {
            $detail->alatBerat->stok += $detail->jumlah;
            $detail->alatBerat->save();
        }

        $sewa->delete(); // Hapus data penyewaan yang dibatalkan

        notify()->error('Penyewaan dibatalkan');
        return redirect()->route('penyewa.dashboard')->with('success', 'Penyewaan dibatalkan.');
    }

    public function paymentStore(Request $request, $id)
    {
        $request->validate([
            'bukti_bayar' => 'required|file|mimes:jpeg,png,jpg|max:2048',
        ]);
        $sewa = Sewa::findOrFail($id);

        if ($request->hasFile('bukti_bayar')) {
            $file = $request->file('bukti_bayar');
            $filePath = $file->getRealPath();
            $fileName = $file->getClientOriginalName();

            $disk = Storage::disk('google');
            $stream = fopen($filePath, 'r+');
            $disk->writeStream($fileName, $stream);

            // $sewa->bukti_bayar = $fileName;

            // Get the file URL from Google Drive
            $client = new Google_Client();
            $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
            $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
            $client->refreshToken(env('GOOGLE_DRIVE_REFRESH_TOKEN'));
    
            // Create the Drive service
            $service = new Google_Service_Drive($client);
    
            // Create a file metadata instance
            $fileMetadata = new Google_Service_Drive_DriveFile(['name' => $fileName]);
    
            // Upload the file to Google Drive
            $file = $service->files->create($fileMetadata, [
                'data' => file_get_contents($filePath),
                'mimeType' => $file->getMimeType(),
                'uploadType' => 'multipart'
            ]);
    
            // Generate the URL
            $fileUrl = "https://drive.google.com/uc?id=" . $file->id;
    
            // Set file permissions to public
            $permission = new \Google\Service\Drive\Permission();
            $permission->setType('anyone');
            $permission->setRole('reader');
            $service->permissions->create($file->id, $permission);
    
            // Save the file URL in the database
            $sewa->bukti_bayar = $fileUrl;
        }

        $sewa->disetujui = false;
        $sewa->save();

        notify()->success('Penyewaan berhasil, menunggu persetujuan admin');
        return redirect()->route('penyewa.dashboard')->with('success', 'Penyewaan berhasil, menunggu persetujuan admin.');
    }

    public function detailSewa($id)
    {
        $sewa = Sewa::with('sewaDetail.alatBerat')->findOrFail($id);
        return response()->json($sewa);
    }

    public function sewaAktif()
    {
        $userId = auth()->user()->id;
        $sewa = Sewa::where('user_id', $userId)
                    ->get();
        return view('penyewa.sewaAktif', compact('sewa'));
    }

    public function pengembalianForm()
    {
        $userId = auth()->user()->id;
        $sewa = Sewa::where('disetujui_sewa', true)
                    ->where('pengembalian', false)
                    ->where('user_id', $userId)
                    ->get();
        return view('penyewa.pengembalian', compact('sewa'));
    }

    public function pengembalianStore(Request $request)
    {
        $request->validate([
            'bukti_denda' => 'file|mimes:jpeg,png,jpg|max:2048',
        ]);
        $sewa = Sewa::findOrFail($request->sewa_id);

        if ($request->hasFile('bukti_denda')) {
            $file = $request->file('bukti_denda');
            $filePath = $file->getRealPath();
            $fileName = $file->getClientOriginalName();

            $disk = Storage::disk('google');
            $stream = fopen($filePath, 'r+');
            $disk->writeStream($fileName, $stream);

            // Get the file URL from Google Drive
            $client = new Google_Client();
            $client->setClientId(env('GOOGLE_DRIVE_CLIENT_ID'));
            $client->setClientSecret(env('GOOGLE_DRIVE_CLIENT_SECRET'));
            $client->refreshToken(env('GOOGLE_DRIVE_REFRESH_TOKEN'));
    
            // Create the Drive service
            $service = new Google_Service_Drive($client);
    
            // Create a file metadata instance
            $fileMetadata = new Google_Service_Drive_DriveFile(['name' => $fileName]);
    
            // Upload the file to Google Drive
            $file = $service->files->create($fileMetadata, [
                'data' => file_get_contents($filePath),
                'mimeType' => $file->getMimeType(),
                'uploadType' => 'multipart'
            ]);
    
            // Generate the URL
            $fileUrl = "https://drive.google.com/uc?id=" . $file->id;
    
            // Set file permissions to public
            $permission = new \Google\Service\Drive\Permission();
            $permission->setType('anyone');
            $permission->setRole('reader');
            $service->permissions->create($file->id, $permission);
    
            // Save the file URL in the database
            $sewa->bukti_denda = $fileUrl;
        }


        $sewa->pengembalian = true;
        $sewa->save();

        notify()->success('Pengajuan pengembalian berhasil diajukan');
        return redirect()->route('penyewa.pengembalian.form')->with('success', 'Pengajuan pengembalian berhasil diajukan.');
    }
    
}

