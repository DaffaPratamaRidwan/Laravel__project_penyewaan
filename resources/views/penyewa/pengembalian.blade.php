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
                <h1 class="text-2xl font-semibold mb-4">Ajukan Pengembalian Alat Berat</h1>

                <form action="{{ route('penyewa.pengembalian.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="sewa_id" class="block text-sm font-medium text-gray-700">Pilih Sewa yang Ingin Dikembalikan:</label>
                        <select name="sewa_id" id="sewa_id" class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            <option value="">Pilih Sewa</option>
                            @foreach($sewa as $sewa)
                                <option value="{{ $sewa->id }}">
                                    {{ str_pad($sewa->id, 3, '0', STR_PAD_LEFT) }} - {{ $sewa->nama_perusahaan }} - {{ $sewa->tanggal_awal }} s/d {{ $sewa->tanggal_akhir }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @php
                        // Set locale to Indonesian
                        \Carbon\Carbon::setLocale('id');
                    @endphp
                    <div id="alat_berat_container" style="display: none;">
                        @if(isset($sewa->tanggal_awal) && !empty($sewa->tanggal_awal))
                            <h3 class="text-lg font-normal">
                                Tanggal awal: 
                                {{ \Carbon\Carbon::parse($sewa->tanggal_awal)->translatedFormat('d F Y') }}
                            </h3>
                        @else
                            <h3 class="text-lg font-normal">Tanggal awal: Data tidak tersedia</h3>
                        @endif
                        
                        @if(isset($sewa->tanggal_akhir) && !empty($sewa->tanggal_akhir))
                            <h3 class="text-lg font-normal">
                                Tanggal akhir: 
                                {{ \Carbon\Carbon::parse($sewa->tanggal_akhir)->translatedFormat('d F Y') }}
                            </h3>
                        @else
                            <h3 class="text-lg font-normal">Tanggal akhir: Data tidak tersedia</h3>
                        @endif
                        <h3 class="text-lg font-semibold mb-4">List alat berat :</h3>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Product</th>
                                        <th scope="col" class="px-6 py-3">Merk</th>
                                        <th scope="col" class="px-6 py-3">Qty</th>
                                        <th scope="col" class="px-6 py-3">Harga/Alat</th>
                                    </tr>
                                </thead>
                                <tbody id="alat_berat_list">
                                    <!-- List alat berat akan ditambahkan melalui JavaScript -->
                                </tbody>
                            </table>
                        </div>
                        <h4 id="denda_total" class="mt-4 text-lg font-semibold" style="display: none;">Total Denda: <span style="color: red;">Rp</span> <span id="denda_amount" style="color: red;"></span></h4>
                        <div id="bukti_denda" class="border-gray-200 pt-3" style="display: none;" >
                            <label for="bukti_denda" class="block text-sm font-medium text-gray-700 pb-2">Upload Bukti Denda</label>
                            <input type="file" id="bukti_denda" name="bukti_denda"
                                class="mt-1 block w-full px-3 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>

                    <div class='py-4 justify-end items-end flex flex-col'>
                        <button type="submit" class="btn btn-primary mt-1 hover:bg-green-700 px-6 py-2 bg-green-500 text-white rounded-md" id="submit_button" style="display: none;">Ajukan Pengembalian</button>
                        <a href="{{ route('penyewa.dashboard') }}" class="btn btn-secondary mt-1 hover:bg-blue-600 px-6 py-2 bg-blue-500 text-white rounded-md">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('sewa_id').addEventListener('change', function() {
            let sewaId = this.value;
            let alatBeratList = document.getElementById('alat_berat_list');
            let alatBeratContainer = document.getElementById('alat_berat_container');
            let submitButton = document.getElementById('submit_button');
            let dendaTotal = document.getElementById('denda_total');
            let buktiDenda = document.getElementById('bukti_denda');
            let dendaAmount = document.getElementById('denda_amount');
            alatBeratList.innerHTML = '';

            if (sewaId !== '') {
                fetch(`/penyewa/sewa/${sewaId}`)
                    .then(response => response.json())
                    .then(data => {
                        let totalDenda = 0;
                        let currentDate = new Date();
                        let startDate = new Date(data.tanggal_awal);
                        let endDate = new Date(data.tanggal_akhir);

                        // Adjust endDate to the next day
                        endDate.setDate(endDate.getDate() + 1);
                        let rentalDays = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));
                        let lateDays = Math.ceil((currentDate - endDate) / (1000 * 60 * 60 * 24));

                        data.sewa_detail.forEach(detail => {
                            let totalPricePerItem = rentalDays * detail.alat_berat.harga_sewa * detail.jumlah;
                            let dendaPerAlat = lateDays > 0 ? lateDays * 1.3 * detail.alat_berat.harga_sewa * detail.jumlah : 0;
                            totalDenda += dendaPerAlat;

                            let row = document.createElement('tr');
                            row.className = 'bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600';
                            row.innerHTML = `
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    ${detail.alat_berat.nama}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    ${detail.alat_berat.merk}
                                </td>
                                <td class="px-6 py-4">
                                    ${detail.jumlah}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    Rp ${formatNumber(totalPricePerItem)}
                                </td>
                            `;
                            alatBeratList.appendChild(row);
                        });

                        if (totalDenda > 0) {
                            dendaAmount.textContent = formatNumber(totalDenda);
                            dendaTotal.style.display = 'block';
                            buktiDenda.style.display = 'block';
                        } else {
                            dendaTotal.style.display = 'none';
                            buktiDenda.style.display = 'none';
                        }

                        alatBeratContainer.style.display = 'block';
                        submitButton.style.display = 'block';
                    })
                    .catch(error => console.error('Error fetching details:', error));
            } else {
                alatBeratContainer.style.display = 'none';
                submitButton.style.display = 'none';
            }
        });
    });

    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
</script>
@endsection
