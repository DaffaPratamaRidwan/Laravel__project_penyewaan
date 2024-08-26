@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/show.css') }}">
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-wrapper">
                <div class="card bg-white rounded-2xl">
                    <!-- card left -->
                    <div class="product-imgs">
                        <div class="img-display">
                            <div class="img-showcase">
                                <img src="{{ asset('images/alats/' . $alatBerat->gambar) }}" alt="{{ $alatBerat->nama }}">
                            </div>
                        </div>
                    </div>
                    <!-- card right -->
                    <div class="product-content" style="position: relative;">
                        <a href="{{ route('admin.dataMaster.show') }}" class="close-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                        <h2 class="product-title">{{ $alatBerat->nama }}</h2>
                        <a class="product-link">Stok : {{ $alatBerat->stok }}</a>

                        <div class="product-price">
                            <p class="new-price">Harga Sewa: <span>Rp {{ number_format($alatBerat->harga_sewa, 2, ',', '.') }} / hari</span></p>
                        </div>

                        <div class="product-detail">                          
                            <h2>merk : {{ $alatBerat->merk }}</h2>
                            <h2>Kode : {{ $alatBerat->kode }}</h2>
                            <h2>Description: </h2>
                            <p>{{ $alatBerat->deskripsi }}</p>
                        </div>
                        <h2 class="pt-2">action: </h2>
                        <div class="flex space-x-4 items-center">
                            <a href="{{ route('admin.edit', $alatBerat->id) }}" class="text-blue-500 hover:text-blue-600 flex items-center space-x-2">
                                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                </svg>
                                <span>Edit</span>
                            </a>
                            <a href="{{ route('admin.destroy', $alatBerat->id) }}" class="text-red-600 hover:text-red-700 flex items-center space-x-2" onclick="event.preventDefault(); showModal('{{ route('admin.destroy', $alatBerat->id) }}');">
                                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                </svg>
                                <span>Hapus</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<x-modal-delete id="popup-modal" action="{{ route('admin.destroy', $alatBerat->id) }}" />

<script>
    function showModal(actionUrl) {
        document.getElementById('popup-modal').classList.remove('hidden');
        document.getElementById('delete-form').action = actionUrl;
    }

    function hideModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
</script>
@endsection
