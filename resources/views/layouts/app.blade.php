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
            backdrop-filter: blur(25px);
            background: linear-gradient(135deg,
                    rgba(255, 255, 255, 0.95) 0%,
                    rgba(240, 253, 244, 0.9) 50%,
                    rgba(220, 252, 231, 0.85) 100%);
            border-bottom: 1px solid rgba(34, 197, 94, 0.15);
            box-shadow:
                0 8px 32px rgba(34, 197, 94, 0.08),
                0 4px 16px rgba(34, 197, 94, 0.05),
                inset 0 1px 0 rgba(255, 255, 255, 0.5);
        }

        .logo-glow {
            position: relative;
        }

        .logo-glow::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(135deg,
                    rgba(16, 185, 129, 0.1),
                    rgba(52, 211, 153, 0.1),
                    rgba(34, 197, 94, 0.1));
            border-radius: 12px;
            filter: blur(8px);
            z-index: -1;
        }

        .nav-item {
            position: relative;
            display: flex;
            align-items: center;
            padding: 0.625rem 1rem;
            border-radius: 0.75rem;
            font-weight: 500;
            color: #065f46;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            white-space: nowrap;
        }

        .nav-item:hover {
            background: linear-gradient(135deg,
                    rgba(34, 197, 94, 0.08) 0%,
                    rgba(16, 185, 129, 0.06) 100%);
            color: #064e3b;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(34, 197, 94, 0.1);
        }

        .nav-item.active {
            background: linear-gradient(135deg,
                    rgba(34, 197, 94, 0.12) 0%,
                    rgba(16, 185, 129, 0.1) 100%);
            color: #064e3b;
            box-shadow: 0 2px 8px rgba(34, 197, 94, 0.15);
        }

        .dropdown-wrapper {
            position: relative;
        }

        .dropdown-wrapper:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .dropdown-menu {
            position: absolute;
            top: calc(100% + 0.5rem);
            left: 0;
            min-width: 220px;
            background: linear-gradient(145deg,
                    rgba(255, 255, 255, 0.98) 0%,
                    rgba(240, 253, 244, 0.95) 100%);
            border-radius: 0.875rem;
            padding: 0.5rem;
            box-shadow:
                0 20px 25px -5px rgba(34, 197, 94, 0.15),
                0 10px 10px -5px rgba(34, 197, 94, 0.1),
                0 0 0 1px rgba(34, 197, 94, 0.1);
            backdrop-filter: blur(12px);
            z-index: 50;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-8px) scale(0.95);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .dropdown-item {
            display: block;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            color: #065f46;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 0.875rem;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg,
                    rgba(34, 197, 94, 0.1) 0%,
                    rgba(16, 185, 129, 0.08) 100%);
            color: #064e3b;
            transform: translateX(4px);
        }

        .user-menu-button {
            background: linear-gradient(135deg,
                    rgba(255, 255, 255, 0.9) 0%,
                    rgba(240, 253, 244, 0.8) 100%);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(34, 197, 94, 0.2);
            box-shadow:
                0 4px 6px -1px rgba(34, 197, 94, 0.1),
                0 2px 4px -1px rgba(34, 197, 94, 0.06);
        }

        .user-menu-button:hover {
            box-shadow:
                0 10px 15px -3px rgba(34, 197, 94, 0.15),
                0 4px 6px -2px rgba(34, 197, 94, 0.1);
            transform: translateY(-1px);
        }

        .mobile-menu-button {
            background: linear-gradient(135deg,
                    rgba(255, 255, 255, 0.9) 0%,
                    rgba(240, 253, 244, 0.8) 100%);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        @media (max-width: 768px) {
            .dropdown-menu {
                position: static;
                opacity: 1;
                visibility: visible;
                transform: none;
                box-shadow: none;
                background: rgba(240, 253, 244, 0.5);
                margin-top: 0.5rem;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-green-50 via-emerald-50/50 to-teal-50/30 min-h-screen antialiased">
    @auth
        @php
            $isAdmin = auth()->user()->role === 'admin';
        @endphp

        <div class="min-h-screen">
            <!-- Header with improved layout -->
            <header class="glass-effect sticky top-0 z-40 border-b border-emerald-100/50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16 lg:h-18">

                        <!-- Left Section: Logo + Navigation -->
                        <div class="flex items-center space-x-8">
                            <!-- Logo with improved styling -->
                            <div class="logo-glow flex-shrink-0">
                                <div class="flex items-center space-x-2">
                                    <div>
                                        <h1 class="text-xl font-black tracking-tight leading-none">
                                            <span class="text-emerald-600">AP</span><span
                                                class="text-green-500">TIK</span><span class="text-teal-600">NAS</span>
                                        </h1>
                                        <p class="text-xs font-semibold text-emerald-700 leading-none">
                                            Asosiasi Pengusaha <span class="text-green-600">TIK</span> Nasional
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Desktop Navigation -->
                            <nav class="hidden lg:flex items-center space-x-1">
                                <!-- Dashboard -->
                                <a href="/dashboard" class="nav-item">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M20 8l-6-5.26a3 3 0 0 0-4 0L4 8a3 3 0 0 0-1 2.26V19a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3v-8.75A3 3 0 0 0 20 8m-6 12h-4v-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1Z" />
                                    </svg>
                                    Dashboard
                                </a>

                                <!-- Category Dropdown -->
                                <div class="dropdown-wrapper">
                                    <a href="#" class="nav-item">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M4 4h5v5H4zm-2 7V2h9v9zm2 4h5v5H4zm-2 7v-9h9v9zM20 4h-5v5h5zm-7-2v9h9V2zm2 13h5v5h-5zm-2 7v-9h9v9z" />
                                        </svg>
                                        Category
                                        <svg class="w-3 h-3 ml-1 transition-transform duration-200" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </a>
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
                                            About</a>
                                        <a href="{{ route('category-podcasts.index') }}" class="dropdown-item">Category
                                            Podcasts</a>
                                    </div>
                                </div>

                                <!-- Konten Dropdown -->
                                <div class="dropdown-wrapper">
                                    <a href="#" class="nav-item">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor">
                                            <path
                                                d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2m0 16H8V7h11z" />
                                        </svg>
                                        Konten
                                        <svg class="w-3 h-3 ml-1 transition-transform duration-200" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('gallery.index') }}" class="dropdown-item">Gallery</a>
                                        <a href="{{ route('products.index') }}" class="dropdown-item">Products</a>
                                        <a href="{{ route('slider.index') }}" class="dropdown-item">Slider</a>
                                        <a href="{{ route('testimonies.index') }}" class="dropdown-item">Testimonies</a>
                                        <a href="{{ route('career.index') }}" class="dropdown-item">Career</a>
                                    </div>
                                </div>

                                <!-- Master Data Dropdown -->
                                <div class="dropdown-wrapper">
                                    <a href="#" class="nav-item">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"
                                            fill="none" stroke="currentColor" stroke-width="4">
                                            <path d="M44 11v27c0 3.314-8.954 6-20 6S4 41.314 4 38V11" />
                                            <path
                                                d="M44 29c0 3.314-8.954 6-20 6S4 32.314 4 29m40-9c0 3.314-8.954 6-20 6S4 23.314 4 20" />
                                            <ellipse cx="24" cy="10" rx="20" ry="6" />
                                        </svg>
                                        Data
                                        <svg class="w-3 h-3 ml-1 transition-transform duration-200" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('aboutus.index') }}" class="dropdown-item">About Us</a>
                                        <a href="{{ route('agenda.index') }}" class="dropdown-item">Agenda</a>
                                        <a href="{{ route('applications.index') }}"
                                            class="dropdown-item">Applications</a>
                                    </div>
                                </div>

                                <!-- Informasi Dropdown -->
                                <div class="dropdown-wrapper">
                                    <a href="#" class="nav-item">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2">
                                            <circle cx="12" cy="12" r="10" />
                                            <path d="M12 16v-4m0-4h.01" />
                                        </svg>
                                        Informasi
                                        <svg class="w-3 h-3 ml-1 transition-transform duration-200" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('contact.index') }}" class="dropdown-item">Contact</a>
                                        <a href="{{ route('pengurus.index') }}" class="dropdown-item">Pengurus</a>
                                        <a href="{{ route('partners.index') }}" class="dropdown-item">Partners</a>
                                        <a href="{{ route('about.index') }}" class="dropdown-item">About</a>
                                    </div>
                                </div>

                                <!-- Podcast -->
                                <a href="{{ route('podcasts.index') }}" class="nav-item">
                                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <g fill="none" stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="1.5">
                                            <path d="M4.516 17a9 9 0 1 1 14.969 0" />
                                            <path d="M9 11a3 3 0 1 1 6 0v2a3 3 0 1 1-6 0zm3 5v4m-2 1l2-2l2 2z" />
                                        </g>
                                    </svg>
                                    Podcast
                                </a>
                            </nav>
                        </div>

                        <!-- Right Section: User Menu + Mobile Toggle -->
                        <div class="flex items-center space-x-4">
                            <!-- Mobile menu button -->
                            <button type="button" class="lg:hidden mobile-menu-button p-2 rounded-lg" x-data
                                @click="$dispatch('toggle-mobile-menu')">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>

                            <!-- User Menu -->
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open"
                                    class="user-menu-button flex items-center space-x-3 px-3 py-2 rounded-xl transition-all duration-200">
                                    <!-- Avatar -->
                                    <div class="relative">
                                        <div
                                            class="w-8 h-8 bg-gradient-to-br from-emerald-500 via-green-500 to-teal-600 rounded-lg flex items-center justify-center shadow-sm">
                                            <span class="text-white font-bold text-sm">
                                                {{ substr(auth()->user()->name, 0, 1) }}
                                            </span>
                                        </div>
                                        <div
                                            class="absolute -top-0.5 -right-0.5 w-3 h-3 bg-green-400 rounded-full border-2 border-white">
                                        </div>
                                    </div>

                                    <!-- User info (hidden on smaller screens) -->
                                    <div class="hidden xl:block text-left">
                                        <div class="text-emerald-800 font-semibold text-sm leading-tight">
                                            {{ auth()->user()->name }}
                                        </div>
                                        <div class="text-xs text-emerald-600 font-medium">
                                            {{ $isAdmin ? 'Administrator' : 'Member' }}
                                        </div>
                                    </div>

                                    <!-- Chevron -->
                                    <svg class="w-4 h-4 text-emerald-600 transition-transform duration-200"
                                        :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>

                                <!-- User Dropdown -->
                                <div x-show="open" @click.outside="open = false"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-1 scale-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-1 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-emerald-100 overflow-hidden z-50">

                                    <!-- User Info Header -->
                                    <div
                                        class="px-4 py-3 bg-gradient-to-r from-emerald-50 to-green-50 border-b border-emerald-100">
                                        <div class="flex items-center space-x-3">
                                            <div
                                                class="w-10 h-10 bg-gradient-to-br from-emerald-500 via-green-500 to-teal-600 rounded-lg flex items-center justify-center">
                                                <span class="text-white font-bold">
                                                    {{ substr(auth()->user()->name, 0, 1) }}
                                                </span>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-semibold text-emerald-800 truncate">
                                                    {{ auth()->user()->name }}
                                                </p>
                                                <p class="text-xs text-emerald-600 truncate">
                                                    {{ auth()->user()->email ?? 'User' }}
                                                </p>
                                                <span
                                                    class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 mt-1">
                                                    {{ $isAdmin ? 'Administrator' : 'Member' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Logout -->
                                    <div class="border-t border-emerald-100">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit"
                                                class="flex items-center w-full px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                </svg>
                                                Sign Out
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile Navigation (Hidden by default) -->
                <div class="lg:hidden border-t border-emerald-100/50" x-data="{ mobileMenuOpen: false }"
                    @toggle-mobile-menu.window="mobileMenuOpen = !mobileMenuOpen" x-show="mobileMenuOpen"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-1 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-1 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2">

                    <div class="px-4 py-4 space-y-2 bg-gradient-to-br from-emerald-50/80 to-green-50/60 backdrop-blur-sm">
                        <!-- Mobile Dashboard -->
                        <a href="/dashboard"
                            class="flex items-center px-3 py-2 text-sm font-medium text-emerald-700 hover:bg-emerald-100 rounded-lg transition-colors">
                            <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20 8l-6-5.26a3 3 0 0 0-4 0L4 8a3 3 0 0 0-1 2.26V19a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3v-8.75A3 3 0 0 0 20 8m-6 12h-4v-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1Z" />
                            </svg>
                            Dashboard
                        </a>

                        <!-- Mobile dropdowns would be implemented with additional x-data for each section -->
                        <div x-data="{ categoryOpen: false }">
                            <button @click="categoryOpen = !categoryOpen"
                                class="flex items-center justify-between w-full px-3 py-2 text-sm font-medium text-emerald-700 hover:bg-emerald-100 rounded-lg transition-colors">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M4 4h5v5H4zm-2 7V2h9v9zm2 4h5v5H4zm-2 7v-9h9v9zM20 4h-5v5h5zm-7-2v9h9V2zm2 13h5v5h-5zm-2 7v-9h9v9z" />
                                    </svg>
                                    Category
                                </div>
                                <svg class="w-4 h-4 transition-transform duration-200"
                                    :class="{ 'rotate-180': categoryOpen }" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="categoryOpen" x-transition class="ml-6 mt-2 space-y-1">
                                <a href="{{ route('category-store.index') }}"
                                    class="block px-3 py-2 text-sm text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors">Category
                                    Store</a>
                                <a href="{{ route('category-gallery.index') }}"
                                    class="block px-3 py-2 text-sm text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors">Category
                                    Gallery</a>
                                <a href="{{ route('category-daftar.index') }}"
                                    class="block px-3 py-2 text-sm text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors">Category
                                    Daftar</a>
                                <a href="{{ route('category-pengurus.index') }}"
                                    class="block px-3 py-2 text-sm text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors">Category
                                    Pengurus</a>
                                <a href="{{ route('category-aboutus.index') }}"
                                    class="block px-3 py-2 text-sm text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors">Category
                                    About</a>
                            </div>
                        </div>

                        <!-- Mobile Konten -->
                        <div x-data="{ kontenOpen: false }">
                            <button @click="kontenOpen = !kontenOpen"
                                class="flex items-center justify-between w-full px-3 py-2 text-sm font-medium text-emerald-700 hover:bg-emerald-100 rounded-lg transition-colors">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <path
                                            d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2m0 16H8V7h11z" />
                                    </svg>
                                    Konten
                                </div>
                                <svg class="w-4 h-4 transition-transform duration-200"
                                    :class="{ 'rotate-180': kontenOpen }" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="kontenOpen" x-transition class="ml-6 mt-2 space-y-1">
                                <a href="{{ route('gallery.index') }}"
                                    class="block px-3 py-2 text-sm text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors">Gallery</a>
                                <a href="{{ route('products.index') }}"
                                    class="block px-3 py-2 text-sm text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors">Products</a>
                                <a href="{{ route('slider.index') }}"
                                    class="block px-3 py-2 text-sm text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors">Slider</a>
                                <a href="{{ route('testimonies.index') }}"
                                    class="block px-3 py-2 text-sm text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors">Testimonies</a>
                                <a href="{{ route('career.index') }}"
                                    class="block px-3 py-2 text-sm text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors">Career</a>
                            </div>
                        </div>

                        <!-- Mobile Data -->
                        <div x-data="{ dataOpen: false }">
                            <button @click="dataOpen = !dataOpen"
                                class="flex items-center justify-between w-full px-3 py-2 text-sm font-medium text-emerald-700 hover:bg-emerald-100 rounded-lg transition-colors">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"
                                        fill="none" stroke="currentColor" stroke-width="4">
                                        <path d="M44 11v27c0 3.314-8.954 6-20 6S4 41.314 4 38V11" />
                                        <path
                                            d="M44 29c0 3.314-8.954 6-20 6S4 32.314 4 29m40-9c0 3.314-8.954 6-20 6S4 23.314 4 20" />
                                        <ellipse cx="24" cy="10" rx="20" ry="6" />
                                    </svg>
                                    Data
                                </div>
                                <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': dataOpen }"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="dataOpen" x-transition class="ml-6 mt-2 space-y-1">
                                <a href="{{ route('aboutus.index') }}"
                                    class="block px-3 py-2 text-sm text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors">About
                                    Us</a>
                                <a href="{{ route('agenda.index') }}"
                                    class="block px-3 py-2 text-sm text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors">Agenda</a>
                                <a href="{{ route('applications.index') }}"
                                    class="block px-3 py-2 text-sm text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors">Applications</a>
                            </div>
                        </div>

                        <!-- Mobile Informasi -->
                        <div x-data="{ informasiOpen: false }">
                            <button @click="informasiOpen = !informasiOpen"
                                class="flex items-center justify-between w-full px-3 py-2 text-sm font-medium text-emerald-700 hover:bg-emerald-100 rounded-lg transition-colors">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10" />
                                        <path d="M12 16v-4m0-4h.01" />
                                    </svg>
                                    Informasi
                                </div>
                                <svg class="w-4 h-4 transition-transform duration-200"
                                    :class="{ 'rotate-180': informasiOpen }" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="informasiOpen" x-transition class="ml-6 mt-2 space-y-1">
                                <a href="{{ route('contact.index') }}"
                                    class="block px-3 py-2 text-sm text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors">Contact</a>
                                <a href="{{ route('pengurus.index') }}"
                                    class="block px-3 py-2 text-sm text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors">Pengurus</a>
                                <a href="{{ route('partners.index') }}"
                                    class="block px-3 py-2 text-sm text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors">Partners</a>
                                <a href="{{ route('about.index') }}"
                                    class="block px-3 py-2 text-sm text-emerald-600 hover:bg-emerald-50 rounded-md transition-colors">About</a>
                            </div>
                        </div>

                        <!-- Mobile Podcast -->
                        <a href="{{ route('podcasts.index') }}"
                            class="flex items-center px-3 py-2 text-sm font-medium text-emerald-700 hover:bg-emerald-100 rounded-lg transition-colors">
                            <svg class="w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            Podcast
                        </a>

                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 px-8 py-8 max-w-full mx-auto">
                @yield('content')
            </main>
        </div>

        <!-- Toast Notifications Container -->
        <div id="toast-container" class="fixed top-20 right-4 z-50 space-y-2"></div>
    @else
        <!-- Guest Layout (if needed) -->
        <div
            class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 via-emerald-50/50 to-teal-50/30">
            <div class="text-center">
                <h1 class="text-2xl font-bold text-emerald-800 mb-4">Please Login</h1>
                <p class="text-emerald-600">You need to be authenticated to access this page.</p>
            </div>
        </div>
    @endauth

    <!-- Scripts -->
    <script>
        // Enhanced dropdown functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Handle dropdown delays for better UX
            const dropdownWrappers = document.querySelectorAll('.dropdown-wrapper');

            dropdownWrappers.forEach(wrapper => {
                let timeout;
                const dropdown = wrapper.querySelector('.dropdown-menu');

                wrapper.addEventListener('mouseenter', () => {
                    clearTimeout(timeout);
                });

                wrapper.addEventListener('mouseleave', () => {
                    timeout = setTimeout(() => {
                        // Optional: Add any additional cleanup
                    }, 150);
                });
            });
        });

        // Toast notification function
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');

            const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';

            toast.className =
                `${bgColor} text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300`;
            toast.textContent = message;

            container.appendChild(toast);

            // Animate in
            setTimeout(() => {
                toast.classList.remove('translate-x-full');
            }, 100);

            // Auto remove
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => {
                    container.removeChild(toast);
                }, 300);
            }, 3000);
        }

        // Enhanced mobile menu functionality
        function toggleMobileMenu() {
            const event = new CustomEvent('toggle-mobile-menu');
            window.dispatchEvent(event);
        }
    </script>
</body>

</html>
