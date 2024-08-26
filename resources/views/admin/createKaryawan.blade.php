@extends('layouts.app')

@section('content')
<div class="container items-center justify-center pt-3 xl:pl-60 lg:pl-35">
    <div class="bg-white rounded-xl shadow-lg border-custom shadow-custom relative overflow-x-auto p-6 max-w-2xl pl-10">
        <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            <svg class="w-[48px] h-[48px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M16 12h4m-2 2v-4M4 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
            </svg>
            <h2 class="text-xl font-semibold text-gray-900">Tambah Karyawan</h2>           
            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Form Tambah Karyawan PT. Sarkon Bangun Nusantara</p>
        </caption>
        <form action="{{ route('admin.karyawan.store') }}" class="max-w-xl " method="POST">
            @csrf
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-black dark:text-black">Your name</label>
                <input type="text" id="name" name="name" class="bg-gray-50 border border-custom-392676 text-black dark:text-green-400 placeholder-green-700 dark:placeholder-green-500 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-green-500" required>
            </div>
            <div class="mb-5">
                <label for="nip" class="block mb-2 text-sm font-medium text-black dark:text-black">NIP</label>
                <input type="text" id="nip" name="nip" class="bg-gray-50 border border-custom-392676 text-black dark:text-green-400 placeholder-green-700 dark:placeholder-green-500 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-green-500" required>
            </div>
            <div class="mt-6 flex justify-end">
                <a href="{{ route('admin.dataMaster.show') }}" class="mr-2 px-4 py-2 bg-red-600 text-white rounded-md">Kembali</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
