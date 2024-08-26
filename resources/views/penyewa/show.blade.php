@push('styles')
    <link rel="stylesheet" href="{{ asset('css/penyewa/show.css') }}">
@endpush

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- main content -->
        <div class="col-md-12 ">
            <div class = "card-wrapper ">
                <div class = "card  bg-white rounded-2xl">
                    <!-- card left -->
                    <div class = "product-imgs">
                        <div class = "img-display">
                            <div class = "img-showcase">
                                <img src = "{{ asset('images/alats/' . $alatBerat->gambar) }}" alt = "{{ $alatBerat->nama }}">
                            </div>
                        </div>
                    </div>
                    <!-- card right -->
                    <div class = "product-content" style="position: relative;">
                        <a href="{{ route('penyewa.dashboard') }}" class="close-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                        <h2 class = "product-title">{{ $alatBerat->nama }}</h2>
                        <a class = "product-link">Stok : {{ $alatBerat->stok }}</a>

                        <div class = "product-price">
                            <p class = "new-price">Harga Sewa: <span>Rp {{ number_format($alatBerat->harga_sewa, 2, ',', '.') }} / hari</span></p>
                        </div>

                        <div class = "product-detail">
                            <h2>merk : {{ $alatBerat->merk }} </h2>
                            <h2>Description: </h2>
                            <p>{{ $alatBerat->deskripsi }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
