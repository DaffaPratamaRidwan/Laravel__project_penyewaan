@extends('layouts.app')

@section('content')
<div class="container pt-3">
    <div class="row flex justify-center">
        <div class="w-[500px] rounded bg-gray-50 px-6 pt-8 shadow-lg relative">
            <a href="{{ route('admin.bayar') }}" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
            <div class="flex items-center justify-center">
                <svg class="w-[50px] h-[50px] text-sky-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M7 6a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2h-2v-4a3 3 0 0 0-3-3H7V6Z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M2 11a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-7Zm7.5 1a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5Z" clip-rule="evenodd"/>
                    <path d="M10.5 14.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"/>
                </svg>
            </div>
            <div class="flex flex-col justify-center items-center gap-2">
                <h4 class="text-2xl font-semibold">Detail Pembayaran</h4>
                <p class="text-base">Menunggu persetujuan penyewaan oleh Direktur Keuangan</p>
            </div>
            <div class="flex flex-col border-b py-6 text-md mb-3">
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
                <p class="flex justify-between mb-3">
                    <span class="text-gray-400 w-full">Keterangan:</span>
                    <span class="text-sm text-justify max-w-60 ml-2 text-right">{{ $sewa->keterangan }}</span>
                </p>              
                <p class="flex justify-between ">
                    <span class="text-gray-400">Bukti Bayar:</span>
                    <a href="{{ $sewa->bukti_bayar }}" class="text-blue-500 hover:text-blue-900 ">Lihat Bukti Bayar</a>
                </p>
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
                <div class="py-4 justify-end items-end flex flex-col gap-2">
                    <form action="{{ route('admin.bayar.approve', $sewa->id) }}" class="hover:text-green-500" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success bg-green-500 rounded-md px-4 py-2 text-white hover:bg-green-700">Setuju</button>
                    </form>
                    <form action="{{ route('admin.bayar.reject', $sewa->id) }}" class="hover:text-red-500" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger bg-red-500 rounded-md px-5 py-2 text-white hover:bg-red-700">Tolak</button>
                    </form>
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

    

    document.getElementById('sewa_id').addEventListener('change', function() {
        let sewaId = this.value;
        if (sewaId !== '') {
            fetch(`/penyewa/sewa/${sewaId}`)
                .then(response => response.json())
                .then(data => {
                    let startDate = new Date(data.tanggal_awal);
                    let endDate = new Date(data.tanggal_akhir);

                    let rentalDays = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
                    row.querySelector('.total-price').textContent = new Intl.NumberFormat('id-ID').format(totalPrice);

    let totalSum = 0;
        document.querySelectorAll('tr').forEach(function(row) {
            let qty = parseFloat(row.querySelector('.jumlah').dataset.qty);
            let price = parseFloat(row.querySelector('.harga').dataset.price);
            let startDate = new Date(data.tanggal_awal);
            let endDate = new Date(data.tanggal_akhir);

            let rentalDays = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));

            let totalPrice = qty * price * rentalDays;

            // Format number to currency format
            
        });
});
</script>
@endsection

