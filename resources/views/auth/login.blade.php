<!-- Navigation Bar -->
<nav x-data="{ open: false }" class="bg-gradient-to-r from-red-900 via-red-800 to-yellow-700 shadow-md font-[serif] text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <!-- Logo & Title -->
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 no-underline">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Church Logo" class="h-14 w-14 rounded-full border-4 border-yellow-300 shadow-md">
                    <span class="text-3xl font-bold tracking-wide text-white drop-shadow-lg">
                        San Jacinto De Polonia Parish
                    </span>
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Login Form Layout -->
<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-bl from-yellow-100 via-white to-red-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md bg-white/90 backdrop-blur-sm rounded-xl shadow-2xl border border-yellow-300 p-10 space-y-8">
            
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Heading -->
            <div class="text-center">
                <h2 class="text-3xl font-bold text-red-900 font-[serif] drop-shadow">Welcome</h2>
                <p class="mt-2 text-sm text-gray-700">
                    Login to continue managing <br>
                    <span class="text-yellow-600 font-semibold">San Jacinto de Polonia Parish Records</span>
                </p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6 mt-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-red-800 font-medium" />
                    <x-text-input id="email" class="block mt-1 w-full border-yellow-400 shadow-inner" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-red-800 font-medium" />
                    <x-text-input id="password" class="block mt-1 w-full border-yellow-400 shadow-inner" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mt-4">
                    <label for="remember_me" class="flex items-center text-sm text-gray-600">
                        <input id="remember_me" type="checkbox" class="mr-2 rounded border-yellow-400 text-red-800 focus:ring-yellow-500" name="remember">
                        {{ __('Remember me') }}
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-red-700 hover:text-yellow-600 transition">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center mt-6">
                    <button type="submit"
                        class="py-2 px-6 bg-gradient-to-r from-yellow-400 to-yellow-600 hover:from-yellow-500 hover:to-yellow-700 text-red-900 font-bold rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out border border-yellow-700">
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
