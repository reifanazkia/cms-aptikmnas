<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name') }}</title>
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
</head>

<body class="min-h-screen bg-gray-100 flex items-center justify-center">

    <div class="w-full px-6">
        {{-- Tempat konten halaman auth --}}
        @yield('content')
    </div>

    <footer class="absolute bottom-4 w-full text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </footer>

</body>

</html>
