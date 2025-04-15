@extends('layouts.app')

@section('title', 'Katalog Produk')

@push('styles')
<style>
    /* Basic fade-in animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in {
        animation: fadeIn 0.6s ease-out forwards;
        opacity: 0;
        /* Start hidden */
    }

    /* Staggered animation for product cards */
    .stagger-item {
        animation: fadeIn 0.6s ease-out forwards;
        opacity: 0;
        /* Start hidden */
    }

    /* Brand color variables for easier management */
    :root {
        --brand-color: #99765c;
        --brand-color-dark: #876754;
        /* Darker shade for hover */
        --brand-color-light: #a1887f;
        /* Lighter shade */
    }

    /* Tailwind utility classes using CSS variables */
    .brand-text {
        color: var(--brand-color);
    }

    .hover\:brand-text-dark:hover {
        color: var(--brand-color-dark);
    }

    .brand-bg {
        background-color: var(--brand-color);
    }

    .hover\:brand-bg-dark:hover {
        background-color: var(--brand-color-dark);
    }

    .brand-ring-focus:focus {
        --tw-ring-color: var(--brand-color);
        /* Replicating Tailwind focus ring structure */
        --tw-ring-offset-shadow: var(--tw-ring-inset, ) 0 0 0 var(--tw-ring-offset-width, 0px) var(--tw-ring-offset-color, #fff);
        --tw-ring-shadow: var(--tw-ring-inset, ) 0 0 0 calc(2px + var(--tw-ring-offset-width, 0px)) var(--tw-ring-color);
        box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
        border-color: var(--brand-color);
        /* Also change border color on focus */
    }

    .brand-border-focus:focus {
        border-color: var(--brand-color);
    }

    .brand-gradient-hero {
        background: linear-gradient(to right, var(--brand-color-light), var(--brand-color));
    }

    .brand-gradient-cta {
        background: linear-gradient(to right, #4a5568, #2d3748);
        /* Example dark gradient */
    }

    /* Ensure sufficient contrast */
    .product-card h3 a {
        color: #1f2937;
        /* text-gray-800 */
    }

    .product-card h3 a:hover {
        color: var(--brand-color);
    }

    .product-card .detail-button {
        color: var(--brand-color);
    }

    .product-card .detail-button:hover {
        color: var(--brand-color-dark);
    }
</style>
@endpush

@section('content')
<div class="bg-slate-100 py-12 px-4 sm:px-6 lg:px-8"> {{-- Lighter page background --}}
    <div class="max-w-7xl mx-auto">
        {{-- Hero Section --}}
        <div class="mb-12 rounded-lg overflow-hidden shadow-xl fade-in brand-gradient-hero"> {{-- Use brand gradient,
            add shadow --}}
            <div class="py-16 px-8 md:py-24 md:px-12 text-center md:text-left">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 max-w-3xl drop-shadow-md">
                    Temukan Produk Konstruksi Berkualitas
                </h1>
                <p class="text-lg text-gray-100 mb-8 max-w-2xl drop-shadow-sm">
                    Jelajahi katalog lengkap kami untuk semua kebutuhan proyek konstruksi Anda.
                </p>
                <a href="#products"
                    class="inline-flex items-center px-6 py-3 brand-bg text-white font-medium rounded-lg shadow-md hover:brand-bg-dark transition duration-300 transform hover:scale-105 focus:outline-none brand-ring-focus focus:ring-offset-2">
                    Lihat Katalog
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>

        {{-- Filter Section --}}
        <div class="mb-10 fade-in" style="animation-delay: 0.2s;">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                <h2 class="text-2xl font-bold text-slate-800 mb-4 md:mb-0">Katalog Produk</h2>

                {{-- Mobile Filter Toggle --}}
                <button id="mobileFilterToggle"
                    class="md:hidden flex items-center text-slate-700 font-medium mb-4 p-2 rounded border border-slate-300 hover:bg-slate-50">
                    <span class="show-icon flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                clip-rule="evenodd" />
                        </svg>
                        Filter Produk
                    </span>
                    <span class="hide-icon hidden flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        Tutup Filter
                    </span>
                </button>
            </div>

            <!-- Filter Form Container -->
            <div id="filterContainer"
                class="bg-white p-6 rounded-lg shadow-md mb-8 hidden md:block border border-slate-200">
                <form id="filterForm" action="{{ route('products.index') }}" method="GET"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    {{-- Search Input --}}
                    <div>
                        <label for="search" class="block text-sm font-medium text-slate-700 mb-1">Cari Produk</label>
                        <div class="relative">
                            <input type="text" id="search" name="search" value="{{ request('search') }}"
                                class="w-full px-4 py-2 pl-10 border border-slate-300 rounded-lg focus:outline-none brand-ring-focus brand-border-focus text-sm"
                                placeholder="Nama produk...">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Category Filter --}}
                    <div>
                        <label for="category" class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
                        <select id="category" name="category"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none brand-ring-focus brand-border-focus text-sm">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category')==$category->id ? 'selected' : ''
                                }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Brand Filter --}}
                    <div>
                        <label for="brand" class="block text-sm font-medium text-slate-700 mb-1">Merk</label>
                        <select id="brand" name="brand"
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none brand-ring-focus brand-border-focus text-sm">
                            <option value="">Semua Merk</option>
                            @if(isset($brands) && count($brands) > 0)
                            @foreach($brands as $brand)
                            <option value="{{ $brand }}" {{ request('brand')==$brand ? 'selected' : '' }}>
                                {{ $brand }}
                            </option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                    {{-- Filter Actions --}}
                    <div class="flex items-end space-x-3">
                        <button type="submit"
                            class="flex-1 inline-flex items-center justify-center px-4 py-2 brand-bg text-white rounded-lg hover:brand-bg-dark transition duration-300 focus:outline-none brand-ring-focus focus:ring-offset-2 text-sm font-medium shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                    clip-rule="evenodd" />
                            </svg>
                            Filter
                        </button>
                        <button id="resetFilter" type="button"
                            class="flex-1 inline-flex items-center justify-center px-4 py-2 border border-slate-300 text-slate-700 bg-white rounded-lg hover:bg-slate-50 transition duration-300 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2 text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                    clip-rule="evenodd" />
                            </svg>
                            Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Products Section --}}
        <div id="products" class="mb-12">
            @if($products->isEmpty())
            <div class="text-center py-16 px-6 bg-white rounded-lg shadow-md border border-slate-200 fade-in"
                style="animation-delay: 0.3s;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-slate-400 mb-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <h3 class="text-xl font-medium text-slate-800 mb-2">Tidak Ada Produk Ditemukan</h3>
                <p class="text-slate-500 mb-4">Coba ubah filter atau kata kunci pencarian Anda.</p>
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center px-4 py-2 brand-bg text-white rounded-lg hover:brand-bg-dark transition duration-300 text-sm font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                            clip-rule="evenodd" />
                    </svg>
                    Lihat Semua Produk
                </a>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($products as $index => $product)
                {{-- Product Card --}}
                <div class="product-card bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 flex flex-col stagger-item border border-slate-100"
                    style="animation-delay: {{ $index * 0.05 }}s;">
                    <a href="{{ route('products.show', $product) }}" class="block group">
                        <div class="relative h-48 bg-slate-200 overflow-hidden">
                            @if($product->hasMedia('product_images'))
                            <img src="{{ $product->getFirstMediaUrl('product_images') }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                            <div class="w-full h-full flex items-center justify-center text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            @endif
                            {{-- Category Badge --}}
                            @if($product->category)
                            <span
                                class="absolute top-2 right-2 bg-amber-100 text-amber-800 text-xs font-semibold px-2 py-0.5 rounded-full shadow-sm">
                                {{ $product->category->name }}
                            </span>
                            @endif
                        </div>
                    </a>

                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-base font-semibold text-slate-800 mb-2 line-clamp-2 h-12">
                            <a href="{{ route('products.show', $product) }}"
                                class="hover:brand-text transition-colors">{{ $product->name }}</a>
                        </h3>
                        <p class="text-slate-600 text-sm mb-4 line-clamp-3 flex-grow">{{
                            Str::limit(strip_tags($product->description ?? ''), 90) }}</p>

                        <div
                            class="mt-auto pt-4 border-t border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-3">
                            <a href="{{ route('products.show', $product) }}"
                                class="text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors inline-flex items-center border-b border-gray-300 hover:border-gray-700 pb-0.5">
                                Lihat Detail
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                            <a href="{{ route('quote-request.create', ['product_id' => $product->id]) }}"
                                class="w-full sm:w-auto text-center bg-gray-800 hover:bg-gray-700 text-white text-xs font-bold py-2 px-4 rounded-md transition duration-300 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-gray-800 focus:ring-offset-1">
                                Minta Penawaran
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-10 fade-in" style="animation-delay: 0.5s;">
                {{-- Render pagination links --}}
                {{ $products->appends(request()->query())->links() }} {{-- Ensure filters are kept on pagination --}}
            </div>
            @endif
        </div>

        {{-- Contact Us Section --}}
        <div class="mt-16 brand-gradient-cta text-white rounded-lg shadow-xl overflow-hidden fade-in"
            style="animation-delay: 0.6s;">
            <div class="p-8 md:p-12 flex flex-col md:flex-row items-center justify-between">
                <div class="mb-6 md:mb-0 md:mr-8 text-center md:text-left">
                    <h3 class="text-xl sm:text-2xl font-bold mb-3">Butuh Bantuan atau Produk Spesifik?</h3>
                    <p class="text-slate-300 max-w-2xl">Tim ahli kami siap membantu Anda menemukan solusi terbaik untuk
                        proyek Anda. Jangan ragu untuk menghubungi kami.</p>
                </div>
                <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4 flex-shrink-0">
                    <a href="{{ route('quote-request.create') }}"
                        class="inline-flex items-center justify-center px-6 py-3 bg-white text-gray-800 font-medium rounded-md shadow-md hover:bg-gray-50 transition duration-300 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-700" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        Minta Penawaran
                    </a>
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center justify-center px-6 py-3 bg-gray-800 text-white font-medium rounded-md shadow-md hover:bg-gray-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:ring-offset-2 focus:ring-offset-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>

        {{-- Back to Top Button --}}
        <button id="backToTop"
            class="fixed bottom-8 right-8 bg-gray-800 text-white p-3 rounded-full shadow-lg opacity-0 invisible transition-all duration-300 z-50 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:ring-offset-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
        </button>
    </div>
</div>
@endsection

@push('scripts')
{{-- Basic JS for filter toggle and back-to-top --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mobile Filter Toggle
        const filterToggle = document.getElementById('mobileFilterToggle');
        const filterContainer = document.getElementById('filterContainer');
        const showIcon = filterToggle?.querySelector('.show-icon');
        const hideIcon = filterToggle?.querySelector('.hide-icon');

        filterToggle?.addEventListener('click', () => {
            filterContainer?.classList.toggle('hidden');
            filterContainer?.classList.toggle('md:block'); // Ensure it's block on md+
            showIcon?.classList.toggle('hidden');
            hideIcon?.classList.toggle('hidden');
        });

        // Reset Filter Button
        const resetBtn = document.getElementById('resetFilter');
        const filterForm = document.getElementById('filterForm');
        const searchInput = document.getElementById('search');
        const categorySelect = document.getElementById('category');

        resetBtn?.addEventListener('click', () => {
            if (searchInput) searchInput.value = '';
            if (categorySelect) categorySelect.value = '';
            // Submit the form to reload with cleared filters
            filterForm?.submit();
        });

        // Back to Top Button
        const backToTopButton = document.getElementById('backToTop');
        if (backToTopButton) { // Check if button exists
            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 300) { // Show after scrolling 300px
                    backToTopButton.classList.remove('opacity-0', 'invisible');
                    backToTopButton.classList.add('opacity-100', 'visible');
                } else {
                    backToTopButton.classList.remove('opacity-100', 'visible');
                    backToTopButton.classList.add('opacity-0', 'invisible');
                }
            });
            backToTopButton.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
    });
</script>
@endpush