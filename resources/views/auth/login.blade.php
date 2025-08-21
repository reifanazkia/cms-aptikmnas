
<div class="max-w-md mx-auto mt-10 p-6 bg-white shadow rounded">
    <h1 class="text-xl font-semibold mb-4">Login</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label>Password</label>
            <input type="password" name="password" class="w-full border rounded p-2" required>
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">
            Login
        </button>
    </form>
</div>
