@extends('layouts.app')

@section('content')
<div class="container pt-3 ">
    <div class="row flex justify-center">
        <div class="w-[600px] rounded bg-gray-50 px-6 pt-8 shadow-lg relative">
            <a href="{{ route('admin.sewa.aktif') }}" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
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
                <h4 class="text-2xl font-semibold">Detail Sewa Aktif</h4>
                <p class="text-base">Detail penyewaan alat berat</p>
            </div>
            <div class="flex flex-col gap-3 border-b py-6 text-md">
                <p class="flex justify-between">
                    <span class="text-gray-400">ID :</span>
                    <span class="id-cell">{{ $sewa->id }}</span>
                </p>
                <p class="flex justify-between">
                    <span class="text-gray-400">Nama Perusahaan:</span>
                    <span class="max-w-72 text-right">{{ $sewa->nama_perusahaan }}</span>
                </p>
                <p class="flex justify-between">
                    <span class="text-gray-400">No Telp:</span>
                    <span>{{ $sewa->no_telp }}</span>
                </p>
                <p class="flex justify-between">
                    <span class="text-gray-400">Tanggal Penyewaan:</span>
                    <span>{{ $sewa->tanggal_awal }} s/d {{ $sewa->tanggal_akhir }}</span>
                </p>
                <p class="flex justify-between">
                    <span class="text-gray-400">Karyawan:</span>
                    <span>{{ $sewa->karyawan->name }}</span>
                </p>
                <p class="flex justify-between">
                    <span class="text-gray-400">Kendaraan:</span>
                    <span>{{ $sewa->kendaraanPengantar->jenis }} - {{ $sewa->kendaraanPengantar->no_pol }}</span>
                </p>
                <!-- <p class="flex justify-between ">
                    <span class="text-gray-400">Bukti Bayar:</span>
                    <a href="{{ $sewa->bukti_bayar }}" class="text-blue-500 hover:text-blue-900 ">Lihat Bukti Bayar</a>
                </p> -->
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
                <!-- <p class="flex justify-between font-boldest text-base">
                    @if($denda > 0)
                        <span class="text-red-500">Denda: Rp {{ number_format($denda, 0, ',', '.') }}</span>
                    @else
                        <span class="text-green-500">Tidak ada denda keterlambatan.</span>
                    @endif
                </p>
                <div class=" border-b border border-dashed"></div> -->

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


