@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/detailSewa.css') }}">
@endpush

@extends('layouts.app')

@section('content')
<div class="container pt-3 ">
    <div class="row flex justify-center ">
        <div class="w-[600px] rounded bg-gray-50 px-10 pt-8 shadow-lg relative">
            <a href="{{ route('admin.sewa') }}" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
            <div class="flex items-center justify-center">
                <svg class="w-[50px] h-[50px] text-sky-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="flex flex-col justify-center items-center gap-2">
                <h4 class="text-2xl font-semibold">Detail Pengajuan Sewa</h4>
                <p class="text-base">Menunggu persetujuan penyewaan oleh Direktur Operasional</p>
            </div>
            <div class="flex flex-col border-b py-6 text-md">
                <p class="flex justify-between mb-3">
                    <span class="text-gray-400">ID :</span>
                    <span class="id-cell">{{ $sewa->id }}</span>
                </p>
                <p class="flex justify-between mb-3">
                    <span class="text-gray-400">Nama Perusahaan:</span>
                    <span class="max-w-72 text-right">{{ $sewa->nama_perusahaan }}</span>
                </p>
                <p class="flex justify-between mb-3">
                    <span class="text-gray-400">NPWP:</span>
                    <span>{{ $sewa->npwp }}</span>
                </p>
                <p class="flex justify-between mb-3">
                    <span class="text-gray-400">No Telp:</span>
                    <span>{{ $sewa->no_telp }}</span>
                </p>
                <p class="flex justify-between mb-3">
                    <span class="text-gray-400">Alamat:</span>
                    <span class="max-w-72 text-right">{{ $sewa->alamat }}</span>
                </p>
                <p class="flex justify-between mb-3">
                    <span class="text-gray-400">Tanggal Penyewaan:</span>
                    <span>{{ $sewa->tanggal_awal }} s/d {{ $sewa->tanggal_akhir }}</span>
                </p>
                <p class="flex justify-between pb-3">
                    <span class="text-gray-400 w-full">Keterangan:</span>
                    <span class="text-sm text-justify max-w-60 ml-2 text-right">{{ $sewa->keterangan }}</span>
                </p>
                <!-- <p class="flex justify-between">
                    <span class="text-gray-400">Bukti Bayar:</span>
                    <span href="{{ $sewa->bukti_bayar }}">Lihat Bukti Bayar</span>
                </p> -->
                <!-- Bukti Bayar -->
                
            </div>
            <div class="flex flex-col gap-3 pb-6 pt-2 text-md">
                <table class="w-full text-left">
                    <thead>
                        <tr class="flex">
                            <th class="flex-1 py-2 text-left">Alat Berat</th>
                            <th class="w-20 py-2 text-center">QTY</th>
                            <th class="w-36 py-2 text-right">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sewa->sewaDetail as $detail)
                        @php
                            // Convert dates to Carbon instances
                            $startDate = strtotime($sewa->tanggal_awal);
                            $endDate = strtotime($sewa->tanggal_akhir);
                            
                            // Calculate rental days
                            $diff = $endDate-$startDate;
                            $rentalDays = floor($diff/(60*60*24)) + 1;
                        @endphp
                        <tr class="flex">
                            <td class="flex-1 py-1 text-left">{{ $detail->alatBerat->nama }}</td>
                            <td class="w-20 text-center">{{ $detail->jumlah }}</td>
                                @php
                                    // Calculate total price per item
                                    $totalPrice = $detail->jumlah * $detail->alatBerat->harga_sewa * $rentalDays;
                                @endphp
                            <td class="w-36 text-right ">Rp {{ number_format($totalPrice, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class=" border-b border "></div>
                <p class="flex justify-between">
                    <span class="">Total:</span>
                    <span href="{{ $sewa->bukti_bayar }}">Rp {{ $totalHargaFormatted }}</span>
                </p>
                <div class=" border-b border border-dashed"></div>
                <div class=" flex flex-col gap-2">                  
                   <form action="{{ route('admin.sewa.approve', $sewa->id) }}" method="POST" class="flex flex-col" enctype="multipart/form-data">
                        @csrf
                        <!-- Dropdown Form -->
                        <div class="form-group">
                            <label for="kontrak" class="block text-md font-medium text-gray-700 ">Upload Kontrak</label>
                            <input type="file" id="kontrak" name="kontrak" required
                                class="mt-1 block w-full px-1 py-1 rounded-md  focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div class=" border-b border mt-4 mb-5"></div>
                        <div class="form-group ">
                            <label for="karyawan_id" class="block text-sm font-medium text-gray-700">Pilih karyawan yang ditugaskan:</label>
                            <select name="karyawan_id" id="karyawan_id" class="form-control mt-1 block w-full px-3 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="" disabled selected>Pilih karyawan</option>
                                @foreach($karyawans as $karyawan)
                                    <option value="{{ $karyawan->id }}">{{ $karyawan->name }} - NIP: {{ $karyawan->nip }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kendaraan_pengantar_id" class="block text-sm font-medium text-gray-700">Pilih kendaraan untuk mengantar:</label>
                            <select name="kendaraan_pengantar_id" id="kendaraan_pengantar_id" class="form-control mt-1 block w-full px-3 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="" disabled selected>Pilih kendaraan pengantar</option>
                                @foreach($kendaraanPengantars as $kendaraanPengantar)
                                    <option value="{{ $kendaraanPengantar->id }}">{{ $kendaraanPengantar->jenis }} - NIP: {{ $kendaraanPengantar->no_pol }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="flex gap-2 justify-end mt-4">
                            <button type="submit" class="setuju px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:bg-green-700">Setuju</button>
                        </div> 
                   </form>
                    <!-- Buttons Form -->
                    <div class="flex gap-2 justify-end mr-2">
                        <form action="{{ route('admin.sewa.reject', $sewa->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="tolak px-6 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:bg-red-700">Tolak</button>
                        </form>
                        <!-- <form action="{{ route('admin.sewa.approve', $sewa->id) }}" method="POST">
                            @csrf
                            <button type="submit" class=" px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:bg-green-700">Setuju</button>
                        </form> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const idCells = document.querySelectorAll('.id-cell');
    
    idCells.forEach(cell => {
        const idText = cell.textContent.trim();
        const formattedId = idText.padStart(3, '0');
        cell.textContent = formattedId;
    });
});
</script>
@endsection

<!-- <form action="{{ route('admin.sewa.approve', $sewa->id) }}" method="POST" class="text-right">
    @csrf
    <div class="form-group">
        <label for="karyawan_id">Pilih Karyawan yang Ditugaskan:</label>
        <select name="karyawan_id" id="karyawan_id" class="form-control" required>
            <option value="" disabled selected>Pilih Karyawan</option>
            @foreach($karyawans as $karyawan)
                <option value="{{ $karyawan->id }}">{{ $karyawan->name }} - NIP: {{ $karyawan->nip }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success mt-3 hover:text-green-500">Setujui Sewa</button>
</form>
<form action="{{ route('admin.sewa.reject', $sewa->id) }}" class="hover:text-red-500" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">Tolak Penyewaan</button>
</form> -->