<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles') {{-- Buat tambahan CSS kalau perlu --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</head>
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://unpkg.com/lucide@latest"></script>


<body class="font-sans antialiased bg-gray-100">

    <div class="flex h-screen">

        {{-- Sidebar --}}
        <aside class="w-64 bg-white shadow-md transition duration-300" id="sidebar">
            <div class="p-6 text-2xl font-bold text-gray-800">
                <img src="{{ asset('images/logo-sepatu.jpg') }}" alt="Logo" class="h-25 w-auto mx-auto">
            </div>
            <nav class="mt-6 space-y-2">
                <a href="{{ route('dashboard') }}"
                class="flex items-center gap-2 py-2.5 px-4 rounded hover:bg-gray-200 transition duration-200 ease-in-out {{ request()->is('dashboard') ? 'bg-gray-200 font-bold' : '' }}">
                 <i data-lucide="home" class="w-5 h-5"></i>
                 <span>Dashboard</span>
             </a>

                <a href="{{ route('orderan.index') }}"
                   class="flex items-center gap-2 py-2.5 px-4 border-l-4 transition duration-200 {{ request()->routeIs('orderan.*') ? 'border-blue-500 bg-gray-100 font-bold' : 'border-transparent hover:bg-gray-100' }}">
                    <i data-lucide="file-text" class="w-5 h-5"></i> Order
                </a>
                <a href="{{ route('layanan.index') }}"
                   class="flex items-center gap-2 py-2.5 px-4 border-l-4 transition duration-200 {{ request()->routeIs('layanan.*') ? 'border-blue-500 bg-gray-100 font-bold' : 'border-transparent hover:bg-gray-100' }}">
                    <i data-lucide="settings" class="w-5 h-5"></i> Layanan
                </a>
                <a href="{{ route('pelanggan.index') }}"
                   class="flex items-center gap-2 py-2.5 px-4 border-l-4 transition duration-200 {{ request()->routeIs('pelanggan.*') ? 'border-blue-500 bg-gray-100 font-bold' : 'border-transparent hover:bg-gray-100' }}">
                    <i data-lucide="users" class="w-5 h-5"></i> Pelanggan
                </a>
            </nav>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col overflow-hidden">

            {{-- Navbar --}}
            <header class="bg-white shadow flex items-center justify-between px-6 py-4">
                <h1 class="text-xl font-semibold text-gray-800">
                    @yield('page-title', 'Dashboard')
                </h1>

                {{-- User Dropdown --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                        <img src="{{ asset('img/' . Auth::user()->foto) }}" alt="Foto Profil" class="h-10 w-10 rounded-full">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto p-6">
                @if (trim($slot ?? '') !== '')
                    {{ $slot }}
                @else
                    @yield('content')
                @endif
            </main>
        </div>

    </div>


    <script>
        lucide.createIcons();
    </script>

<script>
    document.getElementById('toggleSidebar').addEventListener('click', function () {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('hidden');
    });
</script>

    @stack('scripts') {{-- Buat tambahan JS kalau perlu --}}
</body>

</html>