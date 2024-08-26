<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PT Sarkon Bangun Nusantara') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @notifyCss
        @stack('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="{{ asset('js/component/notification.js') }}" defer></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="{{ asset('css/custom-notify.css') }}" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.x.x/dist/alpine.min.js" defer></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body class="font-sans antialiased ">

        <div class="min-h-screen bg-custom-f3f3f3 bg-motif">
            <nav x-data="{ open: false }" class="bg-white border-b border-gray-100 fixed top-0 w-full z-30">
                @include('layouts.navigation')
            </nav>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white z-20">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- dibuat hanya untuk menghilang bagian atas top header -->
            <header class="bg-motif fixed w-full z-10">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                </div>
            </header>

            <!-- Page Content -->
            @if (Auth::user()->role->name == 'penyewa' || Auth::user()->role->name == 'admin'|| Auth::user()->role->name == 'direktur operasional')
                <main class="pt-16 pl-60 z-10">
                    <div class="mx-auto px-7 py-1 sm:px-6 lg:px-8 ">
                        @yield('content')
                    </div>      
                </main>
            @else
                <main class="pt-16 z-10">
                    <div class="mx-auto px-7 py-1 sm:px-6 lg:px-8 ">
                        @yield('content')
                    </div>      
                </main>
            @endif

            <!-- Notifications -->
            @if (session('success') || session('error') || session('warning'))
            <script>
                window.toastMessages = {
                    success: @json(session('success')),
                    error: @json(session('error')),
                    warning: @json(session('warning')),
                };
            </script>
            @endif
            <x-notify::notify class="z-40 notify"/>
            @include('notify::components.notify')
            @notifyJs
        </div>
    </body>
    
</html>
