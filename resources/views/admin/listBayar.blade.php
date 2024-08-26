@extends('layouts.app')

@section('content')
<div class="container p-4 ">
    <div class="row relative overflow-x-auto shadow-md sm:rounded-lg border-custom shadow-custom">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                Daftar Pembayaran
                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">list daftar penyewaan yang membutuhkan kondisi oleh dir keuangan</p>
            </caption>
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama Perusahaan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal Awal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tanggal Akhir
                    </th>
                    <th scope="col" class="px-6 py-3">
                        action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($sewa as $sewa)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white id-cell">
                        {{ $sewa->id }}
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $sewa->nama_perusahaan }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $sewa->alamat }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $sewa->tanggal_awal }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $sewa->tanggal_akhir }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.bayar.detail', $sewa->id) }}" class="px-4 py-2 font-medium text-white bg-blue-500 rounded-md dark:text-blue-500 hover:underline">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-2 bg-white dark:text-white dark:bg-gray-800">
        </div>
    </div>
    @if (Auth::user()->role->name == 'admin')
        <a href="{{ route('admin.dataMaster.show') }}" class="inline-flex items-center px-3 py-1 mt-3 text-white bg-blue-600 border border-transparent rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-400">
            Kembali
        </a>
    @else 
    @endif
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
