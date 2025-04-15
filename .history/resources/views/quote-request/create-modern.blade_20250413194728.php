@extends('layouts.app')

@section('title', 'Minta Penawaran Harga')

@push('styles')
<style>
    /* Product item styling */
    .product-item {
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .product-item:hover {
        transform: translateY(-2px);
    }

    .product-item.selected {
        border-color: #99765c;
        background-color: rgba(153, 118, 92, 0.05);
    }

    /* Form control styling */
    .form-control:focus {
        border-color: #99765c;
        box-shadow: 0 0 0 0.2rem rgba(153, 118, 92, 0.25);
    }
</style>
@endpush

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-gray-900 mb-3">Minta Penawaran Harga</h1>
            <p class="text-gray-600 max-w-3xl mx-auto">Pilih produk yang Anda minati dan isi formulir untuk mendapatkan
                penawaran harga terbaik.</p>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <form id="quoteForm" action="{{ route('quote-request.store') }}" method="POST">
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
                            <div class="h-full bg-[#99765c] w-0" id="progressBar"></div>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold text-lg"
                                id="step2Circle">2</div>
                            <span class="mt-2 text-sm font-medium text-gray-500" id="step2Text">Informasi Kontak</span>
                        </div>
                    </div>
                </div>

                <!-- Step 1: Product Selection -->
                <div id="step1" class="space-y-6">
                    <div class="flex justify-between items-center border-b pb-4 mb-6">
                        <h2 class="text-xl font-semibold text-gray-800">Pilih Produk</h2>
                    </div>

                    <!-- Search and Filter -->
                    <div class="flex flex-col md:flex-row gap-4 mb-6">
                        <div class="flex-1">
                            <div class="relative">
                                <input type="text" id="productSearch" placeholder="Cari produk..."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99765c] form-control">
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="w-full md:w-48">
                            <select id="categoryFilter"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99765c] form-control">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Selected Products -->
                    <div id="selectedProductsContainer" class="mb-6 hidden">
                        <h3 class="text-md font-medium text-gray-700 mb-3">Produk yang Dipilih</h3>
                        <div id="selectedProductsList"
                            class="space-y-2 border border-gray-200 rounded-lg p-4 bg-gray-50">
                            <!-- Selected products will be displayed here -->
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div class="space-y-6">
                        <!-- Featured Products -->
                        @if($featuredProducts->isNotEmpty())
                        <div class="mb-6">
                            <h3 class="text-md font-medium text-gray-700 mb-3">Produk Unggulan</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($featuredProducts as $product)
                                <div class="product-item rounded-lg overflow-hidden border border-gray-200 cursor-pointer"
                                    data-id="{{ $product->id }}" data-name="{{ $product->name }}">
                                    <div class="flex p-3">
                                        <div
                                            class="flex-shrink-0 w-16 h-16 bg-gray-100 rounded-md overflow-hidden mr-3">
                                            @if(method_exists($product, 'hasMedia') &&
                                            $product->hasMedia('product_images'))
                                            <img src="{{ $product->getFirstMediaUrl('product_images') }}"
                                                alt="{{ $product->name }}" class="w-full h-full object-cover">
                                            @else
                                            <div
                                                class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="text-sm font-medium text-gray-900">{{ $product->name }}</h4>
                                            <p class="text-xs text-gray-500">{{ $product->category->name }}</p>
                                        </div>
                                        <div class="flex items-center">
                                            <div
                                                class="w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center check-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4 text-white hidden" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- All Products -->
                        <div>
                            <h3 class="text-md font-medium text-gray-700 mb-3">Semua Produk</h3>
                            <div id="allProductsContainer" class="space-y-2">
                                @foreach($categories as $category)
                                <div class="category-section mb-4" data-category-id="{{ $category->id }}">
                                    <div class="flex items-center mb-2 cursor-pointer category-header">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4 mr-2 text-gray-500 transform transition-transform duration-200"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                        <h4 class="text-sm font-medium text-gray-800">{{ $category->name }}</h4>
                                        <span class="text-xs text-gray-500 ml-2">({{ $category->products->count()
                                            }})</span>
                                    </div>
                                    <div class="category-products pl-6 space-y-2 hidden">
                                        @foreach($category->products as $product)
                                        <div class="product-item rounded-lg overflow-hidden border border-gray-200 cursor-pointer"
                                            data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                            data-category="{{ $category->id }}">
                                            <div class="flex p-3">
                                                <div
                                                    class="flex-shrink-0 w-12 h-12 bg-gray-100 rounded-md overflow-hidden mr-3">
                                                    @if(method_exists($product, 'hasMedia') &&
                                                    $product->hasMedia('product_images'))
                                                    <img src="{{ $product->getFirstMediaUrl('product_images') }}"
                                                        alt="{{ $product->name }}" class="w-full h-full object-cover">
                                                    @else
                                                    <div
                                                        class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="flex-1">
                                                    <h4 class="text-sm font-medium text-gray-900">{{ $product->name }}
                                                    </h4>
                                                    <p class="text-xs text-gray-500 truncate">{{
                                                        Str::limit($product->description, 60) }}</p>
                                                </div>
                                                <div class="flex items-center">
                                                    <div
                                                        class="w-6 h-6 rounded-full border-2 border-gray-300 flex items-center justify-center check-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-4 w-4 text-white hidden" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    </div>
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

                    <!-- Navigation Buttons -->
                    <div class="flex justify-end mt-8 pt-4 border-t border-gray-200">
                        <button type="button" id="nextBtn"
                            class="px-6 py-2 bg-[#99765c] text-white rounded-lg hover:bg-[#876754] transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                            Lanjutkan
                            <span class="ml-2">→</span>
                        </button>
                    </div>
                </div>

                <!-- Step 2: Contact Information (hidden initially) -->
                <div id="step2" class="space-y-6 hidden">
                    <!-- Will be added in a later step -->
                </div>

                <!-- Hidden inputs for selected products -->
                <div id="selectedProductsInputs"></div>
            </form>
        </div>
    </div>
</div>
@endsection