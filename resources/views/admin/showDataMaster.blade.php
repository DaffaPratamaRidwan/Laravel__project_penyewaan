@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="p-4">
            <!-- alat berat -->
            <div class="bg-white rounded-xl shadow-lg border-custom shadow-custom relative overflow-x-auto h-140">
                <div class="bg-white dark:bg-gray-900 pt-6 pr-6 pl-6 pb-3">
                    <form action="{{ route('admin.search') }}" method="GET" class="flex items-center gap-4">
                        <label for="table-search" class="sr-only">Search</label>
                        <!-- Search Input -->
                        <div class="relative flex-grow max-w-md">
                            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="text" name="search" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-full bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
                            <button type="submit" class="hidden"></button>
                        </div>
                        
                        <!-- Tambah Button -->
                        <a href="{{ route('admin.create') }}" class="inline-flex justify-center px-4 py-2 text-white bg-blue-600 border border-transparent rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-400 ml-auto">
                            Tambah
                        </a>
                    </form>
                </div>
                
                <div class="overflow-y-auto max-h-[30rem] scrollbar">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <caption class="p-2 text-2xl font-semibold text-gray-900 dark:bg-gray-800 dark:text-white border-b border-custom-392676 dark:border-custom-392676 sticky top-0 z-20 bg-white dark:bg-gray-800">
                            Daftar Alat Berat
                        </caption>
                        <thead class="text-xs text-black uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 sticky top-12 z-10">
                            <tr>
                                <th scope="col" class="px-16 py-3">
                                    <span class="sr-only">Image</span>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Product
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Kode
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Stok
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
                                        {{ $alatBerat->nama }} - {{ $alatBerat->merk }}<br>
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                        {{ $alatBerat->kode }}
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                        {{ $alatBerat->stok }}
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                        Rp {{ number_format($alatBerat->harga_sewa, 2, ',', '.') }} / hari
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('admin.show', $alatBerat->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detail</a></br>
                                        <a href="{{ route('admin.edit', $alatBerat->id) }}" class="font-medium text-green-600 dark:text-green-500 hover:underline">Edit</a></br>
                                        <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline" onclick="showModal('{{ route('admin.destroy', $alatBerat->id) }}')">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br></br>
            <!-- karyawan -->

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg border-custom shadow-custom h-140">
                <div class="sticky top-0 z-[19] bg-white dark:bg-gray-800">
                    <a href="{{ route('admin.karyawan.create') }}" class="inline-flex justify-center px-4 py-2 text-white bg-blue-600 border border-transparent rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-400 absolute top-6 right-8">
                        Tambah
                    </a>
                </div>
                
                <div class="overflow-y-auto max-h-[30rem] scrollbar">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <caption class="sticky top-0 z-[18] p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                            <svg class="w-[48px] h-[48px] text-gray-800 dark:text-white mr-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                            </svg>
                            Daftar Karyawan
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">list daftar karyawan PT. Sarkon Bangun Nusantara</p>
                        </caption>
                        <thead class="sticky top-[140px] z-[19] text-xs text-black uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nama
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    NIP
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    ACTION
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($karyawans as $karyawan)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $karyawan->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $karyawan->nip }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline" onclick="showModal('{{ route('admin.karyawan.destroy', $karyawan->id) }}')">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-2 bg-white dark:text-white dark:bg-gray-800">
                    </div>
                </div>     
            </div>
            <br></br>
            <!-- daftar kendaraan pengantar -->
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg border-custom shadow-custom h-140">
                <div class="sticky top-0 z-[19] bg-white dark:bg-gray-800">
                    <a href="{{ route('admin.kendaraanPengantar.create') }}" class="inline-flex justify-center px-4 py-2 text-white bg-blue-600 border border-transparent rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-400 absolute top-6 right-8">
                        Tambah
                    </a>
                </div>

                <div class="overflow-y-auto max-h-[30rem] scrollbar">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <caption class="sticky top-0 z-[18] p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                            <svg class="w-[48px] h-[48px] text-gray-800 dark:text-white mr-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z" clip-rule="evenodd"/>
                            </svg>
                            Daftar Kendaraan Pengantar
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">list daftar kendaraan pengantar PT. Sarkon Bangun Nusantara</p>
                        </caption>
                        <thead class="sticky top-[140px] z-[19] text-xs text-black uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Jenis
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    No-POL
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    ACTION
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kendaraanPengantars as $kendaraanPengantar)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $kendaraanPengantar->jenis }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $kendaraanPengantar->no_pol }}
                                </td>
                                <td class="px-6 py-4">
                                    <!-- <form action="{{ route('admin.karyawan.destroy', $karyawan->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline" onclick="return confirm('Anda yakin ingin menghapus?')">Hapus</button>
                                    </form> -->
                                    <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline" onclick="showModal('{{ route('admin.kendaraanPengantar.destroy', $kendaraanPengantar->id) }}')">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-2 bg-white dark:text-white dark:bg-gray-800">
                    </div>
                </div>
                
            </div>
            <br></br>
            <!-- user -->
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg border-custom shadow-custom h-140">
                <div class="sticky top-0 z-[19] bg-white dark:bg-gray-800">
                    <a href="{{ route('admin.user.create') }}" class="inline-flex justify-center px-4 py-2 text-white bg-blue-600 border border-transparent rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-400 absolute top-6 right-8">
                        Tambah
                    </a>
                </div>
                <div class="overflow-y-auto max-h-[30rem] scrollbar">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <caption class="sticky top-0 z-[18] p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                            <svg class="w-[48px] h-[48px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="1.6" d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z"/>
                            </svg>
                            List User
                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">List User Aplikasi PT. Sarkon Bangun Nusantara</p>
                        </caption>
                        <thead class="sticky top-[140px] z-[19] text-xs text-black uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nama
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Role
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $user->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('admin.user.editRole', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="role_id" class="form-control mt-1 px-3 py-2 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <!-- <button type="submit" class="btn btn-primary mt-2">Update</button> -->
                                        <button type="submit" class="font-medium text-blue-600 dark:text-red-500 hover:underline">Update</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-2 bg-white dark:text-white dark:bg-gray-800">
                    </div>
                </div>      
            </div>
        </div>
    </div>
</div>

<x-delete-modal2 modalId="delete-modal" formId="delete-form" />
<script>
    function showModal(actionUrl) {
        document.getElementById('delete-modal').classList.remove('hidden');
        document.getElementById('delete-form').action = actionUrl;
    }

    function closeModal() {
        document.getElementById('delete-modal').classList.add('hidden');
    }
</script>

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
