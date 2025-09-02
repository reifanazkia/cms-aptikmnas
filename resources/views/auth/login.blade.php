@extends('layouts.auth', ['title' => 'Login'])

@section('content')
<div class="min-h-screen w-full flex items-center justify-center bg-gradient-to-b from-green-300 to-green-600">
    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg">

        {{-- Status Success --}}
        @if (session('status'))
            <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-700 text-sm">
                {{ session('status') }}
            </div>
        @endif

        {{-- Title --}}
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-6 tracking-wide">
            LOGIN
        </h2>

        {{-- Form --}}
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            {{-- Email --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400 focus:outline-none @error('email') border-red-500 @enderror"
                       placeholder="Masukkan Alamat Email" required>
                @error('email')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400 focus:outline-none @error('password') border-red-500 @enderror"
                       placeholder="Masukkan Password" required>
                @error('password')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition">
                LOGIN
            </button>

            {{-- Forgot Password --}}
            <div class="text-right">
                <a href="{{ route('password.request') }}" class="text-sm text-green-600 hover:underline">
                    Lupa Password?
                </a>
            </div>
        </form>
    </div>
</div>

{{-- Error Message --}}
@if (session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif
@endsection
