@extends('layouts.app')

@section('content')
<div class="container p-4 ">
    <div class="flex justify-center ">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 ml-40">
            <!-- main content -->
            <div class="col-span-1 md:col-span-3 p-6 bg-white shadow-md rounded-md border-custom shadow-custom mb-10">
                <form action="{{ route('admin.update', $alatBerat->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-6">
                        <div class="border-b border-gray-200 pb-8">
                            <h2 class="text-xl font-semibold text-gray-900">Edit Alat Berat</h2>
                            <p class="mt-1 text-sm text-gray-600">Isi Untuk memperbarui Form Alat berat</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-1">
                                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Alat Berat</label>
                                <input id="nama" name="nama" type="text" autocomplete="nama" value="{{ $alatBerat->nama }}"
                                    class="mt-1 block w-full px-3 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                            <div class="col-span-1">
                                <label for="merk" class="block text-sm font-medium text-gray-700">Merk</label>
                                <input type="text" name="merk" id="merk" autocomplete="merk" value="{{ $alatBerat->nama }}"
                                    class="mt-1 block w-full px-3 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                            <div class="col-span-1">
                                <label for="kode" class="block text-sm font-medium text-gray-700">Kode</label>
                                <input type="text" name="kode" id="kode" autocomplete="kode" value="{{ $alatBerat->kode }}"
                                    class="mt-1 block w-full px-3 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </div>

                        <div class="col-span-1">
                            <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                            <textarea id="deskripsi" rows="4" name="deskripsi" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $alatBerat->deskripsi }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- <div class="col-span-1">
                                <label for="gambar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload file</label>
                                <input type="file" id="gambar" name="gambar" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="gambar-description">
                                <div id="file-info" class="mt-2 text-sm text-gray-500 dark:text-white">
                                    @if($alatBerat->gambar)
                                        <p>File Saat Ini: {{ $alatBerat->gambar }}</p>
                                    @else
                                        <p>Tidak ada file yang diunggah</p>
                                    @endif
                                </div>
                            </div> -->
                            
                            <div class="col-span-1">
                                <label for="quantity-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Stok:</label>
                                <div class="relative flex items-center max-w-[8rem]">
                                    <button type="button" id="decrement-button" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                        <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                        </svg>
                                    </button>
                                    <input type="text" id="quantity-input" name="stok" aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ $alatBerat->stok }}" />
                                    <button type="button" id="increment-button" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                        <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                        </svg>
                                    </button>
                                </div>
                                <p id="helper-text-explanation" class="mt-2 text-sm text-gray-500 dark:text-gray-400">input jumlah stok alat</p>
                            </div>
                            <br>
                            <div >
                                <label for="harga_sewa" class="block text-sm font-medium leading-6 text-gray-900">Harga</label>
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <span class="text-gray-500 sm:text-sm">Rp</span>
                                    </div>
                                    <input type="text" name="harga_sewa" id="harga_sewa" class="block w-full rounded-md border-0 py-1.5 pl-8 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{ $alatBerat->harga_sewa }}">
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label for="gambar">Nama Gambar</label>
                            <input type="text" class="form-control" id="gambar" name="gambar" value="{{ $alatBerat->gambar }}">
                        </div> -->
                        
                        <div class="flex justify-end space-x-4 mt-8">
                            <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:bg-indigo-700" onclick="return confirm('Anda yakin ingin menyimpan perubahan?')">Simpan Perubahan</button>
                            <a href="{{ route('admin.show', $alatBerat->id) }}"
                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 focus:outline-none focus:bg-gray-300">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const incrementButton = document.getElementById('increment-button');
        const decrementButton = document.getElementById('decrement-button');
        const quantityInput = document.getElementById('quantity-input');
        const fileInput = document.getElementById('gambar');
        const fileInfo = document.getElementById('file-info');

        incrementButton.addEventListener('click', function () {
            let currentValue = parseInt(quantityInput.value) || 0;
            quantityInput.value++;
        });

        decrementButton.addEventListener('click', function () {
            let currentValue = parseInt(quantityInput.value) || 0;
            if (currentValue > 0) {
                quantityInput.value--;
            }
        });

        if (fileInput.files.length > 0) {
            fileInfo.innerHTML = `<p>File Dipilih: ${fileInput.files[0].name}</p>`;
        } else {
            fileInfo.innerHTML = `@if($alatBerat->gambar)<p>File Saat Ini: {{ $alatBerat->gambar }}</p>@else<p>Tidak ada file yang diunggah</p>@endif`;
        }

        // Update file info on file selection
        fileInput.addEventListener('change', function () {
            const file = fileInput.files[0];
            if (file) {
                fileInfo.innerHTML = `<p>File Dipilih: ${file.name}</p>`;
            } else {
                fileInfo.innerHTML = `@if($alatBerat->gambar)<p>File Saat Ini: {{ $alatBerat->gambar }}</p>@else<p>Tidak ada file yang diunggah</p>@endif`;
            }
        });
    });
</script>
@endsection


