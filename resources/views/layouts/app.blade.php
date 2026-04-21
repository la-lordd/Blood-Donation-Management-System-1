<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- NAVBAR -->
    <nav class="bg-red-700 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">

            <!-- Brand Name -->
            <a href="{{ route('home') }}" class="text-xl font-bold">
                🩸 BloodBank System
            </a>

            <!-- Navigation Links -->
            <div class="flex items-center gap-1 text-sm font-medium flex-wrap">

                <a href="{{ route('home') }}"
                   class="px-3 py-2 rounded transition
                   {{ request()->routeIs('home') ? 'bg-red-900' : 'hover:bg-red-600' }}">
                    Home
                </a>

                @auth
                    <a href="{{ route('dashboard') }}"
                       class="px-3 py-2 rounded transition
                       {{ request()->routeIs('dashboard') ? 'bg-red-900' : 'hover:bg-red-600' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('donors.index') }}"
                       class="px-3 py-2 rounded transition
                       {{ request()->routeIs('donors.index') ? 'bg-red-900' : 'hover:bg-red-600' }}">
                        View Donors
                    </a>

                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('donors.create') }}"
                           class="px-3 py-2 rounded transition
                           {{ request()->routeIs('donors.create') ? 'bg-red-900' : 'hover:bg-red-600' }}">
                            + Add Donor
                        </a>
                    @endif

                    <span class="text-red-300 px-2">|</span>

                    <span class="text-red-200 text-xs px-2">
                        {{ auth()->user()->name }}
                        <span class="bg-red-900 px-1 py-0.5 rounded text-xs ml-1">
                            {{ auth()->user()->role }}
                        </span>
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-3 py-2 rounded hover:bg-red-600 transition cursor-pointer">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="px-3 py-2 rounded transition
                       {{ request()->routeIs('login') ? 'bg-red-900' : 'hover:bg-red-600' }}">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                       class="px-3 py-2 rounded transition
                       {{ request()->routeIs('register') ? 'bg-red-900' : 'hover:bg-red-600' }}">
                        Register
                    </a>
                @endauth

            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <div class="max-w-7xl mx-auto px-4 mt-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mb-4">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded mb-4">
                ❌ {{ session('error') }}
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center text-gray-400 text-sm py-6 mt-10 border-t border-gray-200">
        🩸 Blood Donation Management System &copy; {{ date('Y') }}
    </footer>

</body>
</html>