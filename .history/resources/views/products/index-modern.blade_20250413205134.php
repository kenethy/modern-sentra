@extends('layouts.app')

@section('title', 'Katalog Produk')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/products-modern.css') }}">
@endpush

@section('content')
<div class="bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Hero Section -->
        <div class="hero-section mb-12 fade-in" style="background-image: url('{{ asset('images/hero-bg.jpg') }}')">
            <div class="hero-content py-16 px-8 md:py-24 md:px-12">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4 max-w-3xl">
                    Temukan Produk Konstruksi Berkualitas untuk Proyek Anda
                </h1>
                <p class="text-lg text-gray-200 mb-8 max-w-2xl">
                    Kami menyediakan berbagai produk konstruksi berkualitas tinggi dengan harga kompetitif untuk memenuhi kebutuhan proyek Anda.
                </p>
                <a href="#products" class="inline-flex items-center px-6 py-3 bg-[#99765c] text-white font-medium rounded-lg shadow-lg hover:bg-[#876754] transition duration-300 transform hover:scale-105">
                    Lihat Katalog
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
        
        <!-- Filter Section -->
        <div class="mb-10 fade-in" style="animation-delay: 0.2s;">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-4 md:mb-0">Katalog Produk</h2>
                
                <!-- Mobile Filter Toggle -->
                <button id="mobileFilterToggle" class="md:hidden flex items-center text-gray-700 font-medium mb-4">
                    <span class="show-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                        </svg>
                        Tampilkan Filter
                    </span>
                    <span class="hide-icon hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        Sembunyikan Filter
                    </span>
                </button>
            </div>
            
            <div id="filterContainer" class="filter-container p-6 mb-8 hidden md:block">
                <form id="filterForm" action="{{ route('products.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Search Input -->
                    <div class="col-span-1 md:col-span-1">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Produk</label>
                        <div class="relative">
                            <input type="text" id="search" name="search" value="{{ request('search') }}" 
                                   class="search-input w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-[#99765c] focus:border-[#99765c]"
                                   placeholder="Nama produk...">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Category Filter -->
                    <div class="col-span-1 md:col-span-1">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select id="category" name="category" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#99765c] focus:border-[#99765c]">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Filter Actions -->
                    <div class="col-span-1 md:col-span-1 flex items-end">
                        <button type="submit" class="filter-button mr-2 px-4 py-2 bg-[#99765c] text-white rounded-lg hover:bg-[#876754] transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                            </svg>
                            Filter
                        </button>
                        <button id="resetFilter" type="button" class="filter-button px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                            </svg>
                            Reset
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Products Section -->
        <div id="products" class="mb-12">
            @if($products->isEmpty())
                <div class="empty-state fade-in" style="animation-delay: 0.3s;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-xl font-medium text-gray-900 mb-2">Tidak Ada Produk Ditemukan</h3>
                    <p class="text-gray-500 mb-4">Coba ubah filter atau kata kunci pencarian Anda.</p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-[#99765c] text-white rounded-lg hover:bg-[#876754] transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                        </svg>
                        Lihat Semua Produk
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($products as $index => $product)
                        <div class="product-card stagger-item" style="animation-delay: {{ $index * 0.1 }}s;">
                            <div class="product-image-container">
                                @if($product->hasMedia('product_images'))
                                    <img src="{{ $product->getFirstMediaUrl('product_images') }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="product-category">{{ $product->category->name }}</div>
                            </div>
                            
                            <div class="p-5">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 h-14">{{ $product->name }}</h3>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3 h-16">{{ Str::limit($product->description, 100) }}</p>
                                
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mt-4 space-y-3 sm:space-y-0">
                                    <a href="{{ route('products.show', $product) }}" class="detail-button text-[#99765c] font-medium">
                                        Lihat Detail
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 inline-block" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    
                                    <a href="{{ route('quote-request.product', ['id' => $product->id]) }}" class="quote-button bg-[#99765c] hover:bg-[#876754] text-white text-sm font-medium py-2 px-4 rounded-lg transition duration-300">
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
        </div>
        
        <!-- Back to Top Button -->
        <button id="backToTop" class="fixed bottom-8 right-8 bg-[#99765c] text-white p-3 rounded-full shadow-lg opacity-0 invisible transition-all duration-300 z-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
        </button>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/products-modern.js') }}"></script>
@endpush
