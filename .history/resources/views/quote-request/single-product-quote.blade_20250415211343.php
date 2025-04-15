@extends('layouts.app')

@section('title', 'Minta Penawaran - ' . $product->name)

@push('styles')
<style>
    :root {
        --primary: #000000;
        /* Blue-500 */
        --primary-dark: #2563eb;
        /* Blue-600 */
        --primary-light: #dbeafe;
        /* Blue-100 */
        --accent: #f59e0b;
        /* Amber-500 */
        --text-dark: #1f2937;
        /* Gray-800 */
        --text-light: #6b7280;
        /* Gray-500 */
        --bg-light: #f9fafb;
        /* Gray-50 */
        --border-light: #e5e7eb;
        /* Gray-200 */
    }

    /* Product card styling */
    .product-card {
        transition: all 0.3s ease;
        border: 1px solid var(--border-light);
        background-color: white;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    /* Form control styling */
    .form-control:focus,
    input:focus,
    textarea:focus,
    select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.15);
    }

    /* Button styling */
    .btn-primary {
        background-color: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
    }

    /* Quantity input styling */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        opacity: 1;
    }

    /* Feature card styling */
    .feature-card {
        transition: transform 0.2s ease;
    }

    .feature-card:hover {
        transform: translateY(-2px);
    }

    .feature-icon {
        background-color: var(--primary-light);
        color: var(--primary);
    }
</style>
@endpush

@section('content')
<div class="py-12 bg-var(--bg-light)">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center text-sm">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <span class="mx-2 text-gray-400">/</span>
                        <a href="{{ route('products.index') }}"
                            class="text-gray-500 hover:text-primary transition-colors">Produk</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <span class="mx-2 text-gray-400">/</span>
                        <a href="{{ route('products.show', $product->slug) }}"
                            class="text-gray-500 hover:text-primary transition-colors">{{ $product->name }}</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <span class="mx-2 text-gray-400">/</span>
                        <span class="text-primary font-medium">Minta Penawaran</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header Section -->
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Minta Penawaran Harga</h1>
            <p class="text-gray-600 max-w-2xl mx-auto text-lg">Dapatkan penawaran terbaik untuk produk pilihan Anda</p>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <form id="quoteForm" action="{{ route('quote-request.store') }}" method="POST">
                @csrf

                <!-- Selected Product -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-center mb-5">
                        <h2 class="text-xl font-semibold text-gray-800">Produk yang Dipilih</h2>
                        <a href="{{ route('quote-request.create', ['product_id' => $product->id]) }}"
                            class="inline-flex items-center text-primary hover:text-primary-dark font-medium text-sm transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Tambahkan Barang Lain?
                        </a>
                    </div>

                    <div class="product-card rounded-lg overflow-hidden">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Product Image -->
                            <div class="md:col-span-1">
                                @if($product->hasMedia('product_images'))
                                <img src="{{ $product->getFirstMediaUrl('product_images') }}" alt="{{ $product->name }}"
                                    class="w-full h-48 object-cover">
                                @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="md:col-span-2 p-4">
                                <div class="flex items-center mb-2">
                                    <span
                                        class="bg-primary-light text-primary text-xs font-semibold px-2 py-1 rounded-md">{{
                                        $product->category->name }}</span>
                                    @if($product->is_featured)
                                    <span
                                        class="bg-accent bg-opacity-10 text-accent text-xs font-semibold px-2 py-1 rounded-md ml-2">Produk
                                        Unggulan</span>
                                    @endif
                                </div>

                                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $product->name }}</h3>
                                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($product->description, 120) }}</p>

                                <div class="flex items-center">
                                    <label for="quantity"
                                        class="block text-sm font-medium text-gray-700 mr-3">Jumlah:</label>
                                    <div class="flex items-center">
                                        <button type="button" id="decreaseBtn"
                                            class="w-8 h-8 flex items-center justify-center bg-gray-100 rounded-l-lg border border-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 12H4" />
                                            </svg>
                                        </button>
                                        <input type="number" id="quantity" name="products[{{ $product->id }}]" value="1"
                                            min="1"
                                            class="w-16 h-8 text-center border-y border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300">
                                        <button type="button" id="increaseBtn"
                                            class="w-8 h-8 flex items-center justify-center bg-gray-100 rounded-r-lg border border-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v16m8-8H4" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Kontak</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon <span
                                    class="text-red-500">*</span></label>
                            <input type="tel" id="phone" name="phone" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <div>
                            <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                Perusahaan</label>
                            <input type="text" id="company_name" name="company_name"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Pesan <span
                                class="text-red-500">*</span></label>
                        <textarea id="message" name="message" rows="4" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="Jelaskan kebutuhan Anda secara detail..."></textarea>
                    </div>

                    <div class="flex items-center mb-4">
                        <input type="checkbox" id="terms" name="terms" required
                            class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                        <label for="terms" class="ml-2 block text-sm text-gray-700">
                            Saya setuju bahwa data saya akan diproses sesuai dengan <a href="#"
                                class="text-primary hover:text-primary-dark hover:underline transition-colors">Kebijakan
                                Privasi</a>.
                        </label>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                            Kirim Permintaan
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Additional Information -->
        <div class="mt-8 bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Mengapa Memilih Kami?</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="flex flex-col items-center text-center feature-card">
                    <div class="feature-icon p-3 rounded-full mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Kualitas Terjamin</h3>
                    <p class="text-gray-600 text-sm">Kami hanya menyediakan produk berkualitas tinggi dari produsen
                        terpercaya.</p>
                </div>

                <div class="flex flex-col items-center text-center feature-card">
                    <div class="feature-icon p-3 rounded-full mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Harga Kompetitif</h3>
                    <p class="text-gray-600 text-sm">Dapatkan penawaran harga terbaik untuk setiap produk yang Anda
                        butuhkan.</p>
                </div>

                <div class="flex flex-col items-center text-center feature-card">
                    <div class="feature-icon p-3 rounded-full mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Konsultasi Gratis</h3>
                    <p class="text-gray-600 text-sm">Tim ahli kami siap membantu Anda memilih produk yang tepat untuk
                        kebutuhan Anda.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const quantityInput = document.getElementById('quantity');
        const decreaseBtn = document.getElementById('decreaseBtn');
        const increaseBtn = document.getElementById('increaseBtn');

        decreaseBtn.addEventListener('click', function () {
            const currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        increaseBtn.addEventListener('click', function () {
            const currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
        });
    });
</script>
@endpush