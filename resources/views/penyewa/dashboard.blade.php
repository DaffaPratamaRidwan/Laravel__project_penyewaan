@push('styles')
    <link rel="stylesheet" href="{{ asset('css/penyewa/dashboard.css') }}">
@endpush
@extends('layouts.app')

@section('content')
<div class="container pb-8 ">
    <div class="row">
        <!-- Main Content -->
        <div class="p-4">
            <div class="bg-white rounded-xl shadow-lg border-custom shadow-custom ">
                <div class="mx-auto px-4 py-8 sm:px-6 sm:py-8  lg:px-8 2xl:px-8 2xl:py-6">
                    <h2 class="pb-5 text-3xl font-semibold text-gray-900 dark:bg-gray-800 dark:text-white justify-center flex">
                            Daftar Alat Berat
                    </h2>
                    <div class="kotak grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 xl:gap-x-7 2xl:gap-x-6 2xl:gap-y-7 ">
                        @foreach($alatBerats as $alatBerat)
                        <a href="{{ route('penyewa.show', $alatBerat->id) }}" class="group">
                            <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-w-7 xl:aspect-h-8 ">
                                <img src="{{ asset('images/alats/' . $alatBerat->gambar) }}" alt="{{ $alatBerat->nama }}" class="h-full w-full object-cover object-center group-hover:opacity-75">
                            </div>
                            <h3 class="mt-4 text-sm text-gray-700">{{ $alatBerat->nama }} - {{ $alatBerat->merk }}</h3>
                            <p class="mt-1 text-lg font-medium text-gray-900">Rp {{ number_format($alatBerat->harga_sewa, 2, ',', '.') }} / hari</p>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
