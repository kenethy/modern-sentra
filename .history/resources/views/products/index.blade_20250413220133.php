@extends('layouts.app')

@section('title', 'Katalog Produk')

@push('styles')
<style>
    /* Animasi dan efek visual */
    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }

    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .stagger-item {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.5s ease-out, transform 0.5s ease-out;
    }

    .stagger-item.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .product-card {
        transition: all 0.4s ease;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .product-image-container {
        position: relative;
        overflow: hidden;
    }

    .product-image {
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .product-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.4) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .product-card:hover .product-overlay {
        opacity: 1;
    }

    .category-badge {
        transition: all 0.3s ease;
    }

    .product-card:hover .category-badge {
        transform: translateY(-3px);
    }

    .detail-button {
        position: relative;
        overflow: hidden;
    }

    .detail-button::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background-color: #99765c;
        transition: width 0.3s ease;
    }

    .detail-button:hover::after {
        width: 100%;
    }

    .filter-container {
        border-radius: 1rem;
        transition: all 0.3s ease;
    }

    .filter-container:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .search-input {
        transition: all 0.3s ease;
    }

    .search-input:focus {
        transform: scale(1.02);
    }

    .filter-button {
        transition: all 0.3s ease;
    }

    .filter-button:hover {
        transform: translateY(-2px);
    }

    /* Hero section styles */
    .hero-section {
        position: relative;
        overflow: hidden;
        background-size: cover;
        background-position: center;
    }

    .hero-overlay {
        background: linear-gradient(to right, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.4) 100%);
    }

    .hero-text {
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background: #99765c;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #876754;
    }
</style>
@endpush

@section('header')
<!-- Hero Section -->
<div class="hero-section bg-cover bg-center h-80 flex items-center"
    style="background-image: url('https://images.unsplash.com/photo-1541123437800-1bb1317badc2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');">
    <div class="hero-overlay absolute inset-0"></div>
    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-lg">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 hero-text">Katalog Produk</h1>
            <p class="text-xl text-white mb-8 opacity-90">Temukan berbagai material konstruksi berkualitas untuk proyek
                Anda</p>
            <div class="flex space-x-4">
                <a href="#product-catalog"
                    class="bg-[#99765c] hover:bg-[#876754] text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 inline-flex items-center">
                    Jelajahi Produk
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="{{ route('quote-request.create') }}"
                    class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-[#99765c] font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                    Minta Penawaran
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="py-12" id="product-catalog">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Filter Section with Modern Design -->
        <div class="mb-12 fade-in">
            <div class="bg-white filter-container p-6 shadow-lg">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Filter Produk</h2>
                    <p class="text-gray-600">Temukan produk yang sesuai dengan kebutuhan proyek Anda</p>
                </div>

                <form action="{{ route('products.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="category" class="block text-gray-700 font-medium mb-2">Kategori</label>
                        <div class="relative">
                            <select name="category" id="category"
                                class="w-full border-gray-300 rounded-lg py-3 px-4 bg-white shadow-sm focus:border-[#99765c] focus:ring focus:ring-[#99765c] focus:ring-opacity-50 appearance-none search-input">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category')==$category->id ? 'selected' :
                                    '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-700">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="search" class="block text-gray-700 font-medium mb-2">Cari Produk</label>
                        <div class="relative">
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                placeholder="Nama produk..."
                                class="w-full border-gray-300 rounded-lg py-3 px-4 shadow-sm focus:border-[#99765c] focus:ring focus:ring-[#99765c] focus:ring-opacity-50 search-input">
                            <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-end space-x-3">
                        <button type="submit"
                            class="bg-[#99765c] hover:bg-[#876754] text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 filter-button flex-grow md:flex-grow-0">
                            <span class="flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                        clip-rule="evenodd" />
                                </svg>
                                Filter
                            </span>
                        </button>
                        @if(request('category') || request('search'))
                        <a href="{{ route('products.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 filter-button flex-grow md:flex-grow-0">
                            <span class="flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                        clip-rule="evenodd" />
                                </svg>
                                Reset
                            </span>
                        </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Products Section with Modern Cards -->
        <div class="mb-12 fade-in">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Produk Kami</h2>
                <p class="text-gray-600">Menampilkan {{ $products->count() }} dari {{ $products->total() }} produk</p>
            </div>

            <!-- Products Grid with Modern Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($products as $index => $product)
                <div class="product-card bg-white stagger-item" style="animation-delay: {{ $index * 0.1 }}s;">
                    <div class="product-image-container">
                        @if(method_exists($product, 'hasMedia') && $product->hasMedia('product_images'))
                        <img src="{{ $product->getFirstMediaUrl('product_images') }}" alt="{{ $product->name }}"
                            class="product-image w-full h-64 object-cover">
                        @else
                        <img src="https://via.placeholder.com/600x400?text=No+Image" alt="{{ $product->name }}"
                            class="product-image w-full h-64 object-cover">
                        @endif
                        <div class="product-overlay"></div>
                        <div class="absolute top-4 right-4">
                            <span
                                class="category-badge bg-[#99765c] bg-opacity-90 text-white text-xs font-bold px-3 py-1.5 rounded-full">
                                {{ $product->category->name }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $product->name }}</h3>
                        <p class="text-gray-600 mb-6 line-clamp-2">{{ Str::limit($product->description, 100) }}</p>
                        <div class="flex justify-between items-center">
                            <a href="{{ route('products.show', $product->slug) }}"
                                class="detail-button text-[#99765c] hover:text-[#876754] font-medium inline-flex items-center justify-center">
                                <span>Lihat Detail</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1.5 flex-shrink-0"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="{{ route('quote-request.product', ['id' => $product->id]) }}"
                                class="bg-[#99765c] hover:bg-[#876754] text-white text-sm font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 transform hover:scale-105">
                                Minta Penawaran
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-3 py-16 text-center bg-white rounded-xl shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Tidak ada produk ditemukan</h3>
                    <p class="text-gray-600 text-lg mb-8">Coba ubah filter pencarian Anda atau lihat semua produk.</p>
                    <a href="{{ route('products.index') }}"
                        class="bg-[#99765c] hover:bg-[#876754] text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                clip-rule="evenodd" />
                        </svg>
                        Lihat Semua Produk
                    </a>
                </div>
                @endforelse
            </div>

            <!-- Pagination with Modern Design -->
            <div class="mt-12">
                <div class="bg-white p-4 rounded-xl shadow-sm">
                    {{ $products->links() }}
                </div>
            </div>
        </div>

        <!-- Call to Action Section -->
        <div class="mb-12 fade-in">
            <div class="bg-gradient-to-r from-[#99765c] to-[#7d5e48] rounded-2xl overflow-hidden shadow-xl">
                <div class="px-8 py-12 md:p-12 text-center md:text-left md:flex items-center">
                    <div class="md:w-2/3 mb-8 md:mb-0 md:pr-8">
                        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Tidak menemukan yang Anda cari?</h2>
                        <p class="text-[#f5f2ef] text-lg mb-6">Hubungi tim kami untuk konsultasi gratis dan penawaran
                            khusus untuk kebutuhan proyek Anda.</p>
                        <div class="flex flex-wrap justify-center md:justify-start gap-4">
                            <a href="/contact"
                                class="bg-white text-[#99765c] hover:bg-[#f5f2ef] font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 inline-flex items-center">
                                Hubungi Kami
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="/quote-request"
                                class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-[#99765c] font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                                Minta Penawaran Khusus
                            </a>
                        </div>
                    </div>
                    <div class="md:w-1/3">
                        <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80"
                            alt="Material Konstruksi"
                            class="rounded-lg shadow-lg transform -rotate-3 hover:rotate-0 transition duration-500">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Intersection Observer untuk animasi scroll
    document.addEventListener('DOMContentLoaded', function () {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.fade-in, .stagger-item').forEach(item => {
            observer.observe(item);
        });

        // Smooth scroll untuk anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            });
        });
    });
</script>
@endpush

@endsection