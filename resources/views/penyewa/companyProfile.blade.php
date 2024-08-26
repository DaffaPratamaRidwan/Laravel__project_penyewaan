<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Perusahaan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/penyewa/companyProfile.css') }}">  
</head>
<body class="bg-motif ">

    <div class="box relative max-w-4xl mx-auto mt-8 p-6 bg-white border border-gray-500 rounded-lg shadow-lg ">
        <a href="{{ route('penyewa.dashboard') }}" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 18L18 6M6 6l12 12" />
            </svg>
        </a>
        <x-application-logo class="mt-5 w-16 h-16 fill-current text-gray-500" />
        <h1 class="text-2xl font-bold mb-4 ">PT. Sarkon Bangun Nusantara</h1>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Deskripsi:</label>
            <p class="text-gray-600">Perusahaan kami bergerak di bidang penyewaan alat berat dengan berbagai macam jenis dan tipe alat yang siap digunakan untuk proyek-proyek besar dan kecil.</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Email:</label>
            <p class="text-gray-600">info@perusahaan.com</p>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Kontak:</label>
            <p class="text-gray-600">+62 123 456 7890</p>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Lokasi (maps):</label>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.737008068397!2d107.01851897499097!3d-6.298248993690868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69918ff5677f37%3A0x769fd0d76a10950b!2sPT.%20Sarkon%20Bangun%20Permata%20%2F%20PT.%20Sarkon%20Bangun%20Nusantara%20%2F%20PT.%20Agung%20Wijaya%20Sisteam!5e0!3m2!1sen!2sid!4v1723572452084!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>

</body>
</html>
