<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - Index</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Gallery</h1>
        <a href="{{ route('gallery.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add New Item
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search and Filter Form -->
    <form method="GET" action="{{ route('gallery.index') }}" class="mb-6 bg-white p-4 rounded-lg shadow">
        <div class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-64">
                <input type="text" name="search" placeholder="Search galleries..."
                       value="{{ request('search') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex-1 min-w-48">
                <select name="category" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                Filter
            </button>
            <a href="{{ route('gallery.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-2 px-4 rounded">
                Reset
            </a>
        </div>
    </form>

    <!-- Gallery Grid -->
    @if($galleries->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
            @foreach($galleries as $gallery)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    @if($gallery->image)
                        <img src="{{ Storage::url($gallery->image) }}"
                             alt="{{ $gallery->title }}"
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">No Image</span>
                        </div>
                    @endif

                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-2 line-clamp-2">{{ $gallery->title }}</h3>
                        <p class="text-sm text-gray-600 mb-2">{{ $gallery->category->name ?? 'No Category' }}</p>

                        @if($gallery->description)
                            <p class="text-gray-700 text-sm mb-3 line-clamp-3">{{ $gallery->description }}</p>
                        @endif

                        <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                            @if($gallery->pub_date)
                                <span>{{ $gallery->pub_date->format('M d, Y') }}</span>
                            @endif
                            @if($gallery->display_on_home)
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Home Display</span>
                            @endif
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('gallery.show', $gallery) }}"
                               class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-3 rounded text-sm">
                                View
                            </a>
                            <a href="{{ route('gallery.edit', $gallery) }}"
                               class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white text-center py-2 px-3 rounded text-sm">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('gallery.destroy', $gallery) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Are you sure you want to delete this item?')"
                                        class="bg-red-600 hover:bg-red-700 text-white py-2 px-3 rounded text-sm">
                                    Delete
                                </button>
                            </form>
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
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">No gallery items found.</p>
            <a href="{{ route('gallery.create') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Create Your First Gallery Item
            </a>
        </div>
    @endif
</div>

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
