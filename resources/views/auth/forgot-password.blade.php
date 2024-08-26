@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth/forgot-password.css') }}">
@endpush

<x-guest-layout>
    <div class="layout">
        <!-- logo -->
        <div class="text-center flex flex-col items-center ">
            <img class="w-14 h-14" src="{{ asset('images/icon/lock.png') }}" alt="lock icon">
            <p class="text-forgot" >{{ __('Forgot password') }}</p>
        </div>

        <div class="mb-4 text-desc ">
            {{ __('Enter the email you used to create your account so we can send you a link for reseting your password.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="form-email">
            @csrf

            <!-- Email Address -->
            <div class="input-group">
                <x-input-label for="email" :value="__('Email')" class="input-label"/>
                <x-text-input id="email" class="block mt-1 w-full input-field" type="email" name="email" :value="old('email')" placeholder="Email" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-center mt-1 btn-reset">
                <x-primary-button class="btn-custom">
                    {{ __('Send') }}
                </x-primary-button>
            </div>
            <div class="flex items-center justify-center mt-4 btn-reset">
                <a href="{{ route('login') }}" class="btn-back-login">
                    {{ __('Back to Log In') }}
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
