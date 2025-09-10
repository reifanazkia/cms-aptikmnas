@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
    <div class="min-h-screen  p-2 sm:p-4 lg:p-6">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 backdrop-blur-md rounded-2xl shadow-md p-6 sm:p-10 text-center space-y-4 sm:space-y-6">

            <!-- Badge -->
            <span
                class="px-3 py-1 bg-emerald-200 text-emerald-700 text-xs sm:text-sm font-medium rounded-full inline-flex items-center gap-1">
                🚀 Launching Soon
            </span>

            <!-- Heading -->
            <h1 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold text-emerald-800 leading-tight">
                Elevate Your Workflow with <span class="text-emerald-600">APTIKNAS</span>
            </h1>

            <!-- Description -->
            <p class="text-gray-600 text-sm sm:text-base lg:text-lg mt-2 sm:mt-3 max-w-xl mx-auto px-2 sm:px-0">
                Platform terpadu untuk membantu tim berkolaborasi, mengelola kegiatan, dan mencapai hasil terbaik.
                Sederhanakan proses Anda dan fokus pada hal yang paling penting.
            </p>
        </div>
    </div>
@endsection
