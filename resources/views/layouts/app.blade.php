<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>

    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <style>
        :root {
            --primary-green: #10b981;
            --secondary-green: #059669;
            --light-green: #dcfce7;
            --accent-teal: #34d399;
            --pale-green: #f0fdf4;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        /* Glass and Shadow Effects */
        .glass-effect {
            backdrop-filter: blur(20px);
            background: linear-gradient(135deg, rgba(240, 253, 244, 0.95), rgba(220, 252, 231, 0.9));
            border-bottom: 1px solid rgba(34, 197, 94, 0.2);
            box-shadow: 0 4px 20px rgba(34, 197, 94, 0.1);
        }

        .floating-card {
            box-shadow: 0 20px 25px -5px rgba(34, 197, 94, 0.1), 0 10px 10px -5px rgba(34, 197, 94, 0.04);
        }

        .logo-glow {
            filter: drop-shadow(0 4px 12px rgba(34, 197, 94, 0.3));
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 25px 50px -12px rgba(34, 197, 94, 0.25);
        }

        /* Animations */
        @keyframes pulse-ring {
            0% { transform: scale(0.8); opacity: 1; }
            80%, 100% { transform: scale(1.2); opacity: 0; }
        }

        .pulse-ring {
            animation: pulse-ring 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite;
        }

        /* Text and Gradients */
        .gradient-text {
            background: linear-gradient(135deg, #059669, #10b981, #34d399, #6ee7b7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--pale-green);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--primary-green), var(--accent-teal));
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, var(--secondary-green), var(--primary-green));
        }

        /* Navigation */
        .top-nav-item {
            position: relative;
            padding: 0.75rem 1.25rem;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            font-weight: 500;
            color: #065f46;
        }

        .top-nav-item:hover {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(16, 185, 129, 0.08));
            color: #064e3b;
        }

        .nav-active {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.15), rgba(16, 185, 129, 0.1));
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #059669;
            font-weight: 600;
        }

        /* Dropdown */
        .dropdown-container {
            position: absolute;
            top: 100%;
            left: 0;
            width: 240px;
            padding-top: 0.5rem;
            z-index: 50;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }

        .nav-item-with-dropdown:hover .dropdown-container {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-menu {
            background: linear-gradient(145deg, var(--pale-green) 0%, var(--light-green) 100%);
            border-radius: 0.75rem;
            padding: 0.5rem;
            box-shadow: 0 10px 25px -5px rgba(34, 197, 94, 0.3), 0 10px 10px -5px rgba(34, 197, 94, 0.15);
            border: 1px solid rgba(34, 197, 94, 0.2);
            z-index: 1000;
        }

        .dropdown-item {
            display: block;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            color: #065f46;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(16, 185, 129, 0.08));
            color: #064e3b;
            transform: translateX(4px);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-green-50 via-emerald-50/50 to-teal-50/30 min-h-screen antialiased">

    @auth
    @php
        $isAdmin = auth()->user()->role === 'admin';
        $headerClass = 'glass-effect';
    @endphp

    <div class="flex flex-col min-h-screen">
        <header class="{{ $headerClass }} relative z-50">
            <div class="px-10 py-4 flex items-center justify-between">
                <div class="flex items-center">
                    <div class="relative logo-glow mr-8">
                        <div class="relative">
                            <h1 class="text-2xl flex gap-1 font-black tracking-tight">
                                <span class="text-emerald-600 drop-shadow-sm">AP</span>
                                <span class="text-green-500 drop-shadow-sm">TIK</span>
                                <span class="text-teal-600 drop-shadow-sm">NAS</span>
                            </h1>
                            <div class="space-y-1 mt-1">
                                <p class="text-xs font-bold text-emerald-700 leading-tight">
                                    Asosiasi Pengusaha <span class="text-green-600 font-black">TIK</span> Nasional
                                </p>
                            </div>
                        </div>
                    </div>

                    <nav class="hidden md:flex items-center space-x-1">
                        <div class="nav-item-with-dropdown relative">
                            <a href="#" class="top-nav-item flex items-center">
                                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path fill="currentColor" fill-rule="evenodd" d="M4 4h5v5H4zm-2 7V2h9v9zm2 4h5v5H4zm-2 7v-9h9v9zM20 4h-5v5h5zm-7-2v9h9V2zm2 13h5v5h-5zm-2 7v-9h9v9z" />
                                </svg>
                                Category
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </a>
                            <div class="dropdown-container">
                                <div class="dropdown-menu">
                                    <a href="{{ route('category-kegiatan.index') }}" class="dropdown-item">Category Kegiatan</a>
                                    <a href="{{ route('category-store.index') }}" class="dropdown-item">Category Store</a>
                                    <a href="{{ route('category-gallery.index') }}" class="dropdown-item">Category Gallery</a>
                                    <a href="{{ route('category-daftar.index') }}" class="dropdown-item">Category Daftar</a>
                                    <a href="{{ route('category-pengurus.index') }}" class="dropdown-item">Category Pengurus</a>
                                </div>
                            </div>
                        </div>

                        <div class="nav-item-with-dropdown relative">
                            <a href="#" class="top-nav-item flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                Konten
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </a>
                            <div class="dropdown-container">
                                <div class="dropdown-menu">
                                    <a href="{{ route('kegiatan.index') }}" class="dropdown-item">Kegiatan</a>
                                    <a href="{{ route('gallery.index') }}" class="dropdown-item">Gallery</a>
                                    <a href="{{ route('products.index') }}" class="dropdown-item">Products</a>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('contact.index') }}" class="top-nav-item flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Contact
                        </a>
                        <a href="{{ route('pengurus.index') }}" class="top-nav-item flex items-center">
                            <svg class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 36">
                                <path fill="currentColor" d="M14.68 14.81a6.76 6.76 0 1 1 6.76-6.75a6.77 6.77 0 0 1-6.76 6.75m0-11.51a4.76 4.76 0 1 0 4.76 4.76a4.76 4.76 0 0 0-4.76-4.76" class="clr-i-outline clr-i-outline-path-1" />
                                <path fill="currentColor" d="M16.42 31.68A2.14 2.14 0 0 1 15.8 30H4v-5.78a14.8 14.8 0 0 1 11.09-4.68h.72a2.2 2.2 0 0 1 .62-1.85l.12-.11c-.47 0-1-.06-1.46-.06A16.47 16.47 0 0 0 2.2 23.26a1 1 0 0 0-.2.6V30a2 2 0 0 0 2 2h12.7Z" class="clr-i-outline clr-i-outline-path-2" />
                                <path fill="currentColor" d="M26.87 16.29a.4.4 0 0 1 .15 0a.4.4 0 0 0-.15 0" class="clr-i-outline clr-i-outline-path-3" />
                                <path fill="currentColor" d="m33.68 23.32l-2-.61a7.2 7.2 0 0 0-.58-1.41l1-1.86A.38.38 0 0 0 32 19l-1.45-1.45a.36.36 0 0 0-.44-.07l-1.84 1a7 7 0 0 0-1.43-.61l-.61-2a.36.36 0 0 0-.36-.24h-2.05a.36.36 0 0 0-.35.26l-.61 2a7 7 0 0 0-1.44.6l-1.82-1a.35.35 0 0 0-.43.07L17.69 19a.38.38 0 0 0-.06.44l1 1.82a6.8 6.8 0 0 0-.63 1.43l-2 .6a.36.36 0 0 0-.26.35v2.05A.35.35 0 0 0 16 26l2 .61a7 7 0 0 0 .6 1.41l-1 1.91a.36.36 0 0 0 .06.43l1.45 1.45a.38.38 0 0 0 .44.07l1.87-1a7 7 0 0 0 1.4.57l.6 2a.38.38 0 0 0 .35.26h2.05a.37.37 0 0 0 .35-.26l.61-2.05a7 7 0 0 0 1.38-.57l1.89 1a.36.36 0 0 0 .43-.07L32 30.4a.35.35 0 0 0 0-.4l-1-1.88a7 7 0 0 0 .58-1.39l2-.61a.36.36 0 0 0 .26-.35v-2.1a.36.36 0 0 0-.16-.35M24.85 28a3.34 3.34 0 1 1 3.33-3.33A3.34 3.34 0 0 1 24.85 28" class="clr-i-outline clr-i-outline-path-4" />
                                <path fill="none" d="M0 0h36v36H0z" />
                            </svg>
                            Pengurus
                        </a>
                        <a href="{{ route('partners.index') }}" class="top-nav-item flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Partners
                        </a>
                    </nav>
                </div>

                <div class="relative flex items-center space-x-4">
                    <div class="text-right hidden md:block">
                        <h1 class="text-2xl font-black gradient-text">
                            {{ $isAdmin ? 'Admin Dashboard' : 'Dashboard Pengguna' }}
                        </h1>
                        <p class="text-sm text-emerald-700 font-semibold">
                            {{ $isAdmin ? 'Kelola sistem dan verifikasi anggota' : 'Selamat datang di portal Aptiknas' }}
                        </p>
                    </div>

                    <div class="h-8 w-px bg-emerald-200"></div>

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center space-x-3 px-4 py-2 rounded-xl bg-gradient-to-r from-white/90 to-emerald-50/80 shadow-lg border border-emerald-200/60 hover:shadow-xl hover:from-emerald-50/90 hover:to-green-50/80 transition-all duration-300">
                            <div class="relative">
                                <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl flex items-center justify-center shadow-md">
                                    <span class="text-white font-bold text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-400 border-2 border-white rounded-full pulse-ring"></div>
                            </div>
                            <div class="text-left hidden lg:block">
                                <span class="text-emerald-800 font-bold text-sm">{{ auth()->user()->name }}</span>
                                <p class="text-xs text-emerald-600 font-medium">{{ $isAdmin ? 'Administrator' : 'Member' }}</p>
                            </div>
                            <svg class="w-4 h-4 text-emerald-600 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-2 w-56 rounded-xl bg-gradient-to-b from-white/95 to-emerald-50/90 shadow-xl border border-emerald-200/80 backdrop-blur-sm dropdown-menu">
                            <div class="p-4 border-b border-emerald-100">
                                <p class="text-xs text-emerald-600 mb-2 font-medium">Status Akun</p>
                                <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gradient-to-r from-emerald-100 to-green-100 text-emerald-800 border border-emerald-200">
                                    <div class="w-2 h-2 bg-emerald-500 rounded-full mr-2"></div>
                                    {{ $isAdmin ? 'Administrator' : 'Member' }}
                                </div>
                            </div>

                            <div class="p-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center w-full px-4 py-3 text-sm text-red-600 hover:bg-red-50/80 hover:text-red-700 rounded-lg transition-all duration-200 font-medium">
                                        <svg class="w-4 h-4 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 p-8">
            @yield('content')
        </main>
    </div>
    @endauth
</body>

</html>
