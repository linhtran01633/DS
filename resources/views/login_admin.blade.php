@extends('layout_client')

@section('content')
<div class="text-2xl font-bold pb-3 text-center">ĐĂNG NHẬP VÀO VIỆT LANG PHARMACY</div>

<div class="w-4/5 mx-auto flex items-start justify-between flex-wrap">
    <div class="mx-auto sm:w-6/12 w-9/12">
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login.admin.post') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Tên tài khoản')" />
                <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Mật khẩu')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-center mt-4">
                <x-primary-button class="ms-3">
                    {{ __('Đăng nhập') }}
                </x-primary-button>
            </div>
        </form>
    </div>

</div>
@endsection
