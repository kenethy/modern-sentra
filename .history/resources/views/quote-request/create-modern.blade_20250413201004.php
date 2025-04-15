@extends('layouts.app')

@section('title', 'Minta Penawaran Harga - Modern Sentra')

@push('styles')
<style>
    /* Custom transition for height */
    .category-products {
        transition: max-height 0.5s ease-out, opacity 0.3s ease-out;
        max-height: 0;
        opacity: 0;
        overflow: hidden;
    }

    .category-products.expanded {
        max-height: 1000px;
        /* Adjust if categories have many products */
        opacity: 1;
    }

    /* Subtle scrollbar for product list if needed */
    #allProductsContainer::-webkit-scrollbar {
        width: 6px;
    }

    #allProductsContainer::-webkit-scrollbar-track {
        background: #f1f5f9;
        /* slate-100 */
    }

    #allProductsContainer::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        /* slate-300 */
        border-radius: 3px;
    }

    #allProductsContainer::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
        /* slate-400 */
    }

    /* Styling for quantity input */
    /* Hide default number input arrows */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type=number] {
        -moz-appearance: textfield;
        /* Firefox */
    }
</style>
@endpush

@section('content')

<div class="py-16 sm:py-20 bg-slate-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header Section --}}
        <div class="text-center mb-12 md:mb-16">
            <h1 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">Minta Penawaran Harga</h1>
            <p class="text-base sm:text-lg text-slate-600 max-w-3xl mx-auto">
                Pilih produk konstruksi yang Anda butuhkan, tentukan jumlahnya, lalu isi detail kontak Anda untuk
                mendapatkan penawaran terbaik dari kami.
            </p>
        </div>

        {{-- Main Content Card --}}
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            {{-- Add data attributes to the form for initial product --}}
            <form id="quoteForm" action="{{ route('quote-request.store') }}" method="POST" class="p-6 sm:p-8 lg:p-10"
                  data-initial-product-id="{{ isset($selectedProduct) ? $selectedProduct->id : '' }}"
                  data-initial-product-name="{{ isset($selectedProduct) ? $selectedProduct->name : '' }}">
                @csrf

                {{-- Step Indicator (Minimalist) --}}
                <div class="mb-10">
                    <div class="flex items-center">
                        {{-- Step 1 --}}
                        <div class="flex items-center" id="stepIndicator1">
                            <div
                                class="w-6 h-6 rounded-full bg-[#99765c] text-white flex items-center justify-center text-xs font-bold ring-4 ring-[#99765c]/30 transition-all duration-300">
                                1</div>
                            <span class="ml-3 text-sm font-medium text-[#99765c] transition-colors duration-300">Pilih
                                Produk</span>
                        </div>
                        {{-- Connector --}}
                        <div class="flex-1 h-0.5 mx-4 bg-gradient-to-r from-[#99765c] via-slate-200 to-slate-200 transition-all duration-500"
                            id="progressConnector">
                            <div class="h-full bg-[#99765c] w-0 transition-all duration-500" id="progressBar"
                                style="width: 0%;"></div>
                        </div>
                        {{-- Step 2 --}}
                        <div class="flex items-center" id="stepIndicator2">
                            <div
                                class="w-6 h-6 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center text-xs font-bold ring-4 ring-transparent transition-all duration-300">
                                2</div>
                            <span
                                class="ml-3 text-sm font-medium text-slate-500 transition-colors duration-300">Informasi
                                Kontak</span>
                        </div>
                    </div>
                </div>

                {{-- Step 1: Product Selection --}}
                <div id="step1" class="space-y-8">
                    <h2 class="text-2xl font-semibold text-slate-800 border-b border-slate-200 pb-4">1. Pilih Produk
                        Anda</h2>

                    {{-- Search and Filter --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                        <div class="md:col-span-2">
                            <label for="productSearch" class="block text-sm font-medium text-slate-700 mb-1">Cari
                                Produk</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </span>
                                <input type="text" id="productSearch" placeholder="Masukkan nama produk..."
                                    class="w-full pl-10 pr-4 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99765c] focus:border-[#99765c] transition duration-200 text-sm">
                            </div>
                        </div>
                        <div>
                            <label for="categoryFilter" class="block text-sm font-medium text-slate-700 mb-1">Filter
                                Kategori</label>
                            <select id="categoryFilter"
                                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99765c] focus:border-[#99765c] transition duration-200 text-sm appearance-none bg-white bg-no-repeat bg-right-3"
                                style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' viewBox=\'0 0 20 20\'%3E%3Cpath stroke=\'%236b7280\' stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'1.5\' d=\'M6 8l4 4 4-4\'/%3E%3C/svg%3E'); background-position: right 0.75rem center; background-size: 1.25em 1.25em;">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Selected Products Preview --}}
                    <div id="selectedProductsContainer" class="space-y-4 hidden">
                        <h3 class="text-lg font-medium text-slate-700">Produk Dipilih (<span
                                id="selectedCount">0</span>)</h3>
                        <div id="selectedProductsList"
                            class="space-y-3 max-h-60 overflow-y-auto border border-slate-200 rounded-lg p-4 bg-slate-50">
                            {{-- Selected products will be dynamically inserted here --}}
                            <p class="text-sm text-slate-500 text-center italic">Belum ada produk yang dipilih.</p>
                        </div>
                    </div>

                    {{-- Products Listing Area --}}
                    <div class="space-y-6">
                        {{-- Featured Products (Optional enhanced display) --}}
                        @if($featuredProducts->isNotEmpty())
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-slate-700 mb-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-amber-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                Produk Unggulan
                            </h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($featuredProducts as $product)
                                @include('partials.quote_product_item', ['product' => $product])
                                @endforeach
                            </div>
                        </div>
                        @endif

                        {{-- All Products by Category (Accordion) --}}
                        <div>
                            <h3 class="text-lg font-medium text-slate-700 mb-3">Semua Produk</h3>
                            <div id="allProductsContainer"
                                class="space-y-1 border border-slate-200 rounded-lg overflow-hidden">
                                @if($categories->isEmpty())
                                <p class="p-4 text-sm text-slate-500">Tidak ada produk tersedia.</p>
                                @else
                                @foreach($categories as $category)
                                <div class="category-section border-b border-slate-200 last:border-b-0"
                                    data-category-id="{{ $category->id }}">
                                    <div
                                        class="category-header flex items-center justify-between p-4 cursor-pointer hover:bg-slate-50 transition-colors duration-200">
                                        <div class="flex items-center">
                                            <h4 class="text-base font-medium text-slate-800">{{ $category->name }}</h4>
                                            <span
                                                class="text-xs text-slate-500 ml-2 bg-slate-200 px-1.5 py-0.5 rounded">({{
                                                $category->products->count() }})</span>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 text-slate-500 transform transition-transform duration-300 arrow-icon"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                    <div class="category-products bg-slate-50/50">
                                        <div class="p-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            @if($category->products->isEmpty())
                                            <p class="text-sm text-slate-500 italic col-span-full">Tidak ada produk
                                                dalam kategori ini.</p>
                                            @else
                                            @foreach($category->products as $product)
                                            @include('partials.quote_product_item', ['product' => $product,
                                            'category_id' => $category->id])
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Navigation Button --}}
                    <div class="flex justify-end mt-10 pt-6 border-t border-slate-200">
                        <button type="button" id="nextBtn" disabled
                            class="inline-flex items-center px-8 py-3 bg-[#99765c] text-white font-semibold rounded-lg hover:bg-[#876754] transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none focus:ring-2 focus:ring-[#99765c] focus:ring-offset-2">
                            Lanjut ke Informasi Kontak
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Step 2: Contact Information (hidden initially) --}}
                <div id="step2" class="space-y-8 hidden">
                    <h2 class="text-2xl font-semibold text-slate-800 border-b border-slate-200 pb-4">2. Informasi Kontak
                        Anda</h2>

                    {{-- Selected Products Summary --}}
                    <div class="mb-6 bg-slate-50 rounded-lg p-4 sm:p-6 border border-slate-200">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-slate-700">Review Pilihan Produk</h3>
                            <button type="button" id="editProductsBtn"
                                class="inline-flex items-center text-sm font-medium text-[#99765c] hover:text-[#876754] hover:underline">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                Edit Produk
                            </button>
                        </div>
                        <div id="productsReview"
                            class="text-sm text-slate-600 divide-y divide-slate-200 max-h-60 overflow-y-auto">
                            {{-- Selected products summary will be dynamically inserted here --}}
                        </div>
                    </div>

                    {{-- Contact Form --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                        {{-- Form Fields --}}
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" required placeholder="contoh: Budi Santoso"
                                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99765c] focus:border-[#99765c] transition duration-200 text-sm">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" required
                                placeholder="contoh: budi.s@example.com"
                                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99765c] focus:border-[#99765c] transition duration-200 text-sm">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-slate-700 mb-1">Nomor Telepon <span
                                    class="text-red-500">*</span></label>
                            <input type="tel" id="phone" name="phone" required placeholder="contoh: 081234567890"
                                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99765c] focus:border-[#99765c] transition duration-200 text-sm">
                        </div>
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-slate-700 mb-1">Nama
                                Perusahaan (Opsional)</label>
                            <input type="text" id="company_name" name="company_name"
                                placeholder="contoh: PT Maju Jaya Konstruksi"
                                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99765c] focus:border-[#99765c] transition duration-200 text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label for="message" class="block text-sm font-medium text-slate-700 mb-1">Pesan / Kebutuhan
                                Detail <span class="text-red-500">*</span></label>
                            <textarea id="message" name="message" rows="5" required
                                class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99765c] focus:border-[#99765c] transition duration-200 text-sm"
                                placeholder="Jelaskan kebutuhan Anda secara detail, termasuk spesifikasi, lokasi proyek (jika relevan), perkiraan waktu, atau pertanyaan lainnya..."></textarea>
                            <p class="mt-1 text-xs text-slate-500">Semakin detail informasi Anda, semakin akurat
                                penawaran yang dapat kami berikan.</p>
                        </div>
                    </div>

                    {{-- Navigation Buttons --}}
                    <div
                        class="flex flex-col sm:flex-row justify-between items-center mt-10 pt-6 border-t border-slate-200 gap-4">
                        <button type="button" id="prevBtn"
                            class="inline-flex items-center px-6 py-2.5 border-2 border-slate-300 text-slate-700 font-medium rounded-lg hover:bg-slate-100 hover:border-slate-400 transition duration-300 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2 w-full sm:w-auto justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                            </svg>
                            Kembali Pilih Produk
                        </button>
                        <button type="submit" id="submitBtn"
                            class="inline-flex items-center px-8 py-3 bg-[#99765c] text-white font-semibold rounded-lg hover:bg-[#876754] transition duration-300 focus:outline-none focus:ring-2 focus:ring-[#99765c] focus:ring-offset-2 w-full sm:w-auto justify-center">
                            Kirim Permintaan Penawaran
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Hidden inputs for selected products data --}}
                <div id="selectedProductsInputs"></div>
            </form>
        </div>
    </div>
</div>

{{-- Partial for Product Item --}}
{{-- Create resources/views/partials/quote_product_item.blade.php --}}
{{--
<div class="product-item group rounded-lg border border-slate-200 hover:border-[#99765c] hover:bg-amber-50/30 transition-all duration-200 cursor-pointer {{ isset($selectedProducts[$product->id]) ? 'selected border-[#99765c] bg-amber-50/50' : '' }}"
    data-id="{{ $product->id }}" data-name="{{ $product->name }}"
    data-category="{{ $category_id ?? $product->category->id }}">
    <div class="flex items-center p-3 space-x-3">
        <div class="flex-shrink-0 w-16 h-16 bg-slate-100 rounded-md overflow-hidden border border-slate-200">
            @if(method_exists($product, 'hasMedia') && $product->hasMedia('product_images'))
            <img src="{{ $product->getFirstMediaUrl('product_images', 'thumbnail') ?: $product->getFirstMediaUrl('product_images') }}"
                alt="{{ $product->name }}" class="w-full h-full object-cover">
            @else
            <div class="w-full h-full flex items-center justify-center bg-slate-200 text-slate-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            @endif
        </div>
        <div class="flex-1 min-w-0">
            <h4 class="text-sm font-medium text-slate-900 truncate group-hover:text-[#876754]">{{ $product->name }}</h4>
            <p class="text-xs text-slate-500">{{ $product->category->name }}</p>
            <p class="text-xs text-slate-600 mt-1 line-clamp-1">{{ Str::limit($product->description, 50) }}</p>
        </div>
        <div
            class="check-indicator flex items-center justify-center w-6 h-6 rounded-full border-2 border-slate-300 group-hover:border-[#99765c] transition-colors duration-200 {{ isset($selectedProducts[$product->id]) ? 'bg-[#99765c] border-[#99765c]' : 'bg-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4 text-white {{ isset($selectedProducts[$product->id]) ? '' : 'hidden' }}" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>
    </div>
</div>
--}}
@endsection

@push('scripts')
<script>
    // Global function to handle product item clicks
    function handleProductItemClick(element) {
        // Wait for DOM to be ready
        if (!window.selectedProductsInitialized) {
            setTimeout(() => handleProductItemClick(element), 100);
            return;
        }

        const productId = element.dataset.id;
        const productName = element.dataset.name;

        // Toggle selection
        if (element.classList.contains('selected')) {
            // Deselect
            element.classList.remove('selected');
            element.querySelector('.check-indicator').classList.remove('bg-[#99765c]', 'border-[#99765c]');
            element.querySelector('.check-indicator svg').classList.add('hidden');

            // Remove from selectedProducts object
            if (window.selectedProducts && window.selectedProducts[productId]) {
                delete window.selectedProducts[productId];
            }
        } else {
            // Select
            element.classList.add('selected');
            element.querySelector('.check-indicator').classList.add('bg-[#99765c]', 'border-[#99765c]');
            element.querySelector('.check-indicator svg').classList.remove('hidden');

            // Add to selectedProducts object
            if (window.selectedProducts) {
                window.selectedProducts[productId] = {
                    id: productId,
                    name: productName,
                    quantity: 1
                };
            }
        }

        // Update UI if the function exists
        if (window.updateSelectedProductsUI) {
            window.updateSelectedProductsUI();
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Make selectedProducts globally accessible
        window.selectedProducts = {};
        window.updateSelectedProductsUI = null; // Will be set later
        // DOM Elements Cache
        const elements = {
            step1: document.getElementById('step1'),
            step2: document.getElementById('step2'),
            nextBtn: document.getElementById('nextBtn'),
            prevBtn: document.getElementById('prevBtn'),
            editProductsBtn: document.getElementById('editProductsBtn'),
            selectedProductsContainer: document.getElementById('selectedProductsContainer'),
            selectedProductsList: document.getElementById('selectedProductsList'),
            selectedCount: document.getElementById('selectedCount'),
            productsReview: document.getElementById('productsReview'),
            selectedProductsInputs: document.getElementById('selectedProductsInputs'),
            productSearch: document.getElementById('productSearch'),
            categoryFilter: document.getElementById('categoryFilter'),
            quoteForm: document.getElementById('quoteForm'),
            progressBar: document.getElementById('progressBar'),
            progressConnector: document.getElementById('progressConnector'),
            stepIndicator1: document.getElementById('stepIndicator1'),
            stepIndicator2: document.getElementById('stepIndicator2'),
            allProductItems: () => document.querySelectorAll('.product-item'), // Use function for dynamic selection
            categoryHeaders: document.querySelectorAll('.category-header'),
            allProductsContainer: document.getElementById('allProductsContainer')
        };

        // State
        let selectedProducts = {};

        // Initialize
        initEventListeners();
        updateSelectedProductsUI(); // Initial UI setup

        // Add click event to all product items directly
        document.querySelectorAll('.product-item').forEach(item => {
            item.addEventListener('click', function () {
                const productId = this.dataset.id;
                const productName = this.dataset.name;
                toggleProductSelection(productId, productName, this);
            });
        });

        // --- Event Listeners Setup ---
        function initEventListeners() {
            // Category Accordion Toggle
            elements.categoryHeaders.forEach(header => {
                header.addEventListener('click', toggleCategory);
            });

            // Product Selection (delegated for dynamic content)
            elements.allProductsContainer.addEventListener('click', handleProductClick);
            document.querySelector('.grid-cols-1.sm\\:grid-cols-2.lg\\:grid-cols-3')?.addEventListener('click', handleProductClick); // For featured products if they exist

            // Search and Filter
            elements.productSearch.addEventListener('input', filterProducts);
            elements.categoryFilter.addEventListener('change', filterProducts);

            // Step Navigation
            elements.nextBtn.addEventListener('click', navigateToStep2);
            elements.prevBtn.addEventListener('click', navigateToStep1);
            elements.editProductsBtn.addEventListener('click', navigateToStep1);

            // Form Submission Validation
            elements.quoteForm.addEventListener('submit', handleFormSubmit);

            // Quantity and Remove Buttons (delegated)
            elements.selectedProductsList.addEventListener('click', handleSelectedListActions);
            elements.selectedProductsList.addEventListener('change', handleQuantityInputChange);
        }

        // --- Core Logic Functions ---

        function handleProductClick(event) {
            const productItem = event.target.closest('.product-item');
            if (productItem) {
                const productId = productItem.dataset.id;
                const productName = productItem.dataset.name;
                toggleProductSelection(productId, productName, productItem);
            }
        }

        function toggleCategory(event) {
            const header = event.currentTarget;
            const productsContainer = header.nextElementSibling;
            const arrow = header.querySelector('.arrow-icon');
            const categorySection = header.closest('.category-section');

            arrow.classList.toggle('rotate-180'); // More common accordion rotation

            if (productsContainer.classList.contains('expanded')) {
                productsContainer.classList.remove('expanded');
                categorySection.classList.remove('bg-slate-50'); // Remove bg on collapse
            } else {
                // Optional: Collapse other categories
                // elements.categoryHeaders.forEach(otherHeader => {
                //     if (otherHeader !== header) {
                //         otherHeader.nextElementSibling.classList.remove('expanded');
                //         otherHeader.querySelector('.arrow-icon').classList.remove('rotate-180');
                //         otherHeader.closest('.category-section').classList.remove('bg-slate-50');
                //     }
                // });
                productsContainer.classList.add('expanded');
                categorySection.classList.add('bg-slate-50'); // Add subtle bg on expand
            }
        }

        function toggleProductSelection(productId, productName, element = null) {
            const productItem = element || document.querySelector(`.product-item[data-id="${productId}"]`);
            if (!productItem) return;

            const checkIndicator = productItem.querySelector('.check-indicator');
            const checkIcon = checkIndicator?.querySelector('svg');

            if (selectedProducts[productId]) {
                // Deselect
                delete selectedProducts[productId];
                productItem.classList.remove('selected', 'border-[#99765c]', 'bg-amber-50/50');
                checkIndicator?.classList.remove('bg-[#99765c]', 'border-[#99765c]');
                checkIndicator?.classList.add('bg-white');
                checkIcon?.classList.add('hidden');
            } else {
                // Select
                selectedProducts[productId] = { id: productId, name: productName, quantity: 1 };
                productItem.classList.add('selected', 'border-[#99765c]', 'bg-amber-50/50');
                checkIndicator?.classList.add('bg-[#99765c]', 'border-[#99765c]');
                checkIndicator?.classList.remove('bg-white');
                checkIcon?.classList.remove('hidden');
            }
            updateSelectedProductsUI();
        }

        function updateSelectedProductsUI() {
            const productIds = Object.keys(selectedProducts);
            const count = productIds.length;

            // Update count and button state
            elements.selectedCount.textContent = count;
            elements.nextBtn.disabled = count === 0;

            // Clear and rebuild lists
            elements.selectedProductsList.innerHTML = '';
            elements.productsReview.innerHTML = '';
            elements.selectedProductsInputs.innerHTML = '';

            if (count === 0) {
                elements.selectedProductsContainer.classList.add('hidden');
                elements.selectedProductsList.innerHTML = '<p class="text-sm text-slate-500 text-center italic">Belum ada produk yang dipilih.</p>';
                return;
            }

            elements.selectedProductsContainer.classList.remove('hidden');

            productIds.forEach(id => {
                const product = selectedProducts[id];
                appendSelectedProductToList(product);
                appendProductToReview(product);
                appendHiddenInputs(product);
            });
        }

        function appendSelectedProductToList(product) {
            const listItem = document.createElement('div');
            listItem.className = 'flex items-center justify-between gap-4 p-3 bg-white border border-slate-200 rounded-md shadow-sm';
            listItem.innerHTML = `
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-slate-800 truncate">${product.name}</p>
                </div>
                <div class="flex items-center space-x-2">
                    <button type="button" class="quantity-btn decrease p-1 text-slate-500 hover:text-[#99765c] rounded disabled:opacity-50 disabled:cursor-not-allowed" data-id="${product.id}" ${product.quantity <= 1 ? 'disabled' : ''}>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" /></svg>
                    </button>
                    <input type="number" min="1" value="${product.quantity}" class="quantity-input w-12 text-center border border-slate-300 rounded text-sm py-1 focus:ring-1 focus:ring-[#99765c] focus:border-[#99765c]" data-id="${product.id}">
                    <button type="button" class="quantity-btn increase p-1 text-slate-500 hover:text-[#99765c] rounded" data-id="${product.id}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" /></svg>
                    </button>
                </div>
                <button type="button" class="remove-btn text-red-500 hover:text-red-700 p-1" data-id="${product.id}" title="Hapus produk">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                </button>
            `;
            elements.selectedProductsList.appendChild(listItem);
        }

        function appendProductToReview(product) {
            const reviewItem = document.createElement('div');
            reviewItem.className = 'py-3 flex justify-between items-center';
            reviewItem.innerHTML = `
                <span class="text-slate-700">${product.name}</span>
                <span class="font-medium text-slate-800 text-right">x ${product.quantity}</span>
            `;
            elements.productsReview.appendChild(reviewItem);
        }

        function appendHiddenInputs(product) {
            elements.selectedProductsInputs.insertAdjacentHTML('beforeend', `
                <input type="hidden" name="products[${product.id}]" value="${product.quantity}">
            `);
            // Simplified hidden input: name="products[PRODUCT_ID]" value="QUANTITY"
            // Adjust backend accordingly to receive this format (e.g., loop through request('products'))
        }

        function handleSelectedListActions(event) {
            const target = event.target;
            const button = target.closest('.quantity-btn, .remove-btn');
            if (!button) return;

            const productId = button.dataset.id;

            if (button.classList.contains('decrease')) {
                if (selectedProducts[productId] && selectedProducts[productId].quantity > 1) {
                    selectedProducts[productId].quantity--;
                    updateSelectedProductsUI();
                }
            } else if (button.classList.contains('increase')) {
                if (selectedProducts[productId]) {
                    selectedProducts[productId].quantity++;
                    updateSelectedProductsUI();
                }
            } else if (button.classList.contains('remove-btn')) {
                toggleProductSelection(productId, null); // Deselects and updates UI
            }
        }

        function handleQuantityInputChange(event) {
            const input = event.target;
            if (!input.classList.contains('quantity-input')) return;

            const productId = input.dataset.id;
            let quantity = parseInt(input.value, 10);

            if (isNaN(quantity) || quantity < 1) {
                quantity = 1;
                input.value = 1; // Correct input visually
            }

            if (selectedProducts[productId]) {
                selectedProducts[productId].quantity = quantity;
                // No immediate full UI update needed here unless value was corrected to 1
                // But need to update the review list and hidden inputs eventually
                // Let's trigger full update for simplicity now
                updateSelectedProductsUI();
            }
        }


        function filterProducts() {
            const searchTerm = elements.productSearch.value.toLowerCase().trim();
            const categoryId = elements.categoryFilter.value;
            let hasVisibleProducts = false;

            elements.allProductItems().forEach(item => {
                const productName = item.dataset.name.toLowerCase();
                const productCategory = item.dataset.category;
                const parentCategorySection = item.closest('.category-section');
                const sectionCategoryId = parentCategorySection?.dataset.categoryId;

                const matchesSearch = searchTerm === '' || productName.includes(searchTerm);
                const matchesCategoryFilter = !categoryId || sectionCategoryId === categoryId;

                // Check if product matches search inside the filtered category
                const isVisible = matchesSearch && matchesCategoryFilter;

                item.classList.toggle('hidden', !isVisible);
                if (isVisible) {
                    hasVisibleProducts = true;
                }
            });

            // Show/hide entire category sections based on filter and if they contain matching products
            elements.categoryHeaders.forEach(header => {
                const section = header.closest('.category-section');
                const sectionCategoryId = section.dataset.categoryId;
                const shouldShowSection = !categoryId || sectionCategoryId === categoryId;
                let sectionHasVisibleItems = false;

                if (shouldShowSection) {
                    section.querySelectorAll('.product-item').forEach(item => {
                        if (!item.classList.contains('hidden')) {
                            sectionHasVisibleItems = true;
                        }
                    });
                    // Only show section if it matches category filter AND has visible items after search filter
                    section.classList.toggle('hidden', !sectionHasVisibleItems);
                } else {
                    section.classList.add('hidden'); // Hide if category doesn't match
                }
            });

            // TODO: Add a "No results found" message if needed
        }

        function navigateToStep(step) {
            if (step === 1) {
                elements.step2.classList.add('hidden');
                elements.step1.classList.remove('hidden');
                // Update indicator
                elements.progressBar.style.width = '0%';
                elements.progressConnector.classList.remove('from-[#99765c]', 'via-[#99765c]');
                elements.progressConnector.classList.add('from-[#99765c]', 'via-slate-200');
                elements.stepIndicator2.querySelector('div').classList.remove('bg-[#99765c]', 'text-white', 'ring-[#99765c]/30');
                elements.stepIndicator2.querySelector('div').classList.add('bg-slate-200', 'text-slate-500', 'ring-transparent');
                elements.stepIndicator2.querySelector('span').classList.remove('text-[#99765c]');
                elements.stepIndicator2.querySelector('span').classList.add('text-slate-500');
            } else if (step === 2) {
                if (Object.keys(selectedProducts).length === 0) {
                    // Optionally show a more prominent message here
                    alert('Silakan pilih minimal satu produk terlebih dahulu.');
                    return; // Prevent navigation
                }
                elements.step1.classList.add('hidden');
                elements.step2.classList.remove('hidden');
                updateSelectedProductsUI(); // Ensure review list is up-to-date
                // Update indicator
                elements.progressBar.style.width = '100%';
                elements.progressConnector.classList.remove('via-slate-200', 'to-slate-200');
                elements.progressConnector.classList.add('from-[#99765c]', 'via-[#99765c]', 'to-[#99765c]'); // Full color connector
                elements.stepIndicator2.querySelector('div').classList.add('bg-[#99765c]', 'text-white', 'ring-[#99765c]/30');
                elements.stepIndicator2.querySelector('div').classList.remove('bg-slate-200', 'text-slate-500', 'ring-transparent');
                elements.stepIndicator2.querySelector('span').classList.add('text-[#99765c]');
                elements.stepIndicator2.querySelector('span').classList.remove('text-slate-500');
            }
            // Smooth scroll to top
            window.scrollTo({ top: elements.quoteForm.offsetTop - 80, behavior: 'smooth' });
        }

        function navigateToStep1() { navigateToStep(1); }
        function navigateToStep2() { navigateToStep(2); }

        function handleFormSubmit(e) {
            // Re-check just before submission
            if (Object.keys(selectedProducts).length === 0) {
                e.preventDefault();
                alert('Permintaan tidak dapat dikirim. Tidak ada produk yang dipilih.');
                navigateToStep1(); // Go back to product selection
            }
            // Add loading state to submit button if desired
            // elements.submitBtn.disabled = true;
            // elements.submitBtn.innerHTML = 'Mengirim...';
        }

        // Make functions globally accessible for the onclick handler
        window.updateSelectedProductsUI = updateSelectedProductsUI;
        window.selectedProductsInitialized = true; // Flag to indicate initialization is done

        // Pre-select product by reading data attributes from the form
        const initialId = elements.quoteForm.dataset.initialProductId;
        const initialName = elements.quoteForm.dataset.initialProductName;

        if (initialId && initialName) {
            const initialProductElement = document.querySelector(`.product-item[data-id="${initialId}"]`);
            if (initialProductElement) {
                 toggleProductSelection(initialId, initialName, initialProductElement);
            } else {
                // If element not found immediately, add to state directly
                 selectedProducts[initialId] = { id: initialId, name: initialName, quantity: 1 };
                 updateSelectedProductsUI(); // Update UI
                 console.log('Pre-selected product added directly to state:', initialId);
            }
        }
    });
</script>

@endpush
