@extends('layouts.app')

@section('title', $product->name)

@push('styles')
<link rel="stylesheet" href="{{ asset('css/products-modern.css') }}">
<style>
    /* Product Detail Specific Styles */
    .product-gallery-main {
        height: 400px;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
    }

    .product-gallery-main img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .product-gallery-main:hover img {
        transform: scale(1.03);
    }

    .product-gallery-thumbs {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0.75rem;
        margin-top: 0.75rem;
    }

    .gallery-thumb {
        height: 80px;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    .gallery-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .gallery-thumb.active {
        border-color: #99765c;
    }

    .gallery-thumb:hover {
        transform: translateY(-2px);
    }

    .product-attributes {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
    }

    .attribute-item {
        background-color: #f9fafb;
        border-radius: 8px;
        padding: 1rem;
        transition: all 0.3s ease;
    }

    .attribute-item:hover {
        background-color: #f3f4f6;
        transform: translateY(-2px);
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
        animation: fadeIn 0.5s ease forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .tab-button {
        position: relative;
        transition: all 0.3s ease;
    }

    .tab-button::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background-color: #99765c;
        transition: width 0.3s ease;
    }

    .tab-button.active {
        color: #99765c;
    }

    .tab-button.active::after {
        width: 100%;
    }

    .related-product-card {
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        border-radius: 12px;
        overflow: hidden;
    }

    .related-product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .lightbox {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .lightbox.active {
        display: flex;
        animation: fadeIn 0.3s ease forwards;
    }

    .lightbox-content {
        position: relative;
        max-width: 90%;
        max-height: 90%;
    }

    .lightbox-content img {
        max-width: 100%;
        max-height: 90vh;
        object-fit: contain;
    }

    .lightbox-close {
        position: absolute;
        top: -40px;
        right: 0;
        color: white;
        font-size: 30px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .lightbox-close:hover {
        transform: rotate(90deg);
    }

    .lightbox-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: white;
        font-size: 30px;
        cursor: pointer;
        background-color: rgba(0, 0, 0, 0.5);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .lightbox-nav:hover {
        background-color: rgba(153, 118, 92, 0.8);
    }

    .lightbox-prev {
        left: 20px;
    }

    .lightbox-next {
        right: 20px;
    }
</style>
@endpush

@section('content')
<div class="bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Breadcrumbs -->
        <nav class="flex mb-8 fade-in" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-500 hover:text-[#99765c]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <a href="{{ route('products.index') }}"
                            class="ml-1 text-gray-500 hover:text-[#99765c] md:ml-2">Produk</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="ml-1 text-[#99765c] font-medium md:ml-2 truncate">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Product Detail -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-6 md:p-8">
                <!-- Product Gallery -->
                <div class="fade-in" style="animation-delay: 0.1s;">
                    <div class="product-gallery-main" id="mainImage">
                        @if($product->hasMedia('product_images'))
                        <img src="{{ $product->getFirstMediaUrl('product_images') }}" alt="{{ $product->name }}"
                            class="gallery-main-img">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        @endif

                        <!-- Zoom Icon -->
                        <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-0 hover:bg-opacity-30 transition-all duration-300 cursor-pointer"
                            onclick="openLightbox(0)">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-12 w-12 text-white opacity-0 hover:opacity-100 transition-opacity duration-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                            </svg>
                        </div>
                    </div>

                    @if($product->hasMedia('product_images') && $product->getMedia('product_images')->count() > 1)
                    <div class="product-gallery-thumbs">
                        @foreach($product->getMedia('product_images') as $index => $media)
                        <div class="gallery-thumb {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"
                            data-src="{{ $media->getUrl() }}">
                            <img src="{{ $media->getUrl() }}" alt="{{ $product->name }} - Image {{ $index + 1 }}">
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="fade-in" style="animation-delay: 0.2s;">
                    <div class="flex items-center mb-4">
                        <span class="bg-[#99765c] text-white text-xs font-semibold px-3 py-1 rounded-full">{{
                            $product->category->name }}</span>
                        @if($product->is_featured)
                        <span class="bg-amber-500 text-white text-xs font-semibold px-3 py-1 rounded-full ml-2">Produk
                            Unggulan</span>
                        @endif
                    </div>

                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>

                    <div class="mb-6">
                        <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                    </div>

                    <!-- Product Actions -->
                    <div class="mt-8 space-y-4">
                        <a href="{{ route('quote-request.product', ['id' => $product->id]) }}"
                            class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-gray-800 text-white font-medium rounded-md shadow-md hover:bg-gray-700 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            Minta Penawaran Harga
                        </a>

                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('contact.whatsapp', '6281234567890')) }}?text=Halo, saya tertarik dengan produk {{ $product->name }}. Bisakah Anda memberikan informasi lebih lanjut?"
                            target="_blank"
                            class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-green-600 text-white font-medium rounded-lg shadow-md hover:bg-green-700 transition duration-300 transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                            </svg>
                            Tanya via WhatsApp
                        </a>
                    </div>
                </div>
            </div>

            <!-- Product Tabs -->
            <div class="border-t border-gray-200 px-6 md:px-8 py-6 fade-in" style="animation-delay: 0.3s;">
                <div class="flex border-b border-gray-200">
                    <button class="tab-button active px-4 py-2 font-medium text-gray-700" data-tab="details">Detail
                        Produk</button>
                    <button class="tab-button px-4 py-2 font-medium text-gray-700" data-tab="specs">Spesifikasi</button>
                    <button class="tab-button px-4 py-2 font-medium text-gray-700"
                        data-tab="applications">Aplikasi</button>
                </div>

                <div class="py-6">
                    <!-- Details Tab -->
                    <div id="details" class="tab-content active">
                        <div class="prose max-w-none">
                            <p>{{ $product->description }}</p>

                            @if($product->details)
                            {!! $product->details !!}
                            @else
                            <p>{{ $product->name }} adalah produk berkualitas tinggi yang dirancang untuk memenuhi
                                kebutuhan proyek konstruksi Anda. Produk ini memiliki daya tahan yang baik dan mudah
                                diaplikasikan.</p>

                            <p>Untuk informasi lebih lanjut tentang produk ini, silakan hubungi tim kami melalui tombol
                                "Minta Penawaran Harga" atau "Tanya via WhatsApp".</p>
                            @endif
                        </div>
                    </div>

                    <!-- Specs Tab -->
                    <div id="specs" class="tab-content">
                        <div class="product-attributes">
                            @if($product->attributes->isNotEmpty())
                            @foreach($product->attributes as $attribute)
                            <div class="attribute-item">
                                <h4 class="text-sm font-medium text-gray-500">{{ $attribute->name }}</h4>
                                <p class="text-base font-semibold text-gray-900 mt-1">{{ $attribute->value }}</p>
                            </div>
                            @endforeach
                            @else
                            <div class="col-span-full">
                                <p class="text-gray-500 italic">Spesifikasi detail belum tersedia untuk produk ini.
                                    Silakan hubungi kami untuk informasi lebih lanjut.</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Applications Tab -->
                    <div id="applications" class="tab-content">
                        <div class="prose max-w-none">
                            @if($product->applications)
                            {!! $product->applications !!}
                            @else
                            <p>{{ $product->name }} dapat digunakan untuk berbagai aplikasi konstruksi, termasuk:</p>

                            <ul>
                                <li>Proyek konstruksi komersial</li>
                                <li>Proyek konstruksi residensial</li>
                                <li>Proyek infrastruktur</li>
                                <li>Renovasi dan perbaikan</li>
                            </ul>

                            <p>Untuk informasi lebih lanjut tentang aplikasi produk ini, silakan hubungi tim kami.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->isNotEmpty())
        <div class="mb-12 fade-in" style="animation-delay: 0.4s;">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Terkait</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                <div class="related-product-card bg-white shadow-md overflow-hidden">
                    <div class="h-48 overflow-hidden">
                        @if($relatedProduct->hasMedia('product_images'))
                        <img src="{{ $relatedProduct->getFirstMediaUrl('product_images') }}"
                            alt="{{ $relatedProduct->name }}" class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        @endif
                    </div>

                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-1">{{ $relatedProduct->name }}
                        </h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ Str::limit($relatedProduct->description,
                            80) }}</p>

                        <div class="flex justify-between items-center">
                            <a href="{{ route('products.show', $relatedProduct) }}"
                                class="text-[#99765c] font-medium hover:underline">
                                Lihat Detail
                            </a>

                            <a href="{{ route('quote-request.product', ['id' => $relatedProduct->id]) }}"
                                class="text-xs bg-[#99765c] hover:bg-[#876754] text-white font-medium py-1 px-3 rounded-lg transition duration-300">
                                Minta Penawaran
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Back to Products -->
        <div class="text-center fade-in" style="animation-delay: 0.5s;">
            <a href="{{ route('products.index') }}"
                class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Kembali ke Katalog Produk
            </a>
        </div>
    </div>
</div>

<!-- Lightbox -->
<div id="lightbox" class="lightbox">
    <div class="lightbox-content">
        <img id="lightboxImage" src="" alt="Enlarged product image">
        <span class="lightbox-close" onclick="closeLightbox()">&times;</span>

        @if($product->hasMedia('product_images') && $product->getMedia('product_images')->count() > 1)
        <div class="lightbox-prev lightbox-nav" onclick="changeImage(-1)">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </div>
        <div class="lightbox-next lightbox-nav" onclick="changeImage(1)">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Tab functionality
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', function () {
                const tabId = this.dataset.tab;

                // Remove active class from all buttons and contents
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                // Add active class to current button and content
                this.classList.add('active');
                document.getElementById(tabId).classList.add('active');
            });
        });

        // Gallery functionality
        const galleryThumbs = document.querySelectorAll('.gallery-thumb');
        const mainImage = document.querySelector('.gallery-main-img');

        if (galleryThumbs.length > 0 && mainImage) {
            galleryThumbs.forEach(thumb => {
                thumb.addEventListener('click', function () {
                    // Update main image
                    mainImage.src = this.dataset.src;

                    // Update active thumb
                    galleryThumbs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    // Update current index for lightbox
                    currentImageIndex = parseInt(this.dataset.index);
                });
            });
        }
    });

    // Lightbox functionality
    let currentImageIndex = 0;
    const images = [
        @if ($product -> hasMedia('product_images'))
        @foreach($product -> getMedia('product_images') as $media)
    "{{ $media->getUrl() }}",
        @endforeach
        @else
    "{{ asset('images/placeholder.jpg') }}",
        @endif
    ];

    function openLightbox(index) {
        currentImageIndex = index;
        const lightbox = document.getElementById('lightbox');
        const lightboxImage = document.getElementById('lightboxImage');

        lightboxImage.src = images[currentImageIndex];
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const lightbox = document.getElementById('lightbox');
        lightbox.classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    function changeImage(direction) {
        currentImageIndex += direction;

        // Loop back to the beginning or end if needed
        if (currentImageIndex < 0) {
            currentImageIndex = images.length - 1;
        } else if (currentImageIndex >= images.length) {
            currentImageIndex = 0;
        }

        const lightboxImage = document.getElementById('lightboxImage');
        lightboxImage.src = images[currentImageIndex];
    }

    // Close lightbox when clicking outside the image
    document.getElementById('lightbox').addEventListener('click', function (e) {
        if (e.target === this) {
            closeLightbox();
        }
    });

    // Keyboard navigation for lightbox
    document.addEventListener('keydown', function (e) {
        if (!document.getElementById('lightbox').classList.contains('active')) return;

        if (e.key === 'Escape') {
            closeLightbox();
        } else if (e.key === 'ArrowLeft') {
            changeImage(-1);
        } else if (e.key === 'ArrowRight') {
            changeImage(1);
        }
    });
</script>
@endpush