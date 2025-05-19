<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /*! tailwindcss v3.0.0 */
            @tailwind base;
            @tailwind components;
            @tailwind utilities;
        </style>
    @endif
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] flex flex-col min-h-screen">

    <header class="w-full flex justify-end p-6">
        <nav class="flex gap-4">
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="inline-block px-5 py-2 text-[#1b1b18] dark:text-[#EDEDEC] hover:underline">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="inline-block px-5 py-2 text-[#1b1b18] dark:text-[#EDEDEC] hover:underline">
                    Log in
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="inline-block px-5 py-2 text-[#1b1b18] dark:text-[#EDEDEC] hover:underline">
                        Register
                    </a>
                @endif
            @endauth
        </nav>
    </header>

    <!-- Hero Section Cuci Sepatu -->
    <main class="flex flex-1 justify-center items-center px-6 p-md-3">
        <div
            class="bg-[#EDF2FA] dark:bg-[#1b1b18] rounded-2xl p-8 flex flex-col lg:flex-row items-center max-w-6xl w-full">
            <div class="flex-1 space-y-6">
                <h1 class="text-4xl font-bold text-blue-900 dark:text-white leading-tight">
                    Solusi Cuci Sepatu Modern & Bersih
                </h1>
                <p class="text-gray-700 dark:text-gray-300 text-lg">
                    Kami menyediakan layanan cuci sepatu profesional untuk menjaga kebersihan dan penampilan alas kaki
                    Anda. Bersih, cepat, dan terjangkau!
                </p>

            </div>
            <div class="flex-1 mt-8 lg:mt-0 lg:ml-12">
                <img src="https://img.freepik.com/free-vector/shoes-cleaning-service-concept_23-2148749251.jpg"
                    alt="Cuci Sepatu" class="rounded-xl shadow-lg w-full">
            </div>
        </div>
    </main>

    <div class="max-w-6xl mx-auto px-6 mt-10">
        <h2 class="text-3xl font-bold text-center mb-8">Layanan Kami</h2>
        <div class="grid gap-6 md:grid-cols-2 justify-center">
            <div
                class="p-6 max-w-sm mx-auto border rounded-xl shadow-md bg-[#EDF2FA] dark:bg-[#2a2a2a] hover:shadow-xl transition-all">
                <h3 class="text-xl font-semibold mb-3 text-blue-900 dark:text-white">Express</h3>
                <p class="text-gray-700 dark:text-gray-300">Layanan cuci sepatu cepat, hanya dalam waktu 1x24 jam. Cocok
                    untuk kebutuhan mendesak!</p>
            </div>
            <div
                class="p-6 max-w-sm mx-auto border rounded-xl shadow-md bg-[#EDF2FA] dark:bg-[#2a2a2a] hover:shadow-xl transition-all">
                <h3 class="text-xl font-semibold mb-3 text-blue-900 dark:text-white">Reguler</h3>
                <p class="text-gray-700 dark:text-gray-300">Layanan cuci sepatu standar dengan hasil maksimal, estimasi
                    3-5 hari kerja.</p>
            </div>
        </div>
    </div>



    <section class="py-16 bg-[#FDFDFC] dark:bg-[#0a0a0a] text-gray-800 dark:text-gray-200">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-8">Tata Cara Pemesanan</h2>
            <ol class="space-y-4 list-decimal list-inside">
                <li>Isi Formulir Pemesanan</li>
                <li>Antar atau Kirim Sepatu Anda ke Outlet Kami</li>
                <li>Proses Pencucian Sesuai Layanan Pilihan</li>
                <li>Pengambilan / Pengiriman Sepatu Bersih ke Anda</li>
            </ol>
        </div>
    </section>




    <footer class="text-center text-xs text-gray-500 dark:text-gray-400 p-6">
        © 2025 TwoBeeShoes. All rights reserved.

        <div class="text-center my-4">
            <button onclick="toggleDarkMode()"
                class="bg-gray-300 dark:bg-gray-700 text-black dark:text-white px-4 py-2 rounded">
                Toggle Dark Mode
            </button>
        </div>

        <script>
            function toggleDarkMode() {
                document.documentElement.classList.toggle('dark');
            }
        </script>

    </footer>

</body>

</html>