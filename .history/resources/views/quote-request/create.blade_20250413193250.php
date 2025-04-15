@extends('layouts.app')

@section('title', 'Minta Penawaran Harga')

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

    /* Product card styling */
    .product-card,
    .product-item {
        transition: all 0.3s ease;
    }

    .product-card:hover,
    .product-item:hover {
        border-color: #99765c;
        box-shadow: 0 4px 6px -1px rgba(153, 118, 92, 0.1), 0 2px 4px -1px rgba(153, 118, 92, 0.06);
    }

    .select-product-btn {
        transition: all 0.2s ease;
    }

    .select-product-btn:hover {
        background-color: rgba(153, 118, 92, 0.1);
        transform: scale(1.1);
    }

    /* Selected product styling */
    .selected-product {
        background-color: rgba(153, 118, 92, 0.05);
        border-color: #99765c;
    }

    .selected-product .select-product-btn {
        transform: rotate(45deg);
    }

    /* Quantity input styling */
    .quantity-input {
        width: 60px;
        text-align: center;
        border: 1px solid #e5e7eb;
        border-radius: 0.375rem;
        padding: 0.25rem;
    }

    .quantity-input:focus {
        outline: none;
        border-color: #99765c;
        box-shadow: 0 0 0 1px rgba(153, 118, 92, 0.2);
    }

    .quantity-btn {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f3f4f6;
        border-radius: 0.25rem;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .quantity-btn:hover {
        background-color: #e5e7eb;
    }

    /* Category section styling */
    .category-header svg {
        transition: transform 0.3s ease;
    }

    .category-header.collapsed svg {
        transform: rotate(-90deg);
    }

    /* Step indicator styling */
    #progressBar1 {
        transition: width 0.5s ease;
    }

    #step2Circle,
    #step2Text {
        transition: all 0.5s ease;
    }
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
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Informasi Kontak</h2>

                    <!-- Selected Products Summary (Compact) -->
                    <div class="mb-8 p-4 bg-gray-50 rounded-lg">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Produk yang Dipilih</h3>
                            <button type="button" id="editProductsBtn"
                                class="text-sm text-[#99765c] hover:text-[#876754] font-medium flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                Ubah
                            </button>
                        </div>
                        <div id="selectedProductsReview" class="text-sm text-gray-600">
                            <!-- Selected products will be listed here -->
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" required
                                class="w-full border-gray-300 rounded-lg focus:ring-[#99765c] focus:border-[#99765c]">
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" required
                                class="w-full border-gray-300 rounded-lg focus:ring-[#99765c] focus:border-[#99765c]">
                        </div>

                        <!-- Phone Field -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon <span
                                    class="text-red-500">*</span></label>
                            <input type="tel" id="phone" name="phone" required
                                class="w-full border-gray-300 rounded-lg focus:ring-[#99765c] focus:border-[#99765c]">
                            <p class="text-xs text-gray-500 mt-1">Contoh: 081234567890</p>
                        </div>

                        <!-- Company Field -->
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                Perusahaan</label>
                            <input type="text" id="company_name" name="company_name"
                                class="w-full border-gray-300 rounded-lg focus:ring-[#99765c] focus:border-[#99765c]">
                        </div>

                        <!-- Message Field -->
                        <div class="md:col-span-2">
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Pesan <span
                                    class="text-red-500">*</span></label>
                            <textarea id="message" name="message" rows="4" required
                                class="w-full border-gray-300 rounded-lg focus:ring-[#99765c] focus:border-[#99765c]"
                                placeholder="Jelaskan kebutuhan Anda secara detail, termasuk spesifikasi khusus, jumlah, atau pertanyaan lainnya."></textarea>
                        </div>
                    </div>

                    <!-- Hidden Fields for Products and Quantities -->
                    <div id="productsInputContainer">
                        <!-- Will be populated by JavaScript -->
                    </div>
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
    document.addEventListener('DOMContentLoaded', function () {
        // Variables
        const step1 = document.getElementById('step1');
        const step2 = document.getElementById('step2');
        const nextButton = document.getElementById('nextButton');
        const prevButton = document.getElementById('prevButton');
        const submitButton = document.getElementById('submitButton');
        const progressBar1 = document.getElementById('progressBar1');
        const step2Circle = document.getElementById('step2Circle');
        const step2Text = document.getElementById('step2Text');
        const editProductsBtn = document.getElementById('editProductsBtn');
        const selectedProductsList = document.getElementById('selectedProductsList');
        const selectedProductsReview = document.getElementById('selectedProductsReview');
        const noProductsSelected = document.getElementById('noProductsSelected');
        const productsInputContainer = document.getElementById('productsInputContainer');
        const productSearch = document.getElementById('productSearch');
        const categoryFilter = document.getElementById('categoryFilter');
        const categoryHeaders = document.querySelectorAll('.category-header');
        const quoteRequestForm = document.getElementById('quoteRequestForm');

        // State
        let selectedProducts = {};
        let currentStep = 1;

        // Initialize
        initCategoryToggle();
        initProductSelection();
        initSearchAndFilter();
        initStepNavigation();

        // Functions
        function initCategoryToggle() {
            categoryHeaders.forEach(header => {
                header.addEventListener('click', function () {
                    const productsContainer = this.nextElementSibling;
                    this.classList.toggle('collapsed');

                    if (productsContainer.style.display === 'none') {
                        productsContainer.style.display = 'block';
                    } else {
                        productsContainer.style.display = 'none';
                    }
                });
            });
        }

        function initProductSelection() {
            const productCards = document.querySelectorAll('.product-card, .product-item');

            productCards.forEach(card => {
                const selectBtn = card.querySelector('.select-product-btn');

                selectBtn.addEventListener('click', function () {
                    const productId = card.dataset.productId;
                    const productName = card.dataset.productName;

                    if (selectedProducts[productId]) {
                        // Remove product
                        delete selectedProducts[productId];
                        card.classList.remove('selected-product');
                    } else {
                        // Add product
                        selectedProducts[productId] = {
                            id: productId,
                            name: productName,
                            quantity: 1
                        };
                        card.classList.add('selected-product');
                    }

                    updateSelectedProductsList();
                });
            });

            // If there's a pre-selected product (from URL parameter)
            @if (isset($selectedProduct) && $selectedProduct)
                const productId = '{{ $selectedProduct->id }}';
            const productName = '{{ $selectedProduct->name }}';

            selectedProducts[productId] = {
                id: productId,
                name: productName,
                quantity: 1
            };

            const productCard = document.querySelector(`.product-card[data-product-id="${productId}"], .product-item[data-product-id="${productId}"]`);
            if (productCard) {
                productCard.classList.add('selected-product');
            }

            updateSelectedProductsList();
            @endif
        }

        function updateSelectedProductsList() {
            // Clear current list
            selectedProductsList.innerHTML = '';
            selectedProductsReview.innerHTML = '';
            productsInputContainer.innerHTML = '';

            const productIds = Object.keys(selectedProducts);

            if (productIds.length === 0) {
                noProductsSelected.style.display = 'block';
                nextButton.disabled = true;
                return;
            }

            noProductsSelected.style.display = 'none';
            nextButton.disabled = false;

            // Add products to the list
            productIds.forEach((productId, index) => {
                const product = selectedProducts[productId];

                // Create element for step 1
                const productElement = document.createElement('div');
                productElement.className = 'flex items-center justify-between p-3 bg-white border border-gray-200 rounded-lg';
                productElement.innerHTML = `
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-gray-900">${product.name}</h4>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button type="button" class="quantity-btn decrease-btn" data-product-id="${productId}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                        </button>
                        <input type="number" min="1" value="${product.quantity}" class="quantity-input" data-product-id="${productId}">
                        <button type="button" class="quantity-btn increase-btn" data-product-id="${productId}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                        <button type="button" class="ml-2 text-red-500 hover:text-red-700 remove-product-btn" data-product-id="${productId}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                `;
                selectedProductsList.appendChild(productElement);

                // Create element for step 2 review
                const reviewElement = document.createElement('div');
                reviewElement.className = 'mb-2';
                reviewElement.innerHTML = `
                    <div class="flex justify-between">
                        <span>${product.name}</span>
                        <span>Jumlah: ${product.quantity}</span>
                    </div>
                `;
                selectedProductsReview.appendChild(reviewElement);

                // Create hidden inputs for form submission
                const productInput = document.createElement('input');
                productInput.type = 'hidden';
                productInput.name = `products[]`;
                productInput.value = productId;
                productsInputContainer.appendChild(productInput);

                const quantityInput = document.createElement('input');
                quantityInput.type = 'hidden';
                quantityInput.name = `quantities[]`;
                quantityInput.value = product.quantity;
                productsInputContainer.appendChild(quantityInput);
            });

            // Add event listeners for quantity buttons
            const decreaseBtns = document.querySelectorAll('.decrease-btn');
            const increaseBtns = document.querySelectorAll('.increase-btn');
            const quantityInputs = document.querySelectorAll('.quantity-input');
            const removeProductBtns = document.querySelectorAll('.remove-product-btn');

            decreaseBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    const productId = this.dataset.productId;
                    if (selectedProducts[productId].quantity > 1) {
                        selectedProducts[productId].quantity--;
                        updateSelectedProductsList();
                    }
                });
            });

            increaseBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    const productId = this.dataset.productId;
                    selectedProducts[productId].quantity++;
                    updateSelectedProductsList();
                });
            });

            quantityInputs.forEach(input => {
                input.addEventListener('change', function () {
                    const productId = this.dataset.productId;
                    const value = parseInt(this.value);

                    if (value < 1) {
                        this.value = 1;
                        selectedProducts[productId].quantity = 1;
                    } else {
                        selectedProducts[productId].quantity = value;
                    }

                    updateSelectedProductsList();
                });
            });

            removeProductBtns.forEach(btn => {
                btn.addEventListener('click', function () {
                    const productId = this.dataset.productId;
                    delete selectedProducts[productId];

                    const productCard = document.querySelector(`.product-card[data-product-id="${productId}"], .product-item[data-product-id="${productId}"]`);
                    if (productCard) {
                        productCard.classList.remove('selected-product');
                    }

                    updateSelectedProductsList();
                });
            });
        }

        function initSearchAndFilter() {
            productSearch.addEventListener('input', filterProducts);
            categoryFilter.addEventListener('change', filterProducts);

            function filterProducts() {
                const searchTerm = productSearch.value.toLowerCase();
                const categoryId = categoryFilter.value;

                const productItems = document.querySelectorAll('.product-item');
                const categorySections = document.querySelectorAll('.category-section');

                // First hide/show category sections based on filter
                categorySections.forEach(section => {
                    const sectionCategoryId = section.dataset.categoryId;

                    if (categoryId && sectionCategoryId !== categoryId) {
                        section.style.display = 'none';
                    } else {
                        section.style.display = 'block';
                    }
                });

                // Then filter products by search term
                productItems.forEach(item => {
                    const productName = item.dataset.productName.toLowerCase();
                    const productCategoryId = item.dataset.categoryId;

                    const matchesSearch = productName.includes(searchTerm);
                    const matchesCategory = !categoryId || productCategoryId === categoryId;

                    if (matchesSearch && matchesCategory) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }
        }

        function initStepNavigation() {
            nextButton.addEventListener('click', function () {
                if (Object.keys(selectedProducts).length === 0) {
                    alert('Silakan pilih minimal satu produk terlebih dahulu.');
                    return;
                }

                currentStep = 2;
                step1.style.display = 'none';
                step2.style.display = 'block';
                prevButton.classList.remove('hidden');
                nextButton.style.display = 'none';
                submitButton.classList.remove('hidden');

                // Update progress indicator
                progressBar1.style.width = '100%';
                step2Circle.classList.remove('bg-gray-200', 'text-gray-500');
                step2Circle.classList.add('bg-[#99765c]', 'text-white');
                step2Text.classList.remove('text-gray-500');
                step2Text.classList.add('text-[#99765c]');
            });

            prevButton.addEventListener('click', function () {
                currentStep = 1;
                step1.style.display = 'block';
                step2.style.display = 'none';
                prevButton.classList.add('hidden');
                nextButton.style.display = 'inline-flex';
                submitButton.classList.add('hidden');

                // Update progress indicator
                progressBar1.style.width = '0';
                step2Circle.classList.add('bg-gray-200', 'text-gray-500');
                step2Circle.classList.remove('bg-[#99765c]', 'text-white');
                step2Text.classList.add('text-gray-500');
                step2Text.classList.remove('text-[#99765c]');
            });

            editProductsBtn.addEventListener('click', function () {
                prevButton.click();
            });

            quoteRequestForm.addEventListener('submit', function (e) {
                if (Object.keys(selectedProducts).length === 0) {
                    e.preventDefault();
                    alert('Silakan pilih minimal satu produk terlebih dahulu.');
                    prevButton.click();
                }
            });
        }
    });
</script>
@endpush