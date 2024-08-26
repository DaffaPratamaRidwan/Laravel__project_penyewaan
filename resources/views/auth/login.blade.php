@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endpush

<x-guest-layout>
    
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- New SVG Icon inside the form -->
        <!-- <div class="relative z-[50] mb-6">
            <div class="absolute top-0 left-0 z-[50] transition-transform transform hover:scale-125 cursor-pointer opacity-70" id="openModal">
                <svg class="w-[20px] h-[20px] notice dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v5a1 1 0 1 0 2 0V8Zm-1 7a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H12Z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div> -->

        <!-- logo -->
        <div class="text-center mb-4 flex flex-col items-center mt-3">
            <x-application-logo class="w-12 h-12 fill-current text-gray-500" />
            <h2 class="text-2xl font-bold" style="font-size: 0.8rem;">{{ __('PT. Sarkon Bangun Nusantara') }}</h2>
            <div class="text-gray-600 mt-2 ">
                <h3 class="mb-1 welcome" >{{ __('Welcome back!') }}</h3>
                <p class="mb-1 details" >{{ __('Please enter your details') }}</p>
            </div>
        </div>

        <!-- Email Address -->
        <div class="input-group">
            <!-- <x-input-label for="email" :value="__('Email')" class="input-label"/> -->
            <x-text-input id="email" class="block mt-1 w-full input-field" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="email"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 input-group">
            <!-- <x-input-label for="password" :value="__('Password')" class="input-label"/> -->

            <x-text-input id="password" class="block mt-1 w-full input-field"
                            type="password"
                            name="password"
                            required autocomplete="current-password" 
                            placeholder="password"/>

            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                <svg id="eyeIconHidden" class="shrink-0 w-5 h-5 text-gray-500 block" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 9a3 3 0 1 0 3 3"></path>
                    <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                    <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                    <line x1="2" x2="22" y1="2" y2="22"></line>
                </svg>

                <svg id="eyeIconVisible" class="shrink-0 w-5 h-5 text-gray-500 hidden" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 5C5 5 2 12 2 12s3 7 10 7 10-7 10-7-3-7-10-7Z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                </svg>
            </button>
            
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-1 me-forget">
            <div class="flex items-center">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ml-2 text-sm text-gray-600" style="font-size: 0.8rem;">{{ __('Remember me') }}</span>
                </label>
            </div>

            
        </div>
        
        <div class="flex items-center justify-center mb-4">
            <x-primary-button class="w-full login-button">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="text-center signup ">
            <p class="inline-block text-dont">{{ __("Don't have an account?") }}</p>
            <a href="{{ route('register') }}" class="inline-block align-baseline font-bold text-sm text-blue-400 hover:text-blue-800 text-signup" style="font-size: 0.8rem;">
                {{ __('Sign up') }}
            </a>
        </div>
        
    </form>
    <!-- Overlay -->
    <div id="overlay" class="fixed inset-0 bg-gray-800 bg-opacity-50 z-40 hidden"></div>

    
</x-guest-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Password Toggle Script
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIconVisible = document.getElementById('eyeIconVisible');
        const eyeIconHidden = document.getElementById('eyeIconHidden');

        togglePassword.addEventListener('click', function () {
            // Toggle the type attribute of the password input
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;

            // Toggle the visibility of the SVG icons
            eyeIconVisible.classList.toggle('hidden');
            eyeIconHidden.classList.toggle('hidden');
        });

        // Modal Script
        const openModalButton = document.getElementById('openModal');
        const modal = document.getElementById('medium-modal');
        const overlay = document.getElementById('overlay');
        const closeModalButtons = document.querySelectorAll('[data-modal-hide="medium-modal"]');

        // Function to open modal and overlay
        function openModal() {
            modal.classList.remove('hidden');
            overlay.classList.remove('hidden');
        }

        // Function to close modal and overlay
        function closeModal() {
            modal.classList.add('hidden');
            overlay.classList.add('hidden');
        }

        // Open modal and overlay when page loads
        openModal();

        // Show modal and overlay
        openModalButton.addEventListener('click', openModal);

        // Hide modal and overlay
        closeModalButtons.forEach(button => {
            button.addEventListener('click', closeModal);
        });

        // Close modal and overlay when clicking outside
        window.addEventListener('click', function (event) {
            if (event.target === overlay) {
                closeModal();
            }
        });
    });
</script>


