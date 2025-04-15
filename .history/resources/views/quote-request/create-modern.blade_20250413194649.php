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
                        <!-- Will be added in the next step -->
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