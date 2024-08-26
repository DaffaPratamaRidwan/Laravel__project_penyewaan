
@extends('layouts.app')

@section('content')
<div class="container pt-3">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mr-60">
        <!-- Sidebar -->
        <div class="col-span-1 md:col-span-1">
            @include('components.sidebar')
        </div>
        <!-- Main Content -->
        <div class="col-span-1 md:col-span-3 p-6 bg-white shadow-md rounded-md border-custom shadow-custom mb-10">
            <form id="sewaForm" action="{{ route('penyewa.sewa.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <div class="border-b border-gray-200 pb-8">
                        <h2 class="text-xl font-semibold text-gray-900">Form Penyewaan Alat Berat</h2>
                        <p class="mt-1 text-sm text-gray-600">Isi dengan lengkap</p>
                    </div>

                    <!-- Company Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-1">
                            <label for="nama_perusahaan" class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
                            <input id="nama_perusahaan" name="nama_perusahaan" type="text" autocomplete="nama_perusahaan" value="{{ Auth::user()->nama_perusahaan }}" disabled
                                class="mt-1 block w-full px-3 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-gray-200">
                        </div>
                        <div class="col-span-1">
                            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                            <input type="text" name="alamat" id="alamat" autocomplete="alamat" required
                                class="mt-1 block w-full px-3 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div class="col-span-1">
                            <label for="npwp" class="block text-sm font-medium text-gray-700">NPWP</label>
                            <input type="text" name="npwp" id="npwp" autocomplete="npwp" required
                                class="mt-1 block w-full px-3 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>        
                        <div class="col-span-1">
                            <label for="no_telp" class="block text-sm font-medium text-gray-700">No Telp</label>
                            <input type="text" name="no_telp" id="no_telp" autocomplete="no_telp" required
                                class="mt-1 block w-full px-3 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>                  
                    </div>
                    <div class="col-span-1">
                        <label for="keterangan" class="block text-sm font-medium text-gray-700">Keterangan</label>
                        <input id="keterangan" rows="4" name="keterangan" autocomplete="keterangan" class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  required>
                    </div>

                        
                    <!-- Date Range Picker -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-1">
                            <label for="tanggal_awal" class="block text-sm font-medium text-gray-700">Tanggal Awal Sewa</label>
                            <input type="date" class="mt-1 block w-full px-3 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                id="tanggal_awal" name="tanggal_awal" required>
                        </div>
                        <div class="col-span-1">
                            <label for="tanggal_akhir" class="block text-sm font-medium text-gray-700">Tanggal Akhir Sewa</label>
                            <input type="date" class="mt-1 block w-full px-3 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                id="tanggal_akhir" name="tanggal_akhir" required>
                        </div>
                    </div>
                    <a class="text-xs text-red-600">*minimal 3 hari penyewaan</a>

                    <!-- Alat Berat yang Disewa -->
                    <div class="border-t border-gray-200 pt-8">
                        <h2 class="text-xl font-semibold text-gray-900">Alat Berat Yang Disewa</h2>
                        <div class="mt-6 space-y-6 overflow-y-auto max-h-60 p-3 scrollbar">
                            @foreach($alatBerats as $alatBerat)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input name="alat_berat[]" type="checkbox" value="{{ $alatBerat->id }}" id="alat_berat_{{ $alatBerat->id }}"
                                        data-harga="{{ $alatBerat->harga_sewa }}" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 alat-checkbox">
                                    <div class="text-sm leading-2 ml-4">
                                        <label for="alat_berat_{{ $alatBerat->id }}" class="font-medium text-gray-900">{{ $alatBerat->nama }}</label>
                                        <p class="text-gray-500">(Rp {{ number_format($alatBerat->harga_sewa, 0, ',', '.') }}/hari) - Stok: {{ $alatBerat->stok }}</p>
                                    </div>
                                </div>

                                <!-- Quantity -->
                                <div class="relative flex items-center">
                                    <button type="button" class="decrement-button flex-shrink-0 bg-gray-100 hover:bg-gray-200 inline-flex items-center justify-center border border-gray-300 rounded-md h-5 w-5 focus:ring-2 focus:outline-none" disabled>
                                        <svg class="w-2.5 h-2.5 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                        </svg>
                                    </button>
                                    <input type="text" name="jumlah[]" class="jumlah-input flex-shrink-0 text-gray-900 border-0 bg-transparent text-sm font-normal focus:outline-none focus:ring-0 max-w-[2.5rem] text-center" placeholder="0" value="0" min="1" disabled />
                                    <button type="button" class="increment-button flex-shrink-0 bg-gray-100 hover:bg-gray-200 inline-flex items-center justify-center border border-gray-300 rounded-md h-5 w-5 focus:ring-2 focus:outline-none" disabled>
                                        <svg class="w-2.5 h-2.5 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Total Harga -->
                    <div class="border-t border-gray-200 pt-8">
                        <div class="flex justify-between">
                            <label for="totalHarga" class="block text-sm font-medium text-gray-700">Total Harga:</label>
                            <p id="totalHarga" class="text-lg font-semibold text-gray-900">Rp 0</p>
                        </div>
                    </div>

                    <!-- Bukti Bayar -->
                    <!-- <div class="border-t border-gray-200 pt-8">
                        <label for="bukti_bayar" class="block text-sm font-medium text-gray-700">Bukti Bayar</label>
                        <input type="text" name="bukti_bayar" id="bukti_bayar" required
                            class="mt-1 block w-full px-3 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div> -->

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-4 mt-8">
                        <!-- <a href="{{ route('penyewa.dashboard') }}"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:bg-gray-300">Batal</a> -->
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700">selanjutnya</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alatCheckboxes = document.querySelectorAll('.alat-checkbox');
        const jumlahInputs = document.querySelectorAll('.jumlah-input');
        const totalHargaElement = document.getElementById('totalHarga');
        const tanggalAwalInput = document.getElementById('tanggal_awal');
        const tanggalAkhirInput = document.getElementById('tanggal_akhir');
        const form = document.getElementById('sewaForm');
        const submitButton = form.querySelector('button[type="submit"]');

        function calculateTotal() {
            let totalHarga = 0;

            const tanggalAwal = tanggalAwalInput.value;
            const tanggalAkhir = tanggalAkhirInput.value;

            if (!tanggalAwal || !tanggalAkhir) {
                totalHargaElement.textContent = 'Rp 0';
                return;
            }

            const date1 = new Date(tanggalAwal);
            const date2 = new Date(tanggalAkhir);
            const timeDiff = Math.abs(date2.getTime() - date1.getTime());
            const diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1; 

            alatCheckboxes.forEach((checkbox, index) => {
                if (checkbox.checked) {
                    const harga = parseInt(checkbox.getAttribute('data-harga'));
                    const jumlah = parseInt(jumlahInputs[index].value) || 0;
                    totalHarga += harga * jumlah * diffDays;
                }
            });

            totalHargaElement.textContent = 'Rp ' + totalHarga.toLocaleString('id-ID');
        }

        function handleCheckboxChange(event) {
            const checkbox = event.target;
            const index = Array.from(alatCheckboxes).indexOf(checkbox);
            const input = jumlahInputs[index];
            const decrementButton = input.previousElementSibling;
            const incrementButton = input.nextElementSibling;

            const isChecked = checkbox.checked;
            input.disabled = !isChecked;
            decrementButton.disabled = !isChecked;
            incrementButton.disabled = !isChecked;

            if (checkbox.checked) {
                jumlahInputs[index].value = 1;
            } else {
                jumlahInputs[index].value = 0;
            }
            calculateTotal();
        }

        function handleIncrementDecrement(event) {
            const button = event.target.closest('button');
            const index = Array.from(document.querySelectorAll('.increment-button, .decrement-button')).indexOf(button);
            const input = jumlahInputs[Math.floor(index / 2)];
            let value = parseInt(input.value) || 0;
            if (button.classList.contains('increment-button')) {
                value++;
            } else if (button.classList.contains('decrement-button') && value > 0) {
                value--;
            }
            input.value = value;
            calculateTotal();
        }

        function updateEndDateMin() {
            const startDate = tanggalAwalInput.value;
            const minEndDate = new Date(startDate);
            minEndDate.setDate(minEndDate.getDate() + 2);
            tanggalAkhirInput.min = minEndDate.toISOString().split('T')[0];
        }

        function setMinStartDate() {
            const today = new Date();
            const formattedToday = today.toISOString().split('T')[0];
            tanggalAwalInput.min = formattedToday;
        }

        setMinStartDate();

        alatCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', handleCheckboxChange);
        });

        document.querySelectorAll('.increment-button, .decrement-button').forEach(button => {
            button.addEventListener('click', handleIncrementDecrement);
        });

        tanggalAwalInput.addEventListener('change', function() {
            updateEndDateMin();
            calculateTotal();
        });
        
        tanggalAkhirInput.addEventListener('change', calculateTotal);

        toastr.success('This is a test toast message', 'Success');
        @if (Session::has('stock_error'))
            toastr.error("{{ Session::get('stock_error') }}", 'GAGAL');
        @endif

    });
</script>


@endsection
