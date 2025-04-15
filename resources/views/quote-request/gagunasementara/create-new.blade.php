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

    /* Card styling */
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }

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

    /* Button styling */
    .btn-primary {
        background-color: #99765c;
        border-color: #99765c;
    }

    .btn-primary:hover {
        background-color: #876754;
        border-color: #876754;
    }

    .btn-outline {
        border: 2px solid #99765c;
        color: #99765c;
    }

    .btn-outline:hover {
        background-color: #99765c;
        color: white;
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
        <div class="text-center mb-10 fade-in">
            <h1 class="text-3xl font-bold text-gray-900 mb-3">Minta Penawaran Harga</h1>
            <p class="text-gray-600 max-w-3xl mx-auto">Pilih produk yang Anda minati dan isi formulir untuk mendapatkan
                penawaran harga terbaik.</p>
        </div>

        <!-- Main Content -->
        <div class="card bg-white p-6 mb-8 fade-in">
            <form id="quoteForm" action="{{ route('quote-request.store') }}" method="POST">
                @csrf

                <!-- Step 1: Product Selection -->
                <div id="step1" class="space-y-6">
                    <div class="flex justify-between items-center border-b pb-4 mb-6">
                        <h2 class="text-xl font-semibold text-gray-800">Pilih Produk</h2>
                        <span class="text-sm text-gray-500">Langkah 1 dari 2</span>
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
                    <div class="flex justify-between items-center border-b pb-4 mb-6">
                        <h2 class="text-xl font-semibold text-gray-800">Informasi Kontak</h2>
                        <span class="text-sm text-gray-500">Langkah 2 dari 2</span>
                    </div>

                    <!-- Selected Products Summary -->
                    <div class="mb-6 bg-gray-50 rounded-lg p-4">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-md font-medium text-gray-700">Produk yang Dipilih</h3>
                            <button type="button" id="editProductsBtn" class="text-sm text-[#99765c] hover:underline">
                                Edit Produk
                            </button>
                        </div>
                        <div id="productsReview" class="text-sm text-gray-600 divide-y divide-gray-200">
                            <!-- Selected products will be displayed here -->
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99765c] form-control">
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99765c] form-control">
                        </div>

                        <!-- Phone Field -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon <span
                                    class="text-red-500">*</span></label>
                            <input type="tel" id="phone" name="phone" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99765c] form-control">
                        </div>

                        <!-- Company Field -->
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                Perusahaan</label>
                            <input type="text" id="company_name" name="company_name"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99765c] form-control">
                        </div>

                        <!-- Message Field -->
                        <div class="md:col-span-2">
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Pesan <span
                                    class="text-red-500">*</span></label>
                            <textarea id="message" name="message" rows="4" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99765c] form-control"
                                placeholder="Jelaskan kebutuhan Anda secara detail, termasuk spesifikasi khusus atau pertanyaan lainnya."></textarea>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between mt-8 pt-4 border-t border-gray-200">
                        <button type="button" id="prevBtn"
                            class="px-6 py-2 border-2 border-[#99765c] text-[#99765c] rounded-lg hover:bg-[#99765c] hover:text-white transition duration-300">
                            <span class="mr-2">←</span>
                            Kembali
                        </button>
                        <button type="submit" id="submitBtn"
                            class="px-6 py-2 bg-[#99765c] text-white rounded-lg hover:bg-[#876754] transition duration-300">
                            Kirim Permintaan
                        </button>
                    </div>
                </div>

                <!-- Hidden inputs for selected products -->
                <div id="selectedProductsInputs"></div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // DOM Elements
        const step1 = document.getElementById('step1');
        const step2 = document.getElementById('step2');
        const nextBtn = document.getElementById('nextBtn');
        const prevBtn = document.getElementById('prevBtn');
        const editProductsBtn = document.getElementById('editProductsBtn');
        const productItems = document.querySelectorAll('.product-item');
        const categoryHeaders = document.querySelectorAll('.category-header');
        const selectedProductsContainer = document.getElementById('selectedProductsContainer');
        const selectedProductsList = document.getElementById('selectedProductsList');
        const productsReview = document.getElementById('productsReview');
        const selectedProductsInputs = document.getElementById('selectedProductsInputs');
        const productSearch = document.getElementById('productSearch');
        const categoryFilter = document.getElementById('categoryFilter');
        const quoteForm = document.getElementById('quoteForm');

        // State
        let selectedProducts = {};

        // Initialize
        initCategoryToggle();
        initProductSelection();
        initSearchFilter();
        initNavigation();

        // If there's a pre-selected product (from URL parameter)
        @if (isset($selectedProduct) && $selectedProduct)
            selectProduct('{{ $selectedProduct->id }}', '{{ $selectedProduct->name }}');
        @endif

        // Functions
        function initCategoryToggle() {
            categoryHeaders.forEach(header => {
                header.addEventListener('click', function () {
                    const productsContainer = this.nextElementSibling;
                    const arrow = this.querySelector('svg');

                    arrow.classList.toggle('rotate-90');

                    if (productsContainer.classList.contains('hidden')) {
                        productsContainer.classList.remove('hidden');
                    } else {
                        productsContainer.classList.add('hidden');
                    }
                });
            });
        }

        function initProductSelection() {
            productItems.forEach(item => {
                item.addEventListener('click', function () {
                    const productId = this.dataset.id;
                    const productName = this.dataset.name;

                    if (this.classList.contains('selected')) {
                        // Deselect product
                        this.classList.remove('selected');
                        this.querySelector('.check-icon').classList.remove('bg-[#99765c]', 'border-[#99765c]');
                        this.querySelector('.check-icon svg').classList.add('hidden');
                        delete selectedProducts[productId];
                    } else {
                        // Select product
                        this.classList.add('selected');
                        this.querySelector('.check-icon').classList.add('bg-[#99765c]', 'border-[#99765c]');
                        this.querySelector('.check-icon svg').classList.remove('hidden');
                        selectedProducts[productId] = {
                            id: productId,
                            name: productName,
                            quantity: 1
                        };
                    }

                    updateSelectedProducts();
                });
            });
        }

        function selectProduct(productId, productName) {
            const productItem = document.querySelector(`.product-item[data-id="${productId}"]`);

            if (productItem) {
                productItem.classList.add('selected');
                productItem.querySelector('.check-icon').classList.add('bg-[#99765c]', 'border-[#99765c]');
                productItem.querySelector('.check-icon svg').classList.remove('hidden');

                selectedProducts[productId] = {
                    id: productId,
                    name: productName,
                    quantity: 1
                };

                updateSelectedProducts();
            }
        }

        function updateSelectedProducts() {
            // Clear current lists
            selectedProductsList.innerHTML = '';
            productsReview.innerHTML = '';
            selectedProductsInputs.innerHTML = '';

            const productIds = Object.keys(selectedProducts);

            // Update next button state
            nextBtn.disabled = productIds.length === 0;

            // Show/hide selected products container
            if (productIds.length > 0) {
                selectedProductsContainer.classList.remove('hidden');
            } else {
                selectedProductsContainer.classList.add('hidden');
                return;
            }

            // Add products to lists
            productIds.forEach(productId => {
                const product = selectedProducts[productId];

                // Create element for step 1 list
                const listItem = document.createElement('div');
                listItem.className = 'flex items-center justify-between p-3 bg-white border border-gray-200 rounded-lg';
                listItem.innerHTML = `
                    <div class="flex-1">
                        <h4 class="text-sm font-medium text-gray-900">${product.name}</h4>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center space-x-1">
                            <button type="button" class="quantity-btn decrease" data-id="${productId}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 hover:text-[#99765c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                                </svg>
                            </button>
                            <input type="number" min="1" value="${product.quantity}" class="quantity-input w-12 text-center border border-gray-300 rounded" data-id="${productId}">
                            <button type="button" class="quantity-btn increase" data-id="${productId}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 hover:text-[#99765c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6" />
                                </svg>
                            </button>
                        </div>
                        <button type="button" class="remove-btn text-red-500 hover:text-red-700" data-id="${productId}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                `;
                selectedProductsList.appendChild(listItem);

                // Create element for step 2 review
                const reviewItem = document.createElement('div');
                reviewItem.className = 'py-2';
                reviewItem.innerHTML = `
                    <div class="flex justify-between">
                        <span>${product.name}</span>
                        <span class="font-medium">Jumlah: ${product.quantity}</span>
                    </div>
                `;
                productsReview.appendChild(reviewItem);

                // Create hidden inputs for form submission
                const productInput = document.createElement('input');
                productInput.type = 'hidden';
                productInput.name = 'products[]';
                productInput.value = productId;
                selectedProductsInputs.appendChild(productInput);

                const quantityInput = document.createElement('input');
                quantityInput.type = 'hidden';
                quantityInput.name = 'quantities[]';
                quantityInput.value = product.quantity;
                selectedProductsInputs.appendChild(quantityInput);
            });

            // Add event listeners for quantity buttons
            document.querySelectorAll('.quantity-btn.decrease').forEach(btn => {
                btn.addEventListener('click', function () {
                    const productId = this.dataset.id;
                    if (selectedProducts[productId].quantity > 1) {
                        selectedProducts[productId].quantity--;
                        updateSelectedProducts();
                    }
                });
            });

            document.querySelectorAll('.quantity-btn.increase').forEach(btn => {
                btn.addEventListener('click', function () {
                    const productId = this.dataset.id;
                    selectedProducts[productId].quantity++;
                    updateSelectedProducts();
                });
            });

            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', function () {
                    const productId = this.dataset.id;
                    const value = parseInt(this.value);

                    if (value < 1) {
                        this.value = 1;
                        selectedProducts[productId].quantity = 1;
                    } else {
                        selectedProducts[productId].quantity = value;
                    }

                    updateSelectedProducts();
                });
            });

            document.querySelectorAll('.remove-btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const productId = this.dataset.id;
                    const productItem = document.querySelector(`.product-item[data-id="${productId}"]`);

                    if (productItem) {
                        productItem.classList.remove('selected');
                        productItem.querySelector('.check-icon').classList.remove('bg-[#99765c]', 'border-[#99765c]');
                        productItem.querySelector('.check-icon svg').classList.add('hidden');
                    }

                    delete selectedProducts[productId];
                    updateSelectedProducts();
                });
            });
        }

        function initSearchFilter() {
            productSearch.addEventListener('input', filterProducts);
            categoryFilter.addEventListener('change', filterProducts);

            function filterProducts() {
                const searchTerm = productSearch.value.toLowerCase();
                const categoryId = categoryFilter.value;

                // Show/hide category sections based on filter
                document.querySelectorAll('.category-section').forEach(section => {
                    const sectionCategoryId = section.dataset.categoryId;

                    if (categoryId && sectionCategoryId !== categoryId) {
                        section.classList.add('hidden');
                    } else {
                        section.classList.remove('hidden');
                    }
                });

                // Filter products by search term
                document.querySelectorAll('.product-item').forEach(item => {
                    const productName = item.dataset.name.toLowerCase();
                    const productCategory = item.dataset.category;

                    const matchesSearch = productName.includes(searchTerm);
                    const matchesCategory = !categoryId || productCategory === categoryId;

                    if (matchesSearch && matchesCategory) {
                        item.classList.remove('hidden');
                    } else {
                        item.classList.add('hidden');
                    }
                });
            }
        }

        function initNavigation() {
            nextBtn.addEventListener('click', function () {
                if (Object.keys(selectedProducts).length === 0) {
                    alert('Silakan pilih minimal satu produk terlebih dahulu.');
                    return;
                }

                step1.classList.add('hidden');
                step2.classList.remove('hidden');
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            prevBtn.addEventListener('click', function () {
                step2.classList.add('hidden');
                step1.classList.remove('hidden');
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            editProductsBtn.addEventListener('click', function () {
                prevBtn.click();
            });

            quoteForm.addEventListener('submit', function (e) {
                if (Object.keys(selectedProducts).length === 0) {
                    e.preventDefault();
                    alert('Silakan pilih minimal satu produk terlebih dahulu.');
                    prevBtn.click();
                }
            });
        }
    });
</script>
@endpush