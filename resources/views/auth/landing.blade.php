<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth/landingPage.css') }}">  
</head>
<body class="bg-motif ">
    <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/logo/logo.png') }}" class="h-8" alt="">
                <span class="self-center text-xl font-bold whitespace-nowrap dark:text-white ">PT. Sarkon Bangun Nusantara</span>
            </a>
            <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <a href="{{ route('login') }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</a>
                <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="#home" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Home</a>
                </li>
                <li>
                    <a href="#about" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About</a>
                </li>
                <li>
                    <a href="#services" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Services</a>
                </li>
                <li>
                    <a href="#product" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Product</a>
                </li>
                <li>
                    <a href="#contact" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contact</a>
                </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Home Section -->
    <section id="home" class="w-full overflow-hidden rise bg-cover bg-center h-screen" style="background-image: url('/images/background/background.jpg');">
        <div class="container mx-auto flex items-center justify-start h-full ">
            <div class="text-left bg-white bg-opacity-50 p-8 rounded-lg ml-20 max-w-xl">
                <h2 class="text-4xl font-bold text-blue-800">Solusi terbaik untuk proyek konstruksi Anda</h2>
                <p class="text-lg  text-gray-700">berkomitmen & dapat diandalkan</p>
                <a href="{{ route('login') }}" class="mt-5 inline-block bg-blue-800 text-white px-6 py-2 rounded-md hover:bg-blue-600">Login</a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="w-full overflow-hidden rise py-20 bg-gray-100 dark:bg-gray-900">
        <div class="container mx-auto mb-5">
            <h2 class="text-3xl font-bold text-center text-blue-800">Tentang Kami</h2>
            <p class="mt-4 text-center text-gray-600">Kami adalah perusahaan penyedia alat berat dengan pengalaman bertahun-tahun dalam industri konstruksi. <br>Kami menyediakan alat berat berkualitas tinggi untuk berbagai jenis proyek konstruksi.</p>
        </div>
    </section>

    <section class="w-full overflow-hidden rise mb-10 mt-10">
        <div class="container mx-auto ml-40">
            <h2 class=" text-3xl font-bold text-blue-800 ">Ingin Menyewa?</h2>
            <p class="mt-4 text-xl text-gray-600">berikut prosedurnya</p>
        </div>
        <div class="flex justify-center">
            <ol class="flex flex-col sm:flex-row items-center sm:justify-center">
                <li class="relative mb-6 sm:mb-0 w-full sm:w-1/4 ">
                    <div class="flex items-center justify-center">
                        <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <span class="text-xs font-bold text-blue-800 dark:text-blue-300">1</span>
                        </div>
                        <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3 sm:pe-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white text-start">Penyewaan</h3>
                        <ul class="list-disc pl-5 text-base leading-relaxed text-gray-500 dark:text-gray-400 text-left ">
                            <li>Penyewaan dapat dilakukan melalui website dengan login, dan mengisi form penyewaan</li>
                            <li>Penyewaan dapat dilakukan minimal 3 hari</li>
                            <li>Pengiriman akan segera diproses setelah melakukan proses penyewaan</li>
                        </ul>
                    </div>
                </li>
                <li class="relative mb-6 sm:mb-0 w-full sm:w-1/4">
                    <div class="flex items-center justify-center">
                        <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <span class="text-xs font-bold text-blue-800 dark:text-blue-300">2</span>
                        </div>
                        <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3 sm:pe-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white text-start">Pembayaran</h3>
                        <ul class="list-disc pl-5 text-base leading-relaxed text-gray-500 dark:text-gray-400 text-left">
                            <li>Pembayaran hanya dapat dilakukan melalui Transfer</li>
                            <li>Pembayaran dilakukan setelah mengisi form penyewaan</li>
                            <li class="text-transparent"></li>
                        </ul>
                    </div>
                </li>
                <li class="relative mb-6 sm:mb-0 w-full sm:w-1/4 ">
                    <div class="flex items-center justify-center mt-20">
                        <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <span class="text-xs font-bold text-blue-800 dark:text-blue-300">3</span>
                        </div>
                        <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3 sm:pe-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white text-start">Pengembalian</h3>
                        <ul class="list-disc pl-5 text-base leading-relaxed text-gray-500 dark:text-gray-400 text-left">
                            <li>Proses pengembalian akan dilakukan penjemputan oleh perusahaan</li>
                            <li>Proses pengembalian dapat diakses melalui laman pengembalian</li>
                            <li>Pengembalian akan muncul jika sudah melakukan penyewaan</li>
                            <li>Keterlambatan akan dikenai denda sebesar tarif harian + 30% dari total harga.</li>
                        </ul>
                    </div>
                </li>
            </ol>
        </div>
    </section>

    <!-- service section -->
    <section id="services" class="w-full overflow-hidden rise bg-gray-100 dark:bg-gray-900">
        <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
            <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-blue-800 dark:text-white">We didn't reinvent the wheel</h2>
                <p class="mb-4 ">We are strategists, designers and developers. Innovators and problem solvers. Small enough to be simple and quick, but big enough to deliver the scope you want at the pace you need. Small enough to be simple and quick, but big enough to deliver the scope you want at the pace you need.</p>
                <p>We are strategists, designers and developers. Innovators and problem solvers. Small enough to be simple and quick.</p>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-8">
                <img class="w-full rounded-lg" src="{{ asset('images/background/candid.jpg') }}" alt="office content 1">
                <img class="mt-4 w-full lg:mt-10 rounded-lg" src="{{ asset('images/background/mesin.jpg') }}" alt="office content 2">
            </div>
        </div>
    </section>

    <!-- product section -->
    
    <section class="w-full overflow-hidden rise product" id="product"> 
        <h2 class="product-category text-blue-800">produk</h2>
        <button class="pre-btn ">
            <svg class="w-6 h-6 text-gray-800 dark:text-white transform rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/>
            </svg>
        </button>
        <button class="nxt-btn">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
            </svg>
        </button>
        <div class="product-container">
            @foreach($alatBerats as $alatBerat)
            <div class="product-card">            
                <div class="product-image">
                    <img src="{{ asset('images/alats/' . $alatBerat->gambar) }}" alt="{{ $alatBerat->nama }}" class="product-thumb" alt="">
                </div>
                <div class="product-info">
                    <h2 class="product-brand">{{ $alatBerat->nama }}</h2>
                    <p class="product-short-description">{{ $alatBerat->merk }}</p>
                    <span class="price">Rp {{ number_format($alatBerat->harga_sewa, 2, ',', '.') }} / hari</span>
                </div>  
            </div>
            @endforeach
    </section>

    <!-- contact -->
    <section class="w-full overflow-hidden rise bg-gray-100 p-6" id="contact">
        <div class="container mx-auto max-w-4xl">
            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 w-full mb-4 md:mb-0">  
                    <h1 class="product-category text-blue-800 text-start">Alamat</h1>                 
                    <div class="flex flex-col items-start">
                        <div class="flex items-start mb-5">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-sm">
                                Sarkon Bangun Nusantara <br>
                                Jalan Budi Gg. Budi 1, Jl. Raya Cilember Kel No.16,<br>
                                RT.02/RW.03, Sukaraja, Kec. Cicendo,<br>
                                Kota Bandung, Jawa Barat 40175
                            </p>
                        </div>
                        <div class="flex items-start mb-5">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-sm">
                                <span class="flex items-center justify-between">
                                    <span>Monday </span>
                                    <span class="ml-2">: 8.00 am–6.00 pm</span>
                                </span>
                                <span class="flex items-center justify-between">
                                    <span>Tuesday </span>
                                    <span class="ml-2">: 8.00 am–6.00 pm</span>
                                </span>
                                <span class="flex items-center justify-between">
                                    <span>Wednesday </span>
                                    <span class="ml-2">: 8.00 am–6.00 pm</span>
                                </span>
                                <span class="flex items-center justify-between">
                                    <span>Thursday </span>
                                    <span class="ml-2">: 8.00 am–6.00 pm</span>
                                </span>
                                <span class="flex items-center justify-between">
                                    <span>Friday </span>
                                    <span class="ml-2">: 8.00 am–6.00 pm</span>
                                </span>
                                <span class="flex items-center justify-between">
                                    <span>Saturday </span>
                                    <span class="ml-2">: 8.00 am–4.00 pm</span>
                                </span>
                                <span class="flex items-center justify-between">
                                    <span>Sunday:</span>
                                    <span class="ml-2">Closed</span>
                                </span>
                            </p>
                        </div>
                        <div class="flex items-start mb-2">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7.978 4a2.553 2.553 0 0 0-1.926.877C4.233 6.7 3.699 8.751 4.153 10.814c.44 1.995 1.778 3.893 3.456 5.572 1.68 1.679 3.577 3.018 5.57 3.459 2.062.456 4.115-.073 5.94-1.885a2.556 2.556 0 0 0 .001-3.861l-1.21-1.21a2.689 2.689 0 0 0-3.802 0l-.617.618a.806.806 0 0 1-1.14 0l-1.854-1.855a.807.807 0 0 1 0-1.14l.618-.62a2.692 2.692 0 0 0 0-3.803l-1.21-1.211A2.555 2.555 0 0 0 7.978 4Z"/>
                            </svg>
                            <p class="text-sm">
                                081227738867
                            </p>
                        </div>
                        <div class="flex items-start mb-2">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24" id="email">
                                <path d="M14.608 12.172c0 .84.239 1.175.864 1.175 1.393 0 2.28-1.775 2.28-4.727 0-4.512-3.288-6.672-7.393-6.672-4.223 0-8.064 2.832-8.064 8.184 0 5.112 3.36 7.896 8.52 7.896 1.752 0 2.928-.192 4.727-.792l.386 1.607c-1.776.577-3.674.744-5.137.744-6.768 0-10.393-3.72-10.393-9.456 0-5.784 4.201-9.72 9.985-9.72 6.024 0 9.215 3.6 9.215 8.016 0 3.744-1.175 6.6-4.871 6.6-1.681 0-2.784-.672-2.928-2.161-.432 1.656-1.584 2.161-3.145 2.161-2.088 0-3.84-1.609-3.84-4.848 0-3.264 1.537-5.28 4.297-5.28 1.464 0 2.376.576 2.782 1.488l.697-1.272h2.016v7.057h.002zm-2.951-3.168c0-1.319-.985-1.872-1.801-1.872-.888 0-1.871.719-1.871 2.832 0 1.68.744 2.616 1.871 2.616.792 0 1.801-.504 1.801-1.896v-1.68z"></path>
                            </svg>
                            <p class="text-sm">
                                info@sarkonbangunnusantara.com
                            </p>
                        </div>
                    </div>
                </div>
                <div class="md:w-1/2 w-full">
                    <div class="relative">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.737008068397!2d107.01851897499097!3d-6.298248993690868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69918ff5677f37%3A0x769fd0d76a10950b!2sPT.%20Sarkon%20Bangun%20Permata%20%2F%20PT.%20Sarkon%20Bangun%20Nusantara%20%2F%20PT.%20Agung%20Wijaya%20Sisteam!5e0!3m2!1sen!2sid!4v1723572452084!5m2!1sen!2sid"
                            width="650" height="500" style="border:0; border-radius: 10px;" allowfullscreen=""
                            loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="w-full overflow-hidden rise bg-white text-black ">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="https://flowbite.com/" class="flex items-center">
                        <img src="{{ asset('images/logo/logo.png') }}" class="h-8" alt="">
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">PT Sarkon Bangun Nusantara</span>
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Resources</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="" class="hover:underline">Flowbite</a>
                            </li>
                            <li>
                                <a href="" class="hover:underline">Tailwind CSS</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Follow us</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="" class="hover:underline ">Github</a>
                            </li>
                            <li>
                                <a href="" class="hover:underline">Discord</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal</h2>
                        <ul class="text-gray-500 dark:text-gray-400 font-medium">
                            <li class="mb-4">
                                <a href="#" class="hover:underline">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>     
        </div>
    </footer>

    <div class="w-full overflow-hidden text-center bg-gray-500 text-white py-2 mt-3">
        <p class="mb-0">&copy; PT Sarkon Bangun Nusantara. All Rights Reserved.</p>
    </div>


</body>
</html>
<script>
    const productContainers = [...document.querySelectorAll('.product-container')];
    const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
    const preBtn = [...document.querySelectorAll('.pre-btn')];

    productContainers.forEach((item, i) => {
        let containerDimensions = item.getBoundingClientRect();
        let containerWidth = containerDimensions.width;

        nxtBtn[i].addEventListener('click', () => {
            item.scrollLeft += containerWidth;
        })

        preBtn[i].addEventListener('click', () => {
            item.scrollLeft -= containerWidth;
        })
    })

    document.addEventListener('DOMContentLoaded', () => {
        // Ambil semua tautan dengan href yang mengarah ke ID section
        const links = document.querySelectorAll('a[href^="#"]');

        // Tambahkan event listener untuk setiap tautan
        links.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault(); // Cegah perilaku default tautan

                // Ambil target section dari atribut href
                const targetId = link.getAttribute('href');
                const targetSection = document.querySelector(targetId);

                // Scroll ke target section
                if (targetSection) {
                    window.scrollTo({
                        top: targetSection.offsetTop,
                        behavior: 'smooth' // Tambahkan efek scroll halus
                    });
                }
            });
        });

        const sections = document.querySelectorAll('.rise');

        const showSection = () => {
            const triggerBottom = window.innerHeight / 5 * 4;

            sections.forEach(section => {
                const sectionTop = section.getBoundingClientRect().top;

                if (sectionTop < triggerBottom) {
                    section.classList.add('visible');
                } else {
                    section.classList.remove('visible');
                }
            });
        };

        window.addEventListener('scroll', showSection);
        showSection(); 
    });
</script>


