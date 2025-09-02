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

        .glass-effect {
            backdrop-filter: blur(20px);
            background: linear-gradient(135deg, rgba(240, 253, 244, .95), rgba(220, 252, 231, .9));
            border-bottom: 1px solid rgba(34, 197, 94, .2);
            box-shadow: 0 4px 20px rgba(34, 197, 94, .1);
        }

        .top-nav-item {
            position: relative;
            padding: .75rem 1.25rem;
            border-radius: .75rem;
            transition: all .3s ease;
            font-weight: 500;
            color: #065f46;
        }

        .top-nav-item:hover {
            background: linear-gradient(135deg, rgba(34, 197, 94, .1), rgba(16, 185, 129, .08));
            color: #064e3b;
        }

        .nav-item-with-dropdown:hover .dropdown-container {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-container {
            position: absolute;
            top: 100%;
            left: 0;
            width: 240px;
            padding-top: .5rem;
            z-index: 50;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all .3s ease;
        }

        .dropdown-menu {
            background: linear-gradient(145deg, var(--pale-green) 0%, var(--light-green) 100%);
            border-radius: .75rem;
            padding: .5rem;
            box-shadow: 0 10px 25px -5px rgba(34, 197, 94, .3), 0 10px 10px -5px rgba(34, 197, 94, .15);
            border: 1px solid rgba(34, 197, 94, .2);
        }

        .dropdown-item {
            display: block;
            padding: .75rem 1rem;
            border-radius: .5rem;
            color: #065f46;
            transition: all .2s ease;
            font-weight: 500;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, rgba(34, 197, 94, .1), rgba(16, 185, 129, .08));
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
                <div class="px-5 py-4 flex items-center justify-between">
                    <div class="flex items-center">
                        <!-- Logo -->
                        <div class="relative logo-glow mr-6">
                            <h1 class="text-2xl flex gap-1 font-black tracking-tight">
                                <span class="text-emerald-600">AP</span>
                                <span class="text-green-500">TIK</span>
                                <span class="text-teal-600">NAS</span>
                            </h1>
                            <p class="text-xs font-bold text-emerald-700">Asosiasi Pengusaha <span
                                    class="text-green-600">TIK</span> Nasional</p>
                        </div>

                        <!-- Navbar -->
                        <nav class="hidden md:flex items-center space-x-1">
                            <!-- Dashboard -->
                            <a href="/dashboard" class="top-nav-item flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M20 8l-6-5.26a3 3 0 0 0-4 0L4 8a3 3 0 0 0-1 2.26V19a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3v-8.75A3 3 0 0 0 20 8m-6 12h-4v-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1Z" />
                                </svg>
                                Dashboard
                            </a>

                            <!-- Category Dropdown -->
                            <div class="nav-item-with-dropdown relative">
                                <a href="#" class="top-nav-item flex items-center">
                                    Category
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </a>
                                <div class="dropdown-container">
                                    <div class="dropdown-menu">
                                        <a href="{{ route('category-store.index') }}" class="dropdown-item">Category
                                            Store</a>
                                        <a href="{{ route('category-gallery.index') }}" class="dropdown-item">Category
                                            Gallery</a>
                                        <a href="{{ route('category-daftar.index') }}" class="dropdown-item">Category
                                            Daftar</a>
                                        <a href="{{ route('category-pengurus.index') }}" class="dropdown-item">Category
                                            Pengurus</a>
                                        <a href="{{ route('category-aboutus.index') }}" class="dropdown-item">Category
                                            Abouts</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Konten Dropdown -->
                            <div class="nav-item-with-dropdown relative">
                                <a href="#" class="top-nav-item flex items-center">
                                    Konten
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </a>
                                <div class="dropdown-container">
                                    <div class="dropdown-menu">
                                        <a href="{{ route('gallery.index') }}" class="dropdown-item">Gallery</a>
                                        <a href="{{ route('products.index') }}" class="dropdown-item">Products</a>
                                        <a href="{{ route('slider.index') }}" class="dropdown-item">Slider</a>
                                        <a href="{{ route('testimonies.index') }}" class="dropdown-item">Testimonies</a>
                                        <a href="{{ route('career.index') }}" class="dropdown-item">Career</a>
                                        <!-- ditambahkan -->
                                    </div>
                                </div>
                            </div>

                            <!-- Master Data Dropdown -->
                            <div class="nav-item-with-dropdown relative">
                                <a href="#" class="top-nav-item flex items-center">
                                    Master Data
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </a>
                                <div class="dropdown-container">
                                    <div class="dropdown-menu">
                                        <a href="{{ route('aboutus.index') }}" class="dropdown-item">About Us</a>
                                        <a href="{{ route('agenda.index') }}" class="dropdown-item">Agenda</a>
                                        <a href="{{ route('applications.index') }}" class="dropdown-item">Applications</a>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact -->
                            <a href="{{ route('contact.index') }}" class="top-nav-item flex items-center">Contact</a>

                            <!-- Pengurus -->
                            <a href="{{ route('pengurus.index') }}" class="top-nav-item flex items-center">Pengurus</a>

                            <!-- Partners -->
                            <a href="{{ route('partners.index') }}" class="top-nav-item flex items-center">Partners</a>
                        </nav>
                    </div>

                    <!-- User Menu -->
                    <div class="relative flex items-center">
                        <div class="relative ml-4" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center space-x-3 px-4 py-2 rounded-xl bg-white shadow-lg border border-emerald-200 hover:shadow-xl transition-all">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-green-600 rounded-xl flex items-center justify-center">
                                    <span
                                        class="text-white font-bold text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                                <div class="text-left hidden lg:block">
                                    <span class="text-emerald-800 font-bold text-sm">{{ auth()->user()->name }}</span>
                                    <p class="text-xs text-emerald-600 font-medium">
                                        {{ $isAdmin ? 'Administrator' : 'Member' }}</p>
                                </div>
                                <svg class="w-4 h-4 text-emerald-600" :class="{ 'rotate-180': open }" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition
                                class="absolute right-0 mt-2 w-56 rounded-xl bg-white shadow-xl border border-emerald-200 dropdown-menu">
                                <div class="p-4 border-b border-emerald-100">
                                    <p class="text-xs text-emerald-600 mb-2 font-medium">Status Akun</p>
                                    <div
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                        <div class="w-2 h-2 bg-emerald-500 rounded-full mr-2"></div>
                                        {{ $isAdmin ? 'Administrator' : 'Member' }}
                                    </div>
                                </div>
                                <div class="p-2">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="flex items-center w-full px-4 py-3 text-sm text-red-600 hover:bg-red-50 rounded-lg">
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
