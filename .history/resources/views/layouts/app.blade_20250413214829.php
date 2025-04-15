<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Modern Sentra') }} - @yield('title', 'Supplier Bahan Bangunan')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Roboto+Condensed:wght@400;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Styles -->
    @stack('styles')
</head>

<body class="font-['Montserrat'] antialiased">
    <!-- Success Notification -->
    @include('components.success-notification')

    <div class="min-h-screen bg-gray-100">
        <!-- Navigation -->
        <nav class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('home') }}" class="font-bold text-xl font-['Roboto_Condensed']">
                                <span class="text-black">MODERN</span> <span class="text-[#99765c]">SENTRA</span>
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('home') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('home') ? 'border-[#99765c] text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                                Beranda
                            </a>
                            <a href="{{ route('about') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('about') ? 'border-[#99765c] text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                                Tentang Kami
                            </a>
                            <a href="{{ route('products.index') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('products.*') ? 'border-[#99765c] text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                                Produk
                            </a>
                            <a href="{{ route('contact') }}"
                                class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('contact') ? 'border-[#99765c] text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                                Kontak
                            </a>
                        </div>
                    </div>

                    <!-- Quote Request Button -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <a href="{{ route('quote-request.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-[#99765c] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#876754] focus:bg-[#876754] active:bg-[#876754] focus:outline-none focus:ring-2 focus:ring-[#99765c] focus:ring-offset-2 transition ease-in-out duration-150">
                            Minta Penawaran
                        </a>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{ route('home') }}"
                        class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('home') ? 'border-[#99765c] text-[#99765c] bg-[#99765c]/10' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                        Beranda
                    </a>
                    <a href="{{ route('about') }}"
                        class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('about') ? 'border-[#99765c] text-[#99765c] bg-[#99765c]/10' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                        Tentang Kami
                    </a>
                    <a href="{{ route('products.index') }}"
                        class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('products.*') ? 'border-[#99765c] text-[#99765c] bg-[#99765c]/10' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                        Produk
                    </a>
                    <a href="{{ route('contact') }}"
                        class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('contact') ? 'border-[#99765c] text-[#99765c] bg-[#99765c]/10' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                        Kontak
                    </a>
                    <a href="{{ route('quote-request.create') }}"
                        class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('quote-request.*') ? 'border-[#99765c] text-[#99765c] bg-[#99765c]/10' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                        Minta Penawaran
                    </a>
                </div>
            </div>
        </nav>

        <!-- Page Header -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                @yield('header')
            </div>
        </header>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Company Info -->
                    <div class="col-span-1 md:col-span-1">
                        <h3 class="text-lg font-bold mb-4">Modern Sentra</h3>
                        <p class="text-gray-400 mb-4">Supplier bahan bangunan berkualitas untuk proyek konstruksi Anda.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-white">
                                <span class="sr-only">Facebook</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white">
                                <span class="sr-only">Instagram</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white">
                                <span class="sr-only">WhatsApp</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564c.173.087.289.13.332.202.043.072.043.419-.101.824zm-3.423-14.416c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm.029 18.88c-1.161 0-2.305-.292-3.318-.844l-3.677.964.984-3.595c-.607-1.052-.927-2.246-.926-3.468.001-3.825 3.113-6.937 6.937-6.937 1.856.001 3.598.723 4.907 2.034 1.31 1.311 2.031 3.054 2.03 4.908-.001 3.825-3.113 6.938-6.937 6.938z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="col-span-1">
                        <h3 class="text-lg font-bold mb-4">Tautan Cepat</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white">Beranda</a></li>
                            <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-white">Tentang Kami</a>
                            </li>
                            <li><a href="{{ route('products.index') }}"
                                    class="text-gray-400 hover:text-white">Produk</a></li>
                            <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-white">Kontak</a></li>
                            <li><a href="{{ route('quote-request.create') }}"
                                    class="text-gray-400 hover:text-white">Minta Penawaran</a></li>
                        </ul>
                    </div>

                    <!-- Products -->
                    <div class="col-span-1">
                        <h3 class="text-lg font-bold mb-4">Kategori Produk</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('products.index') }}?category=1"
                                    class="text-gray-400 hover:text-white">Semen & Beton</a></li>
                            <li><a href="{{ route('products.index') }}?category=2"
                                    class="text-gray-400 hover:text-white">Baja & Logam</a></li>
                            <li><a href="{{ route('products.index') }}?category=3"
                                    class="text-gray-400 hover:text-white">Kayu & Papan</a></li>
                            <li><a href="{{ route('products.index') }}?category=4"
                                    class="text-gray-400 hover:text-white">Cat & Finishing</a></li>
                            <li><a href="{{ route('products.index') }}?category=5"
                                    class="text-gray-400 hover:text-white">Alat & Perlengkapan</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div class="col-span-1">
                        <h3 class="text-lg font-bold mb-4">Kontak Kami</h3>
                        <ul class="space-y-2">
                            <li class="flex items-start">
                                <svg class="h-6 w-6 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-gray-400">Jl. Raya Sidoarjo No. 123, Sidoarjo</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-6 w-6 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span class="text-gray-400">+62 812 3456 7890</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-6 w-6 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="text-gray-400">info@modernsentra.com</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-6 w-6 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-gray-400">Senin - Sabtu: 08:00 - 17:00</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                    <p class="text-gray-400">&copy; {{ date('Y') }} Modern Sentra. Hak Cipta Dilindungi.</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- Custom Scripts -->
    @stack('scripts')
</body>

</html>