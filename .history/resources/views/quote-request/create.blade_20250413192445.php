@extends('layouts.app')

@section('title', 'Minta Penawaran Harga')

@push('styles')
<style>
    /* Akan ditambahkan nanti */
</style>
@endpush

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Minta Penawaran Harga</h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Pilih produk yang Anda minati dan isi formulir di bawah
                untuk mendapatkan penawaran harga terbaik dari kami.</p>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
            <form action="{{ route('quote-request.store') }}" method="POST" id="quoteRequestForm">
                @csrf

                <!-- Step Indicator -->
                <div class="mb-8">
                    <div class="flex items-center justify-between">
                        <div class="flex flex-col items-center">
                            <div
                                class="w-10 h-10 rounded-full bg-[#99765c] text-white flex items-center justify-center font-bold text-lg">
                                1</div>
                            <span class="mt-2 text-sm font-medium text-[#99765c]">Pilih Produk</span>
                        </div>
                        <div class="flex-1 h-1 mx-4 bg-gray-200">
                            <div class="h-full bg-[#99765c] w-0" id="progressBar1"></div>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold text-lg"
                                id="step2Circle">2</div>
                            <span class="mt-2 text-sm font-medium text-gray-500" id="step2Text">Informasi Kontak</span>
                        </div>
                    </div>
                </div>

                <!-- Step 1: Product Selection -->
                <div id="step1" class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Pilih Produk</h2>

                    <!-- Selected Products Summary -->
                    <div class="mb-8 p-4 bg-gray-50 rounded-lg" id="selectedProductsContainer">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Produk yang Dipilih</h3>
                        <div id="selectedProductsList" class="space-y-4">
                            <!-- Selected products will appear here -->
                            <div class="text-gray-500 text-center py-4" id="noProductsSelected">
                                Belum ada produk yang dipilih. Silakan pilih produk dari daftar di bawah.
                            </div>
                        </div>
                    </div>

                    <!-- Featured Products -->
                    @if($featuredProducts->isNotEmpty())
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Produk Unggulan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($featuredProducts as $product)
                            <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition duration-300 product-card"
                                data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}">
                                <div class="flex items-center p-4">
                                    <div class="flex-shrink-0 w-16 h-16 bg-gray-100 rounded-md overflow-hidden">
                                        @if(method_exists($product, 'hasMedia') && $product->hasMedia('product_images'))
                                        <img src="{{ $product->getFirstMediaUrl('product_images') }}"
                                            alt="{{ $product->name }}" class="w-full h-full object-cover">
                                        @else
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <h4 class="text-sm font-medium text-gray-900">{{ $product->name }}</h4>
                                        <p class="text-xs text-gray-500">{{ $product->category->name }}</p>
                                    </div>
                                    <div>
                                        <button type="button"
                                            class="select-product-btn text-[#99765c] hover:text-[#876754] p-2 rounded-full focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- All Products by Category -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Semua Produk</h3>

                        <!-- Search and Filter -->
                        <div class="mb-6 flex flex-col md:flex-row gap-4">
                            <div class="flex-1">
                                <div class="relative">
                                    <input type="text" id="productSearch" placeholder="Cari produk..."
                                        class="w-full border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:ring-[#99765c] focus:border-[#99765c]">
                                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full md:w-64">
                                <select id="categoryFilter"
                                    class="w-full border-gray-300 rounded-lg focus:ring-[#99765c] focus:border-[#99765c]">
                                    <option value="">Semua Kategori</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Products List by Category -->
                        <div class="space-y-6" id="productsByCategory">
                            @foreach($categories as $category)
                            <div class="category-section" data-category-id="{{ $category->id }}">
                                <h4
                                    class="text-md font-medium text-gray-800 mb-3 flex items-center cursor-pointer category-header">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 mr-2 transform transition-transform duration-200" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                    {{ $category->name }} ({{ $category->products->count() }})
                                </h4>
                                <div class="category-products pl-7 space-y-2">
                                    @foreach($category->products as $product)
                                    <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition duration-300 product-item"
                                        data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}"
                                        data-category-id="{{ $category->id }}">
                                        <div class="flex items-center p-3">
                                            <div class="flex-shrink-0 w-12 h-12 bg-gray-100 rounded-md overflow-hidden">
                                                @if(method_exists($product, 'hasMedia') &&
                                                $product->hasMedia('product_images'))
                                                <img src="{{ $product->getFirstMediaUrl('product_images') }}"
                                                    alt="{{ $product->name }}" class="w-full h-full object-cover">
                                                @else
                                                <div
                                                    class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="ml-3 flex-1">
                                                <h5 class="text-sm font-medium text-gray-900">{{ $product->name }}</h5>
                                                <p class="text-xs text-gray-500 truncate">{{
                                                    Str::limit($product->description, 60) }}</p>
                                            </div>
                                            <div>
                                                <button type="button"
                                                    class="select-product-btn text-[#99765c] hover:text-[#876754] p-2 rounded-full focus:outline-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Step 2: Contact Information (hidden initially) -->
                <div id="step2" class="hidden">
                    <!-- Contact form will be added here -->
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-8">
                    <button type="button" id="prevButton"
                        class="hidden px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-medium hover:bg-gray-300 transition duration-300">
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            Kembali
                        </span>
                    </button>
                    <button type="button" id="nextButton"
                        class="px-6 py-3 bg-[#99765c] text-white rounded-lg font-medium hover:bg-[#876754] transition duration-300">
                        <span class="flex items-center">
                            Lanjutkan
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </button>
                    <button type="submit" id="submitButton"
                        class="hidden px-6 py-3 bg-[#99765c] text-white rounded-lg font-medium hover:bg-[#876754] transition duration-300">
                        <span class="flex items-center">
                            Kirim Permintaan
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Akan ditambahkan nanti
</script>
@endpush