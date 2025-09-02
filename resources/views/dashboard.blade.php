@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
    <div class="space-y-10 h-full bg-gradient-to-r from-emerald-50 to-emerald-100 ">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r h-full from-emerald-50 to-emerald-100 rounded-2xl shadow-md p-10 text-center">
            <span
                class="px-4 py-1 bg-emerald-200 text-emerald-700 text-sm font-medium rounded-full inline-flex items-center gap-1">
                🚀 Launching Soon
            </span>
            <h1 class="text-4xl font-extrabold text-emerald-800 mt-4">
                Elevate Your Workflow with <span class="text-emerald-600">APTIKNAS</span>
            </h1>
            <p class="text-gray-600 mt-3 max-w-2xl mx-auto">
                Platform terpadu untuk membantu tim berkolaborasi, mengelola kegiatan, dan mencapai hasil terbaik.
                Sederhanakan proses Anda dan fokus pada hal yang paling penting.
            </p>

        </div>
    </div>
@endsection
