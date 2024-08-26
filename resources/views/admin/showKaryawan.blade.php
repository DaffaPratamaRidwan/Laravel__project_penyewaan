@extends('layouts.app')

@section('content')
<div class="container pt-3">
    <div class="bg-white shadow-md rounded-md p-6">
        <h2 class="text-xl font-semibold text-gray-900">Daftar Karyawan</h2>
        <a href="{{ route('admin.karyawan.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md mb-4 inline-block">Tambah Karyawan</a>
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIP</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($karyawans as $karyawan)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $karyawan->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $karyawan->nip }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <form action="{{ route('admin.karyawan.destroy', $karyawan->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
