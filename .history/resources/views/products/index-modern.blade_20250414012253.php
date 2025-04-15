@extends('layouts.app')

@section('title', 'Katalog Produk')

@push('styles')
{{-- Removed reference to products-modern.css as we are using Tailwind directly --}}
{{-- <link rel="stylesheet" href="{{ asset('css/products-modern.css') }}"> --}}
<style>
    /* Basic fade-in animation */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .fade-in {
        animation: fadeIn 0.6s ease-out forwards;
        opacity: 0; /* Start hidden */
    }
    /* Staggered animation for product cards */
    .stagger-item {
        animation: fadeIn 0.6s ease-out forwards;
        opacity: 0; /* Start hidden */
    }

    /* Custom scrollbar (optional, keep if desired) */
    /* ... (keep existing scrollbar styles if needed) ... */

    /* Ensure sufficient contrast for accessibility */
    .brand-text { color: #99765c; }
    .brand-text-dark { color: #876754; }
    .brand-bg { background-color: #99765c; }
    .brand-bg-dark { background-color: #876754; }
    .brand-ring-focus:focus {
        --tw-ring-color: #99765c;
        --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
        --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);
        box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
        border-color: #99765c;
    }
    .brand-border-focus:focus {
         border-color: #99765c;
    }

</style>
@endpush

@section('content')
<div class="bg-slate-100 py-12 px-4 sm:px-6 lg:px-8"> {{-- Slightly lighter background --}}
    <div class="max-w-7xl mx-auto">
        {{-- Hero Section --}}
        <div class="mb-12 rounded-lg overflow-hidden shadow-lg fade-in" style="background: linear-gradient(to right, #a1887f, #795548);"> {{-- Adjusted gradient --}}
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
                <button id="mobileFilterToggle" class="md:hidden flex items-center text-slate-700 font-medium mb-4 p-2 rounded border border-slate-300 hover:bg-slate-50">
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
            <div id="filterContainer" class="bg-white p-6 rounded-lg shadow-md mb-8 hidden md:block border border-slate-200">
                <form id="filterForm" action="{{ route('products.index') }}" method="GET"
                    class="grid grid-cols-1 md:grid-cols-3 gap-6">
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
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filter Actions --}}
                    <div class="flex items-end space-x-3">
                        <button type="submit"
                            class="flex-1 inline-flex items-center justify-center px-4 py-2 brand-bg text-white rounded-lg hover:brand-bg-dark transition duration-300 focus:outline-none brand-ring-focus focus:ring-offset-2 text-sm font-medium shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                    clip-rule="evenodd" />
                            </svg>
                            Filter
                        </button>
                        <button id="resetFilter" type="button"
                            class="flex-1 inline-flex items-center justify-center px-4 py-2 border border-slate-300 text-slate-700 bg-white rounded-lg hover:bg-slate-50 transition duration-300 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2 text-sm font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                @foreach($products as $index => $product)
                <div class="product-card stagger-item" style="animation-delay: {{ $index * 0.1 }}s;">
                    <div class="product-image-container">
                        @if($product->hasMedia('product_images'))
                        <img src="{{ $product->getFirstMediaUrl('product_images') }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        @endif
                        <div class="product-category">{{ $product->category->name }}</div>
                    </div>

                    <div class="p-5">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 h-14">{{ $product->name }}</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3 h-16">{{ Str::limit($product->description,
                            100) }}</p>

                        <div
                            class="flex flex-col sm:flex-row justify-between items-start sm:items-center mt-4 space-y-3 sm:space-y-0">
                            <a href="{{ route('products.show', $product) }}"
                                class="detail-button text-[#99765c] font-small">
                                Lihat Detail
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 inline-block"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>

                            <a href="{{ route('quote-request.product', ['id' => $product->id]) }}"
                                class="quote-button bg-[#99765c] hover:bg-[#876754] text-white text-sm font-medium py-2 px-4 rounded-lg transition duration-300">
                                Minta Penawaran
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10 fade-in" style="animation-delay: 0.5s;">
                {{ $products->links() }}
            </div>
            @endif

            <!-- Contact Us Section -->
            <div class="mt-16 bg-white rounded-xl shadow-md overflow-hidden fade-in" style="animation-delay: 0.6s;">
                <div class="p-6 sm:p-8 md:p-10 flex flex-col md:flex-row items-center justify-between">
                    <div class="mb-6 md:mb-0 md:mr-8">
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-3">Tidak menemukan produk yang Anda
                            cari?</h3>
                        <p class="text-gray-600 max-w-2xl">Kami memiliki ribuan produk konstruksi yang mungkin tidak
                            tercantum di katalog online. Hubungi tim kami untuk mendapatkan produk yang Anda butuhkan.
                            <span class="font-semibold text-[#99765c]">Pasti tersedia!</span>
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3">
                        <a href="{{ route('quote-request.create') }}"
                            class="inline-flex items-center justify-center px-6 py-3 bg-[#99765c] text-white font-medium rounded-lg shadow-md hover:bg-[#876754] transition duration-300 transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            Minta Penawaran Khusus
                        </a>

                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('contact.whatsapp', '6281234567890')) }}?text=Halo, saya mencari produk yang tidak ada di katalog. Bisakah Anda membantu?"
                            target="_blank"
                            class="inline-flex items-center justify-center px-6 py-3 bg-green-600 text-white font-medium rounded-lg shadow-md hover:bg-green-700 transition duration-300 transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                            </svg>
                            Hubungi via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back to Top Button -->
        <button id="backToTop"
            class="fixed bottom-8 right-8 bg-[#99765c] text-white p-3 rounded-full shadow-lg opacity-0 invisible transition-all duration-300 z-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/products-modern.js') }}"></script>
@endpush