@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endpush

<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- logo -->
        <div class="text-center mb-4 flex flex-col items-center">
            <x-application-logo class="w-12 h-12 fill-current text-gray-500" />
            <h2 class="text-2xl font-bold" style="font-size: 0.8rem;">{{ __('PT. Sarkon Bangun Nusantara') }}</h2>
            <div class="text-gray-600 mt-2 ">
                <h3 class="mb-1 text-create" >{{ __('Create an account') }}</h3>
                <p class="mb-1 details" >{{ __('Please enter your details') }}</p>
            </div>
        </div>

        <!-- Name -->
        <div>
            <div class="input-group">
                <!-- <x-input-label for="name" :value="__('Name')" class="input-label"/> -->
                <x-text-input id="name" class="block mt-1 w-full input-field" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Name" />    
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Nama perusahaan -->
        <div>
            <div class="mt-4 input-group">
                <x-text-input id="nama_perusahaan" class="block mt-1 w-full input-field" type="text" name="nama_perusahaan" :value="old('nama_perusahaan')" required autofocus autocomplete="nama_perusahaan" placeholder="Company Name" />    
            </div>
            <x-input-error :messages="$errors->get('nama_perusahaan')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4 input-group">
            <!-- <x-input-label for="email" :value="__('Email')" class="input-label"/> -->
            <x-text-input id="email" class="block mt-1 w-full input-field" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 input-group">
            <!-- <x-input-label for="password" :value="__('Password')" class="input-label"/> -->

            <x-text-input id="password" class="block mt-1 w-full input-field"
                            type="password"
                            name="password"
                            required autocomplete="new-password" 
                            placeholder="Password"/>

            <!-- Toggle Button for Password -->
            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                <!-- Eye icon when password is hidden -->
                <svg id="eyeIconHidden" class="shrink-0 w-5 h-5 text-gray-500 block" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 9a3 3 0 1 0 3 3"></path>
                    <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                    <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                    <line x1="2" x2="22" y1="2" y2="22"></line>
                </svg>

                <!-- Eye icon when password is visible -->
                <svg id="eyeIconVisible" class="shrink-0 w-5 h-5 text-gray-500 hidden" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 5C5 5 2 12 2 12s3 7 10 7 10-7 10-7-3-7-10-7Z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                </svg>
            </button>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 input-group">
            <!-- <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="input-label"/> -->

            <x-text-input id="password_confirmation" class="block mt-1 w-full input-field"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" 
                            placeholder="Confirm Password"/>

            <button type="button" id="toggleConfirmPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                <!-- Eye icon when confirm password is hidden -->
                <svg id="eyeIconConfirmHidden" class="shrink-0 w-5 h-5 text-gray-500 block" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 9a3 3 0 1 0 3 3"></path>
                    <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                    <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                    <line x1="2" x2="22" y1="2" y2="22"></line>
                </svg>

                <!-- Eye icon when confirm password is visible -->
                <svg id="eyeIconConfirmVisible" class="shrink-0 w-5 h-5 text-gray-500 hidden" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 5C5 5 2 12 2 12s3 7 10 7 10-7 10-7-3-7-10-7Z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                </svg>
            </button>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-center mt-4">
            <x-primary-button class="ml-4 signup-button">
                {{ __('Create Account') }}
            </x-primary-button>
        </div>

        <div class="text-center login">
            <p class="inline-block text-already">{{ __("already have an account?") }}</p>
            <a class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}"style="font-size: 0.8rem;">
                {{ __('Log In') }}
            </a>
        </div>
    </form>
</x-guest-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIconVisible = document.getElementById('eyeIconVisible');
        const eyeIconHidden = document.getElementById('eyeIconHidden');

        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const eyeIconConfirmVisible = document.getElementById('eyeIconConfirmVisible');
        const eyeIconConfirmHidden = document.getElementById('eyeIconConfirmHidden');

        togglePassword.addEventListener('click', function () {
            // Toggle the type attribute of the password input
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;

            // Toggle the visibility of the SVG icons
            eyeIconVisible.classList.toggle('hidden');
            eyeIconHidden.classList.toggle('hidden');
        });

        toggleConfirmPassword.addEventListener('click', function () {
            // Toggle the type attribute of the confirm password input
            const type = confirmPasswordInput.type === 'password' ? 'text' : 'password';
            confirmPasswordInput.type = type;

            // Toggle the visibility of the SVG icons
            eyeIconConfirmVisible.classList.toggle('hidden');
            eyeIconConfirmHidden.classList.toggle('hidden');
        });
    });
</script>
