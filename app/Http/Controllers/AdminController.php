<?php

namespace App\Http\Controllers;

use App\Models\AlatBerat;
use App\Models\Sewa;
use App\Models\SewaDetail;
use App\Models\Karyawan;
use App\Models\KendaraanPengantar;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Google\Client as Google_Client;
use Google\Service\Drive as Google_Service_Drive;
use Google\Service\Drive\DriveFile as Google_Service_Drive_DriveFile;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        $alatBerats = AlatBerat::all();
        return view('admin.dashboard', compact('alatBerats'));
    }

    public function show($id)
    {
        $alatBerat = AlatBerat::findOrFail($id);
        return view('admin.show', compact('alatBerat'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'nama' => 'required|string|max:255',
        'merk' => 'required|string|max:255',
        'kode' => 'required|string|max:255',
        'gambar' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        'deskripsi' => 'required|string',
        'stok' => 'required|integer|min:0',
        'harga_sewa' => 'required|numeric|min:0',
    ]);

    // Handle file upload
    $gambarPath = $request->file('gambar')->store('', 'custom');

    $alatBerat = new AlatBerat();
    $alatBerat->nama = $validatedData['nama'];
    $alatBerat->merk = $validatedData['merk'];
    $alatBerat->kode = $validatedData['kode'];
    $alatBerat->gambar = $gambarPath;
    $alatBerat->deskripsi = $validatedData['deskripsi'];
    $alatBerat->stok = $validatedData['stok'];
    $alatBerat->harga_sewa = $validatedData['harga_sewa'];
    $alatBerat->save();

    notify()->success('Alat berat berhasil ditambahkan');
    return redirect()->route('admin.dataMaster.show')->with('success', 'Alat berat berhasil ditambahkan.');
}

    public function edit($id)
    {
        $alatBerat = AlatBerat::findOrFail($id);
        return view('admin.edit', compact('alatBerat'));
    }

    public function update(Request $request, $id)
    {
        $alatBerat = AlatBerat::findOrFail($id);
        $alatBerat->update($request->all());
    
        notify()->success('Data alat berat berhasil diperbarui');
        return redirect()->route('admin.show', $alatBerat->id)->with('success', 'Data alat berat berhasil diperbarui.');
    }
    
    public function destroy($id)
    {
        $alatBerat = AlatBerat::findOrFail($id);
        $alatBerat->delete();
    
        notify()->success('berhasil dihapus');
        return redirect()->route('admin.dataMaster.show')->with('success', 'Alat Berat berhasil dihapus.');
    }

    // fitur sewa
    public function listBayar()
    {
        $sewa = Sewa::where('disetujui', false)
                    ->where('disetujui_tolak', false)
                    ->get();
        return view('admin.listBayar', compact('sewa'));
    }

    public function detailBayar($id)
    {
        $sewa = Sewa::findOrFail($id);

        $tanggalAwal = Carbon::parse($sewa->tanggal_awal);
        $tanggalAkhir = Carbon::parse($sewa->tanggal_akhir);

        $totalHarga = $sewa->sewaDetail->sum(function ($detail) use ($tanggalAwal, $tanggalAkhir) {
            return $detail->alatBerat->harga_sewa * $detail->jumlah * (($tanggalAwal->diffInDays($tanggalAkhir)) + 1);
        });

        $totalHargaFormatted = number_format($totalHarga, 0, ',', '.');

        return view('admin.detailBayar', compact('sewa', 'totalHargaFormatted'));

    }

    public function approveBayar($id)
    {
        $sewa = Sewa::findOrFail($id);
        $sewa->disetujui= true;
        $sewa->save();
    
        notify()->success('Bayar berhasil disetujui');
        return redirect()->route('admin.bayar')->with('success', 'Bayar berhasil disetujui.');
    }

    public function rejectBayar($id)
    {
        $sewa = Sewa::findOrFail($id);
        $sewa->disetujui = false;
        $sewa->disetujui_tolak = true;
        $sewa->save();

        foreach ($sewa->sewaDetail as $detail) {
            $detail->alatBerat->stok += $detail->jumlah;
            $detail->alatBerat->save();
        }


        notify()->warning('Pembayaran ditolak');
        return redirect()->route('admin.bayar')->with('success', 'Pembayaran ditolak.');
    }

    public function listSewa()
    {
        $sewa = Sewa::where('disetujui', true)
                    ->where('disetujui_sewa', false)
                    ->where('disetujui_sewa_tolak', false)
                    ->get();
        return view('admin.listSewa', compact('sewa'));
    }
    
    public function detailSewa($id)
    {
        $sewa = Sewa::findOrFail($id);

        $tanggalAwal = Carbon::parse($sewa->tanggal_awal);
        $tanggalAkhir = Carbon::parse($sewa->tanggal_akhir);

        $totalHarga = $sewa->sewaDetail->sum(function ($detail) use ($tanggalAwal, $tanggalAkhir) {
            return $detail->alatBerat->harga_sewa * $detail->jumlah * (($tanggalAwal->diffInDays($tanggalAkhir)) + 1);
        });

        $totalHargaFormatted = number_format($totalHarga, 0, ',', '.');

        $karyawans = Karyawan::all();
        $kendaraanPengantars = KendaraanPengantar::all();

        return view('admin.detailSewa', compact('sewa', 'totalHargaFormatted', 'karyawans', 'kendaraanPengantars'));
    }
    
    public function approveSewa(Request $request, $id)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'kendaraan_pengantar_id' => 'required|exists:kendaraan_pengantar,id',
            'kontrak' => 'required|file|mimes:jpeg,png,jpg|max:2048',
        ]);    

        $sewa = Sewa::findOrFail($id);

        if ($request->hasFile('kontrak')) {
            $file = $request->file('kontrak');
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
            $sewa->kontrak = $fileUrl;
        }

        $sewa->disetujui_sewa = true;
        $sewa->karyawan_id = $request->input('karyawan_id');
        $sewa->kendaraan_pengantar_id = $request->input('kendaraan_pengantar_id');
        $sewa->save();
    
        notify()->success('Sewa berhasil disetujui');
        return redirect()->route('admin.sewa')->with('success', 'Sewa berhasil disetujui.');
    }

    public function rejectSewa($id)
    {
        $sewa = Sewa::findOrFail($id);
        $sewa->disetujui_sewa = false;
        $sewa->disetujui_sewa_tolak = true;
        $sewa->save();

        foreach ($sewa->sewaDetail as $detail) {
            $detail->alatBerat->stok += $detail->jumlah;
            $detail->alatBerat->save();
        }


        notify()->warning('Penyewaan ditolak');
        return redirect()->route('admin.sewa')->with('success', 'Penyewaan ditolak.');
    }

    //fitur pengembalian
    public function pengembalianApproval()
    {
        $pengembalian = Sewa::where('pengembalian', true)
                                    ->where('pengembalian_diterima', false)
                                    ->get();

        return view('admin.pengembalian', compact('pengembalian'));
    }

    public function showPengembalian($id)
    {
        $sewa = Sewa::with('sewaDetail.alatBerat')->findOrFail($id);

        $today = Carbon::now();
        $endDate = Carbon::parse($sewa->tanggal_akhir);

        $denda = 0;
        if ($today->gt($endDate)) {
            $daysLate = $today->diffInDays($endDate);
            $dendaPerDay = 130 / 100; // 130% per day
            foreach ($sewa->sewaDetail as $detail) {
                $denda += ($detail->alatBerat->harga_sewa * $dendaPerDay) * $daysLate * $detail->jumlah;
            }
        }

        return view('admin.pengembalianShow', compact('sewa', 'denda'));
    }


    public function pengembalianApprove($sewa_id)
    {
        $sewa = Sewa::findOrFail($sewa_id);
        $sewa->pengembalian_diterima = true;
        $sewa->save();
        
        // Tambahkan stok alat berat yang dikembalikan
        foreach ($sewa->sewaDetail as $detail) {
            $detail->alatBerat->stok += $detail->jumlah;
            $detail->alatBerat->save();
        }
        
        notify()->success('Pengembalian alat berat berhasil disetujui');
        return redirect()->route('admin.pengembalian.approval')->with('success', 'Pengembalian alat berat berhasil disetujui.');
    }

    public function showKaryawan()
    {
        $karyawans = Karyawan::all();
        return view('admin.showKaryawan', compact('karyawans'));
    }

    public function createKaryawan()
    {
        return view('admin.createKaryawan');
    }
    
    public function storeKaryawan(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
        ]);

        $karyawan = new Karyawan();
        $karyawan->name = $validatedData['name'];
        $karyawan->nip = $validatedData['nip'];
        $karyawan->save();

        notify()->success('Karyawan berhasil ditambahkan');
        return redirect()->route('admin.dataMaster.show')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function destroyKaryawan($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        notify()->success('Karyawan berhasil dihapus');
        return redirect()->route('admin.dataMaster.show')->with('success', 'Karyawan berhasil dihapus.');
    }

    public function showKendaraanPengantar()
    {
        $kendaraanPengantars = KendaraanPengantar::all();
        return view('admin.showKendaraanPengantar', compact('kendaraanPengantars'));
    }

    public function createKendaraanPengantar()
    {
        return view('admin.createKendaraanPengantar');
    }
    
    public function storeKendaraanPengantar(Request $request)
    {
        $validatedData = $request->validate([
            'jenis' => 'required|string|max:255',
            'no_pol' => 'required|string|max:255',
        ]);

        $kendaraanPengantar = new KendaraanPengantar();
        $kendaraanPengantar->jenis = $validatedData['jenis'];
        $kendaraanPengantar->no_pol = $validatedData['no_pol'];
        $kendaraanPengantar->save();

        notify()->success('kendaraan pengantar berhasil ditambahkan');
        return redirect()->route('admin.dataMaster.show')->with('success', 'Kendaraan Pengantar berhasil ditambahkan.');
    }

    public function destroyKendaraanPengantar($id)
    {
        $kendaraanPengantar = KendaraanPengantar::findOrFail($id);
        $kendaraanPengantar->delete();

        notify()->success('kendaraan pengantar berhasil dihapus');
        return redirect()->route('admin.dataMaster.show')->with('success', 'KendaraanPengantar berhasil dihapus.');
    }

    public function showUser()
    {
        $users = User::with('role')->get();
        return view('admin.showUser', compact('users'));
    }

    public function createUser()
    {
        return view('admin.createUser');
    }

    public function editUserRole(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|exists:role,id',
        ]);

        $user = User::findOrFail($id);
        $user->role_id = $request->role_id;
        $user->save();

        notify()->success('Role user berhasil diperbarui');
        return redirect()->route('admin.dataMaster.show')->with('success', 'Role user berhasil diperbarui.');
    }

    public function showDataMaster()
    {
        $alatBerats = AlatBerat::all();

        $karyawans = Karyawan::all();

        $kendaraanPengantars = KendaraanPengantar::all();

        $users = User::with('role')->get();
        $roles = Role::all();

        return view('admin.showDataMaster', compact('alatBerats', 'karyawans', 'kendaraanPengantars','users', 'roles'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        $alatBerats = AlatBerat::where('nama', 'like', '%' . $query . '%')->get();

        $karyawans = Karyawan::all();

        $kendaraanPengantars = KendaraanPengantar::all();

        $users = User::with('role')->get();
        $roles = Role::all();

        return view('admin.showDataMaster', compact('alatBerats', 'karyawans', 'kendaraanPengantars','users', 'roles'));
    }

    //fitur riwayat
    public function riwayat()
    {
        $riwayat = Sewa::where('pengembalian', true)
                                    ->where('pengembalian_diterima', true)
                                    ->get();

        return view('admin.riwayat', compact('riwayat'));
    }

    public function showRiwayat($id)
    {
        $sewa = Sewa::with('sewaDetail.alatBerat')->findOrFail($id);

        $today = Carbon::now();
        $endDate = Carbon::parse($sewa->tanggal_akhir);

        $denda = 0;
        if ($today->gt($endDate)) {
            $daysLate = $today->diffInDays($endDate);
            $dendaPerDay = 130 / 100; // 130% per day
            foreach ($sewa->sewaDetail as $detail) {
                $denda += ($detail->alatBerat->harga_sewa * $dendaPerDay) * $daysLate * $detail->jumlah;
            }
        }

        return view('admin.riwayatShow', compact('sewa', 'denda'));
    }

    //fitur sewaAktif
    public function sewaAktif()
    {
        $sewaAktif = Sewa::where('disetujui_sewa', true)
                                    ->where('pengembalian', false)
                                    ->get();

        return view('admin.sewaAktif', compact('sewaAktif'));
    }

    public function showSewaAktif($id)
    {
        $sewa = Sewa::with('sewaDetail.alatBerat')->findOrFail($id);

        $today = Carbon::now();
        $endDate = Carbon::parse($sewa->tanggal_akhir);

        $denda = 0;
        if ($today->gt($endDate)) {
            $daysLate = $today->diffInDays($endDate);
            $dendaPerDay = 130 / 100; // 130% per day
            foreach ($sewa->sewaDetail as $detail) {
                $denda += ($detail->alatBerat->harga_sewa * $dendaPerDay) * $daysLate * $detail->jumlah;
            }
        }

        return view('admin.sewaAktifShow', compact('sewa', 'denda'));
    }
}

