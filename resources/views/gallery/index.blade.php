<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Gallery</h1>
        <a href="{{ route('gallery.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add New Item
        </a>
    </div>

    <!-- Filter and Search Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <form method="GET" action="{{ route('gallery.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Category Filter -->
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Filter by Category</label>
                <select name="category" id="category"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Search -->
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                <input type="text" name="search" id="search"
                       value="{{ request('search') }}"
                       placeholder="Search title..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Search Button -->
            <div class="flex items-end">
                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Search
                </button>
                @if(request('category') || request('search'))
                    <a href="{{ route('gallery.index') }}"
                       class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-2 px-4 rounded">
                        Clear
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Results Info -->
    @if(request('category') || request('search'))
        <div class="mb-4">
            <p class="text-gray-600">
                @if(request('category'))
                    @php
                        $selectedCategory = $categories->find(request('category'));
                    @endphp
                    @if($selectedCategory)
                        Showing results for category: <strong>{{ $selectedCategory->name }}</strong>
                    @endif
                @endif
                @if(request('search'))
                    @if(request('category')) | @endif
                    Search: <strong>"{{ request('search') }}"</strong>
                @endif
                - {{ $galleries->total() }} item(s) found
            </p>
        </div>
    @endif

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Gallery Grid -->
    @if($galleries->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            @foreach($galleries as $gallery)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <!-- Image -->
                    @if($gallery->image)
                        <div class="h-48 overflow-hidden">
                            <img src="{{ Storage::url($gallery->image) }}"
                                 alt="{{ $gallery->title }}"
                                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>
                    @else
                        <div class="h-48 bg-gray-200 flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif

                    <!-- Content -->
                    <div class="p-4">
                        <!-- Title -->
                        <h3 class="font-bold text-lg text-gray-800 mb-2 line-clamp-2">
                            {{ $gallery->title }}
                        </h3>

                        <!-- Category Badge -->
                        @if($gallery->category)
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mb-2">
                                {{ $gallery->category->name }}
                            </span>
                        @endif

                        <!-- Home Display Badge -->
                        @if($gallery->display_on_home)
                            <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full mb-2 ml-1">
                                On Home
                            </span>
                        @endif

                        <!-- Description -->
                        @if($gallery->description)
                            <p class="text-gray-600 text-sm mb-3 line-clamp-3">
                                {{ Str::limit($gallery->description, 100) }}
                            </p>
                        @endif

                        <!-- Date -->
                        @if($gallery->pub_date)
                            <p class="text-gray-500 text-xs mb-3">
                                {{ $gallery->pub_date->format('M d, Y') }}
                            </p>
                        @endif

                        <!-- URL Link -->
                        @if($gallery->url)
                            <a href="{{ $gallery->url }}" target="_blank"
                               class="text-blue-600 hover:text-blue-800 text-sm mb-3 block">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                View Link
                            </a>
                        @endif

                        <!-- Actions -->
                        <div class="flex justify-between items-center mt-4">
                            <a href="{{ route('gallery.show', $gallery) }}"
                               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                View Details
                            </a>
                            <div class="flex space-x-2">
                                <a href="{{ route('gallery.edit', $gallery) }}"
                                   class="text-yellow-600 hover:text-yellow-800">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('gallery.destroy', $gallery) }}"
                                      class="inline"
                                      onsubmit="return confirm('Are you sure you want to delete this item?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $galleries->appends(request()->query())->links() }}
        </div>
    @else
        <!-- No Results -->
        <div class="text-center py-12">
            <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h3 class="text-xl font-medium text-gray-900 mb-2">No gallery items found</h3>
            <p class="text-gray-600 mb-4">
                @if(request('category') || request('search'))
                    Try adjusting your filters or search terms.
                @else
                    Get started by creating your first gallery item.
                @endif
            </p>
            @if(request('category') || request('search'))
                <a href="{{ route('gallery.index') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                    View All Items
                </a>
            @endif
            <a href="{{ route('gallery.create') }}"
               class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Create New Item
            </a>
        </div>
    @endif
</div>

<!-- Custom Styles for line-clamp -->
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
</body>
</html>
