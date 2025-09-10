@extends('layouts.auth', ['title' => 'Login'])

@section('content')
    <div
        class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-green-400 via-emerald-500 to-green-700 overflow-hidden">

        <!-- Ornamen Lingkaran -->
        <div class="absolute top-10 left-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
        <div class="absolute bottom-20 right-10 w-56 h-56 bg-green-300/20 rounded-full blur-3xl"></div>
        <div class="absolute -top-16 right-32 w-32 h-32 bg-emerald-200/30 rounded-full blur-2xl"></div>

        <!-- Card -->
        <div
            class="relative w-full max-w-md bg-white/90 backdrop-blur-md p-8 rounded-2xl shadow-xl border border-green-100 transition transform hover:scale-[1.01] hover:shadow-2xl duration-300 z-10">

            {{-- Status Success --}}
            @if (session('status'))
                <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-700 text-sm font-medium text-center">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Title --}}
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-green-700">Selamat Datang</h2>
                <p class="text-gray-500 text-sm sm:text-base mt-2">Silakan login untuk melanjutkan ke dashboard</p>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                {{-- Email --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                    <div class="relative">
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400 focus:outline-none text-sm sm:text-base @error('email') border-red-500 @enderror"
                            placeholder="Masukkan Email" required>
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <input type="password" name="password"
                            class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400 focus:outline-none text-sm sm:text-base @error('password') border-red-500 @enderror"
                            placeholder="Masukkan Password" required>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg text-sm sm:text-base">
                    LOGIN
                </button>

                {{-- Forgot Password --}}
                <div class="text-center">
                    <a href="{{ route('password.request') }}" class="text-xs sm:text-sm text-green-600 hover:underline">
                        Lupa Password?
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Error Message --}}
    @if (session('error'))
        <div
            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mt-4 max-w-md mx-auto text-sm shadow-md text-center">
            {{ session('error') }}
        </div>
    @endif
@endsection
