
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
    <p class="mb-4">Selamat datang, {{ auth()->user()->name }} 👋</p>

    <div class="flex gap-4">
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
            Logout
        </a>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>
</div>
