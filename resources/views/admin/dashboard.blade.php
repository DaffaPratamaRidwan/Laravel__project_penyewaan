@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="p-4">
            <div class="bg-white rounded-xl shadow-lg border-custom shadow-custom relative overflow-x-auto">
                <div class="bg-white dark:bg-gray-900 p-6">
                    <form action="{{ route('admin.search') }}" method="GET">
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="text" name="search" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                            <button type="submit" class="hidden"></button>
                        </div>
                    </form>
                </div>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-16 py-3">
                                <span class="sr-only">Image</span>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Product
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Harga Sewa
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alatBerats as $alatBerat)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="p-4">
                                    <a href="{{ route('admin.show', $alatBerat->id) }}">
                                        <img src="{{ asset('images/alats/' . $alatBerat->gambar) }}" class="w-16 md:w-32 max-w-full max-h-full object-cover rounded-lg" alt="{{ $alatBerat->nama }}">
                                    </a>
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{ $alatBerat->nama }} - {{ $alatBerat->merk }}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    Rp {{ number_format($alatBerat->harga_sewa, 2, ',', '.') }} / hari
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.show', $alatBerat->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a></br>
                                    <a href="{{ route('admin.edit', $alatBerat->id) }}" class="font-medium text-green-600 dark:text-green-500 hover:underline">Edit</a></br>
                                    <form action="{{ route('admin.destroy', $alatBerat->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline" onclick="return confirm('Anda yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                    <a href="#" class="font-medium text-green-600 dark:text-green-500 hover:underline" onclick="showModal()">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<a href="#" class="text-red-600 hover:text-red-700 flex items-center space-x-2" onclick="showModal()">
    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
    </svg>
    <span>Hapus</span>
</a>

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
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('table-search');
    const resultsTable = document.getElementById('results-table').getElementsByTagName('tbody')[0];

    searchInput.addEventListener('input', function() {
        const query = searchInput.value;

        if (query.length > 2) { // Perform search when query length is more than 2 characters
            fetch(`{{ route('admin.search') }}?search=${query}`)
                .then(response => response.json())
                .then(data => {
                    resultsTable.innerHTML = '';

                    if (data.length > 0) {
                        data.forEach(item => {
                            const row = document.createElement('tr');
                            row.className = 'bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600';

                            row.innerHTML = `
                                <td class="p-4">
                                    <a href="/admin/alat-berat/${item.id}">
                                        <img src="${item.gambar}" class="w-16 md:w-32 max-w-full max-h-full object-cover rounded-lg" alt="${item.nama}">
                                    </a>
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    ${item.nama} - ${item.merk}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    Rp ${item.harga_sewa.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')} / hari
                                </td>
                                <td class="px-6 py-4">
                                    <a href="/admin/alat-berat/${item.id}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a></br>
                                    <a href="/admin/alat-berat/${item.id}/edit" class="font-medium text-green-600 dark:text-green-500 hover:underline">Edit</a></br>
                                    <form action="/admin/alat-berat/${item.id}" method="POST" style="display: inline;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline" onclick="return confirm('Anda yakin ingin menghapus?')">Hapus</button>
                                    </form>
                                </td>
                            `;
                            resultsTable.appendChild(row);
                        });
                    } else {
                        resultsTable.innerHTML = '<tr><td colspan="4" class="text-center py-4">No results found.</td></tr>';
                    }
                });
        } else {
            resultsTable.innerHTML = '<tr><td colspan="4" class="text-center py-4">Please enter at least 3 characters to search.</td></tr>';
        }
    });
});
</script>
@endsection
@endsection
