@extends('layouts.app')

@section('content')
<div class="container pb-8">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            @include('components.sidebar')
        </div>
        
        <!-- Main Content -->
        <div class="p-4 sm:ml-80 lg:ml-80 xl:ml-20 xl:mr-40">
            <div class="bg-white rounded-xl shadow-lg p-6 border-custom shadow-custom">
                <h1 class="text-2xl font-semibold mb-4">Daftar Sewa Aktif Alat Berat</h1>

                <form action="#" method="POST">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="sewa_id" class="block text-sm font-medium text-gray-700">Pilih Sewa yang sedang aktif:</label>
                        <select name="sewa_id" id="sewa_id" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            <option value="">Pilih Sewa</option>
                            @foreach($sewa as $sewa)
                                <option value="{{ $sewa->id }}">
                                    {{ str_pad($sewa->id, 3, '0', STR_PAD_LEFT) }} - {{ $sewa->nama_perusahaan }} - {{ $sewa->tanggal_awal }} s/d {{ $sewa->tanggal_akhir }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div id="alat_berat_container" style="display: none;">
                        <h3 class="text-lg font-semibold mb-4">List alat berat :</h3>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <div id="alat_berat_list" class="m-5"></div>
                            <!-- <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    
                                </thead>
                                <tbody id="alat_berat_list">
                                    
                                </tbody>
                            </table> -->
                        </div>
                        <h4 id="denda_total" class="mt-4 text-lg font-semibold" style="display: none;">Total Denda: <span style="color: red;">Rp</span> <span id="denda_amount" style="color: red;"></span></h4>
                        
                    </div>

                    <div class='py-4 justify-end items-end flex flex-col'>
                        <a href="{{ route('penyewa.dashboard') }}" class="btn btn-secondary mt-1 hover:bg-blue-600 px-6 py-2 bg-blue-500 text-white rounded-md">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        const sewaIdElement = document.getElementById('sewa_id');
        const alatBeratList = document.getElementById('alat_berat_list');
        const dendaAmount = document.getElementById('denda_amount');
        const dendaTotalElement = document.getElementById('denda_total');
        // const buktiDendaElement = document.getElementById('bukti_denda');

        sewaIdElement.addEventListener('change', function() {
            const sewaId = this.value;
            alatBeratList.innerHTML = '';
            dendaAmount.textContent = '';

            if (sewaId !== '') {
                fetch(`/penyewa/sewa/${sewaId}`)
                    .then(response => response.json())
                    .then(data => {
                        let totalDenda = 0;
                        const currentDate = new Date();
                        const endDate = new Date(data.tanggal_akhir);
                        endDate.setDate(endDate.getDate() + 1);

                        let kondisi = '';
                        let statusClass = '';

                        if (data.disetujui === 0 && data.disetujui_tolak === 0 && data.disetujui_sewa === 0 && data.disetujui_sewa_tolak === 0 && data.pengembalian === 0 && data.pengembalian_diterima === 0) {
                            kondisi = 'menunggu';
                            statusClass = 'text-yellow-300';
                        } else if (data.disetujui === 1 && data.disetujui_tolak === 0 && data.disetujui_sewa === 0 && data.disetujui_sewa_tolak === 0 && data.pengembalian === 0 && data.pengembalian_diterima === 0) {
                            kondisi = 'menunggu';
                            statusClass = 'text-yellow-300';
                        } else if (data.disetujui === 0 && data.disetujui_tolak === 1 && data.disetujui_sewa === 0 && data.disetujui_sewa_tolak === 0 && data.pengembalian === 0 && data.pengembalian_diterima === 0) {
                            kondisi = 'Ditolak bayar';
                            statusClass = 'text-red-500';
                        } else if (data.disetujui === 1 && data.disetujui_tolak === 0 && data.disetujui_sewa === 1 && data.disetujui_sewa_tolak === 0 && data.pengembalian === 0 && data.pengembalian_diterima === 0) {
                            kondisi = 'Disetujui';
                            statusClass = 'text-green-500';
                        } else if (data.disetujui === 1 && data.disetujui_tolak === 0 && data.disetujui_sewa === 0 && data.disetujui_sewa_tolak === 1 && data.pengembalian === 0 && data.pengembalian_diterima === 0) {
                            kondisi = 'ditolak sewa';
                            statusClass = 'text-red-500';
                        } else if (data.disetujui === 1 && data.disetujui_tolak === 0 && data.disetujui_sewa === 1 && data.disetujui_sewa_tolak === 0 && data.pengembalian === 1 && data.pengembalian_diterima === 0) {
                            kondisi = 'pengembalian belum dikonfirmasi';
                            statusClass = 'text-yellow-300';
                        } else if (data.disetujui === 1 && data.disetujui_tolak === 0 && data.disetujui_sewa === 1 && data.disetujui_sewa_tolak === 0 && data.pengembalian === 1 && data.pengembalian_diterima === 1) {
                            kondisi = 'pengembalian sudah dikonfirmasi';
                            statusClass = 'text-green-500';
                        }

                        const lateDays = Math.ceil((currentDate - endDate) / (1000 * 60 * 60 * 24));

                        if (data.sewa_detail.length > 0) {
                            const detail = data.sewa_detail[0];
                            const dendaPerAlat = lateDays > 0 ? lateDays * 1.3 * detail.alat_berat.harga_sewa * detail.jumlah : 0;
                            totalDenda += dendaPerAlat;

                            const row = document.createElement('div');
                            row.className = 'bg-white dark:bg-gray-800 dark:border-gray-700';
                            row.innerHTML = `
                                <div class="row flex justify-center">
                                    <div class="w-[500px] rounded bg-gray-50 px-6 pt-8 shadow-lg relative">
                                        <div class="flex items-center justify-center">
                                            <svg class="w-[50px] h-[50px] text-sky-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M7 6a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2h-2v-4a3 3 0 0 0-3-3H7V6Z" clip-rule="evenodd"/>
                                                <path fill-rule="evenodd" d="M2 11a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-7Zm7.5 1a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5Z" clip-rule="evenodd"/>
                                                <path d="M10.5 14.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"/>
                                            </svg>
                                        </div>
                                        <div class="flex flex-col justify-center items-center gap-2">
                                            <h4 class="text-2xl font-semibold">Detail Sewa Aktif</h4>
                                        </div>
                                        <div class="flex flex-col border-b py-6 text-md mb-3">
                                            
                                            <p class="flex justify-between mb-3">
                                                <span class="text-gray-400">ID :</span>
                                                <span class="id-cell">${data.id.toString().padStart(3, '0')}</span>
                                            </p>
                                            <p class="flex justify-between mb-3">
                                                <span class="text-gray-400">Nama Perusahaan:</span>
                                                <span class="max-w-72 text-right">${data.nama_perusahaan}</span>
                                            </p>
                                            <p class="flex justify-between mb-3">
                                                <span class="text-gray-400">NPWP:</span>
                                                <span>${data.npwp}</span>
                                            </p>
                                            <p class="flex justify-between mb-3">
                                                <span class="text-gray-400">No Telp:</span>
                                                <span>${data.no_telp}</span>
                                            </p>
                                            <p class="flex justify-between mb-3">
                                                <span class="text-gray-400">Alamat:</span>
                                                <span class="max-w-72 text-right">${data.alamat}</span>
                                            </p>
                                            @php
                                                // Set locale to Indonesian
                                                \Carbon\Carbon::setLocale('id');
                                            @endphp
                                            <p class="flex justify-between mb-3">
                                                <span class="text-gray-400">Tanggal Awal Penyewaan:</span>
                                                <span>{{ \Carbon\Carbon::parse($sewa->tanggal_awal)->translatedFormat('d F Y') }}</span>
                                            </p>
                                            <p class="flex justify-between mb-3">
                                                <span class="text-gray-400">Tanggal Akhir Penyewaan:</span>
                                                <span>{{ \Carbon\Carbon::parse($sewa->tanggal_akhir)->translatedFormat('d F Y') }}</span>
                                            </p>
                                            <p class="flex justify-between mb-3">
                                                <span class="text-gray-400 w-full">Keterangan:</span>
                                                <span class="text-sm text-justify max-w-60 ml-2 text-right">${data.keterangan}</span>
                                            </p>
                                            <p class="flex justify-between mb-3">
                                                <span class="text-gray-400">Bukti Bayar:</span>
                                                <a href="${data.bukti_bayar}" class="text-blue-500 hover:text-blue-900 text-right">Lihat Bukti Bayar</a>
                                            </p>     
                                            <p class="flex justify-between mb-3">
                                                <span class="text-gray-400">Bukti kontrak:</span>
                                                <a href="${data.kontrak}" class="text-blue-500 hover:text-blue-900 text-right">Lihat kontrak</a>
                                            </p>   
                                            <p class="flex justify-between mb-3" id="buktiDenda" style="display: none;">
                                                <span class="text-gray-400" >Bukti denda:</span>
                                                <a href="${data.bukti_denda}" class="text-blue-500 hover:text-blue-900 text-right ml-[220px]" >Lihat Bukti denda</a>
                                            </p>                                               
                                            <p class="flex justify-between">
                                                <span class="text-gray-400  ">Status:</span>
                                                <span class="ml-2 font-md text-right ${statusClass}"> ${kondisi}</span>

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
                                                    ${(() => {
                                                        let totalSewa = 0;
                                                        return data.sewa_detail.map(detail => {
                                                            let startDate = new Date(data.tanggal_awal);
                                                            let endDate = new Date(data.tanggal_akhir);

                                                            let rentalDays = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;

                                                            let totalPrice = detail.jumlah * detail.alat_berat.harga_sewa * rentalDays;
                                                            totalSewa += totalPrice;

                                                            return `
                                                            <tr class="flex">
                                                                <td class="flex-1 py-1 text-left">${detail.alat_berat.nama}</td>
                                                                <td class="w-20 text-center">${detail.jumlah}</td>
                                                                <td class="w-36 text-right">Rp ${totalPrice.toLocaleString('id-ID')}</td>
                                                            </tr>
                                                            `;
                                                        }).join('') + `
                                                            </tbody>
                                                            </table>
                                                            <div class="border-b border"></div>
                                                            <p class="flex justify-between">
                                                                <span>Total:</span>
                                                                <span>Rp ${totalSewa.toLocaleString('id-ID')}</span>
                                                            </p>`;
                                                            
                                                    })()}
                                            </div>
                                        </div>
                                </div>
                            `;
                            alatBeratList.appendChild(row);
                        }
                        
                        if (totalDenda > 0) {
                            dendaTotalElement.style.display = 'block';
                            dendaAmount.textContent = totalDenda.toLocaleString('id-ID');

                            document.getElementById('buktiDenda').style.display = 'block';

                            // buktiDendaElement.style.display = 'block';
                        } else {
                            dendaTotalElement.style.display = 'none';

                        }
                        document.getElementById('alat_berat_container').style.display = 'block';
                    })
                    .catch(error => {
                        console.error('Error fetching rental details:', error);
                    });
            } else {
                document.getElementById('alat_berat_container').style.display = 'none';
            }
        });
    });
</script>
@endsection
