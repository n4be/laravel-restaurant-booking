<x-guest-layout>
    <x-slot name="title">
        <h1 class="text-2xl font-bold text-gray-800">ログイン</h1>
    </x-slot>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('user.login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('user.password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <div class="d-flex flex-column mx-auto align-items-center">
                <x-primary-button>
                    {{ __('Log in') }}
                </x-primary-button>
                <button type="button" class="btn btn-warning fs-6 font-monospace mt-3">
                    <a href="{{ route('admin.login') }}" class="text-decoration-none text-dark">
                        管理者の方はこちら
                    </a>
                </button>
            </div>

        </div>
    </form>
</x-guest-layout>