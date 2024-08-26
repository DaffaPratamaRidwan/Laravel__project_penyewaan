@push('styles')
    <link rel="stylesheet" href="{{ asset('css/component/sidebar.css') }}">
@endpush
@if (Auth::check() && (Auth::user()->role->name == 'penyewa' || Auth::user()->role->name == 'admin'|| Auth::user()->role->name == 'direktur operasional'))
<aside id="logo-sidebar"  class="fixed top-20 left-3 z-40 w-64 h-screen pt-3 rounded-xl transition-transform -translate-x-full bg-white border-custom shadow-custom sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @if (Auth::user()->role->name == 'penyewa')
                <li>
                    <a href="{{ route('penyewa.dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ Route::currentRouteName() == 'penyewa.dashboard' ? 'sidebar-item-active' : 'text-gray-900' }}">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                            <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" fill="#392676"/>
                            <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" fill="#392676"/>
                        </svg>
                        <span class="ms-3 text-custom-392676">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('penyewa.sewa') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ Route::currentRouteName() == 'penyewa.sewa' ? 'sidebar-item-active' : 'text-gray-900' }}">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                            <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" fill="#392676"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap text-custom-392676">Sewa Alat Berat</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('penyewa.sewa.aktif') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ Route::currentRouteName() == 'penyewa.sewa.aktif' ? 'sidebar-item-active' : 'text-gray-900' }}">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#392676" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 0 0-1 1H6a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-2a1 1 0 0 0-1-1H9Zm1 2h4v2h1a1 1 0 1 1 0 2H9a1 1 0 0 1 0-2h1V4Zm5.707 8.707a1 1 0 0 0-1.414-1.414L11 14.586l-1.293-1.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap text-custom-392676">Status Sewa</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('penyewa.pengembalian.form') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ Route::currentRouteName() == 'penyewa.pengembalian.form' ? 'sidebar-item-active' : 'text-gray-900' }}">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#392676" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M3 6a2 2 0 0 1 2-2h5.532a2 2 0 0 1 1.536.72l1.9 2.28H3V6Zm0 3v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9H3Z" clip-rule="evenodd"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap text-custom-392676">Ajukan Pengembalian</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('penyewa.companyProfile') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ Route::currentRouteName() == 'penyewa.companyProfile' ? 'sidebar-item-active' : 'text-gray-900' }}">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L13 5.793V2.5a.5.5 0 0 1-.5-.5h-1a.5.5 0 0 1-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 1-.5-.5h-3a.5.5 0 0 1-.5.5v4z" fill="#392676"/>
                            <path d="M2 11h1v1H2zm2 0h1v1H4zm-2 2h1v1H2zm2 0h1v1H4zm4-4h1v1H8zm2 0h1v1h-1zm-2 2h1v1H8zm2 0h1v1h-1zm2-2h1v1h-1zm0 2h1v1h-1z" fill="#392676"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap text-custom-392676">Profil Perusahaan</span>
                    </a>
                </li>
            @elseif(Auth::user()->role->name == 'admin')
                <li>
                    <a href="{{ route('admin.dataMaster.show') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ Route::currentRouteName() == 'penyewa.dashboard' ? 'sidebar-item-active' : 'text-gray-900' }}">                       
                        <svg class="w-6 h-6 text-custom-392676 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-3 5h3m-6 0h.01M12 16h3m-6 0h.01M10 3v4h4V3h-4Z"/>
                        </svg>
                        <span class="ms-3 text-custom-392676 text-custom-392676">Data Master</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.create') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ Route::currentRouteName() == 'penyewa.sewa' ? 'sidebar-item-active' : 'text-gray-900' }}">                     
                        <svg class="w-6 h-6 text-custom-392676 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 8H4m8 3.5v5M9.5 14h5M4 6v13a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1h-5.032a1 1 0 0 1-.768-.36l-1.9-2.28a1 1 0 0 0-.768-.36H5a1 1 0 0 0-1 1Z"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap text-custom-392676">Tambah Alat Berat</span>
                    </a>
                </li>               
                <!-- <li>
                    <a href="{{ route('admin.bayar') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ Route::currentRouteName() == 'penyewa.pengembalian.form' ? 'sidebar-item-active' : 'text-gray-900' }}">                        
                        <svg class="w-6 h-6 text-custom-392676 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M8 7V6a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1M3 18v-7a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap text-custom-392676">Daftar Pembayaran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.sewa') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ Route::currentRouteName() == 'penyewa.pengembalian.form' ? 'sidebar-item-active' : 'text-gray-900' }}">                        
                        <svg class="w-6 h-6 text-custom-392676 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.03v13m0-13c-2.819-.831-4.715-1.076-8.029-1.023A.99.99 0 0 0 3 6v11c0 .563.466 1.014 1.03 1.007 3.122-.043 5.018.212 7.97 1.023m0-13c2.819-.831 4.715-1.076 8.029-1.023A.99.99 0 0 1 21 6v11c0 .563-.466 1.014-1.03 1.007-3.122-.043-5.018.212-7.97 1.023"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap text-custom-392676">Daftar Penyewaan</span>
                    </a>
                </li> -->
                <li>
                    <a href="{{ route('admin.sewa.aktif') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ Route::currentRouteName() == 'penyewa.companyProfile' ? 'sidebar-item-active' : 'text-gray-900' }}">                       
                        <svg class="w-6 h-6 text-custom-392676 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 4h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h3m0 3h6m-6 7 2 2 4-4m-5-9v4h4V3h-4Z"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap text-custom-392676">Sewa Aktif</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pengembalian.approval') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ Route::currentRouteName() == 'penyewa.companyProfile' ? 'sidebar-item-active' : 'text-gray-900' }}">                       
                        <svg class="w-6 h-6 text-custom-392676 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M10 12v1h4v-1m4 7H6a1 1 0 0 1-1-1V9h14v9a1 1 0 0 1-1 1ZM4 5h16a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap text-custom-392676">Daftar Pengembalian</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.riwayat') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ Route::currentRouteName() == 'penyewa.companyProfile' ? 'sidebar-item-active' : 'text-gray-900' }}">                     
                        <svg class="w-6 h-6 text-custom-392676 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.03v13m0-13c-2.819-.831-4.715-1.076-8.029-1.023A.99.99 0 0 0 3 6v11c0 .563.466 1.014 1.03 1.007 3.122-.043 5.018.212 7.97 1.023m0-13c2.819-.831 4.715-1.076 8.029-1.023A.99.99 0 0 1 21 6v11c0 .563-.466 1.014-1.03 1.007-3.122-.043-5.018.212-7.97 1.023"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap text-custom-392676">Riwayat</span>
                    </a>
                </li>
            @elseif(Auth::user()->role->name == 'direktur operasional')
                <li>
                    <a href="{{ route('admin.sewa') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ Route::currentRouteName() == 'penyewa.pengembalian.form' ? 'sidebar-item-active' : 'text-gray-900' }}">                        
                        <svg class="w-6 h-6 text-custom-392676 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.03v13m0-13c-2.819-.831-4.715-1.076-8.029-1.023A.99.99 0 0 0 3 6v11c0 .563.466 1.014 1.03 1.007 3.122-.043 5.018.212 7.97 1.023m0-13c2.819-.831 4.715-1.076 8.029-1.023A.99.99 0 0 1 21 6v11c0 .563-.466 1.014-1.03 1.007-3.122-.043-5.018.212-7.97 1.023"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap text-custom-392676">Daftar Penyewaan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.riwayat') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ Route::currentRouteName() == 'penyewa.companyProfile' ? 'sidebar-item-active' : 'text-gray-900' }}">                     
                        <svg class="w-6 h-6 text-custom-392676 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.03v13m0-13c-2.819-.831-4.715-1.076-8.029-1.023A.99.99 0 0 0 3 6v11c0 .563.466 1.014 1.03 1.007 3.122-.043 5.018.212 7.97 1.023m0-13c2.819-.831 4.715-1.076 8.029-1.023A.99.99 0 0 1 21 6v11c0 .563-.466 1.014-1.03 1.007-3.122-.043-5.018.212-7.97 1.023"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap text-custom-392676">Riwayat</span>
                    </a>
                </li>
            @endif   
        </ul>
    </div>
</aside>
@endif

