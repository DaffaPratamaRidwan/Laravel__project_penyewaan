@push('styles')
    <link rel="stylesheet" href="{{ asset('css/layout/navigation.css') }}">
@endpush

<nav x-data="{ open: false }" class="realtive fixed top-3 left-3 z-3 w-7/8 bg-white rounded-lg border-custom shadow-custom">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <!-- Sidebar Toggle -->
                <button 
                    @click="open = !open" 
                    aria-controls="logo-sidebar" 
                    type="button" 
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                >
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path 
                            clip-rule="evenodd" 
                            fill-rule="evenodd" 
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
                        ></path>
                    </svg>
                </button>
                @if (Auth::check())
                    @php
                        $roleName = Auth::user()->role->name;
                    @endphp

                    @if ($roleName == 'penyewa')
                        <a href="{{ route('penyewa.dashboard') }}" class="block">
                            <x-application-logo class="block h-8 w-auto fill-current text-gray-800 pl-3" />
                        </a>
                    @elseif ($roleName == 'admin')
                        <a href="{{ route('admin.dataMaster.show') }}" class="block">
                            <x-application-logo class="block h-8 w-auto fill-current text-gray-800 pl-3" />
                        </a>
                    @elseif ($roleName == 'direktur keuangan')
                        <a href="{{ route('admin.bayar') }}" class="block">
                            <x-application-logo class="block h-8 w-auto fill-current text-gray-800 pl-3" />
                        </a>
                    @elseif ($roleName == 'direktur operasional')
                        <a href="{{ route('admin.sewa') }}" class="block">
                            <x-application-logo class="block h-8 w-auto fill-current text-gray-800 pl-3" />
                        </a>
                    @elseif ($roleName == 'project manager')
                        <a href="{{ route('admin.pengembalian.approval') }}" class="block">
                            <x-application-logo class="block h-8 w-auto fill-current text-gray-800 pl-3" />
                        </a>
                    @endif
                @endif
                <span class="self-center text-lg font-bold sm:text-2lg whitespace-nowrap dark:text-white ms-2 bg-gradient-to-l from-red-500 via-red-600 to-custom-392676 bg-clip-text text-transparent">
                    PT. Sarkon Bangun Nusantara
                </span>
            </div>
            <div class="flex items-center">
                <x-notification-dropdown />
                <div class="flex items-center ms-3">
                    
                    <div>
                        <button 
                            type="button" 
                            class="flex text-sm" 
                            aria-expanded="false" 
                            data-dropdown-toggle="dropdown-user"
                        >
                            <span class="sr-only">Open user menu</span>
                            <a 
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-custom-392676 focus:outline-none transition ease-in-out duration-150"
                            >
                                <div>{{ Auth::user()->name }}</div>
                            </a>
                        </button>
                    </div>
                    <div 
                        class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600" 
                        id="dropdown-user"
                    >
                        <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 dark:text-white" role="none">{{ Auth::user()->name }}</p>
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">{{ Auth::user()->nama_perusahaan }}</p>
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">({{ Auth::user()->role->name }})</p>
                        </div>
                        <ul class="py-1" role="none">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <a 
                                        href="#" 
                                        onclick="event.preventDefault(); this.closest('form').submit();" 
                                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                                    >
                                        <span class="ms-3">Logout</span>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='absolute bottom-0 left-0 w-full h-2 bg-custom-392676 rounded-b-lg z-1'></div>
</nav>

<div :class="{ 'block': open, 'hidden': !open }" id="sidebar" class="fixed inset-0 z-40 w-64 bg-gray-800 h-full overflow-y-auto lg:relative lg:block lg:w-64 lg:ml-0 md:hidden md:flex md:items-start">
    @include('components.sidebar')
</div>
