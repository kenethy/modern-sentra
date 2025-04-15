{{-- resources/views/products/show.blade.php (Contoh nama file) --}}
@extends('layouts.app')

@section('title', $product->name)

@push('styles')
<link rel="stylesheet" href="{{ asset('css/products-modern.css') }}">
<style>
    /* === Gaya CSS yang sudah ada (Tidak ada perubahan signifikan di sini) === */
    /* Pastikan gaya default untuk lightbox adalah tersembunyi */
    .product-gallery-main {
        height: 400px;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        cursor: pointer; /* Tambahkan cursor pointer ke area utama */
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
    /* ... (CSS lainnya tetap sama) ... */
    .lightbox {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
        /* display: none; */ /* Kita kontrol via JS class */
        justify-content: center;
        align-items: center;
        z-index: 9999;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
        display: flex; /* Set display flex by default for alignment */
    }
    .lightbox.active {
        opacity: 1;
        visibility: visible;
    }
    .lightbox-content {
        position: relative;
        max-width: 90%;
        max-height: 90%;
        /* Tambahkan style untuk loading state jika diinginkan */
        /* min-width: 50px; */
        /* min-height: 50px; */
        /* background: url('loading-spinner.gif') center center no-repeat; */
    }
    .lightbox-content img {
        max-width: 100%;
        max-height: 90vh;
        object-fit: contain;
        display: block; /* Ensure image is block */
        opacity: 0; /* Start hidden until loaded */
        transition: opacity 0.3s ease;
    }
    .lightbox-content img.loaded {
        opacity: 1; /* Fade in when loaded */
    }

    .lightbox-close {
        position: absolute;
        top: -40px; /* Adjust if needed relative to content */
        right: 0;
        color: white;
        font-size: 30px;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10001; /* Ensure it's above image */
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
        z-index: 10000; /* Ensure above background */
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
    /* Style untuk overlay di gambar utama (jika masih mau digunakan) */
    .main-image-overlay {
         position: absolute;
         inset: 0;
         display: flex;
         align-items: center;
         justify-content: center;
         background-color: rgba(0,0,0,0); /* Start transparent */
         transition: background-color 0.3s ease, opacity 0.3s ease;
         cursor: pointer;
         opacity: 0; /* Start hidden */
    }
     .product-gallery-main:hover .main-image-overlay {
        background-color: rgba(0,0,0,0.3); /* Darken on hover */
        opacity: 1; /* Show overlay on hover */
     }
    .main-image-overlay svg {
        height: 3rem; /* 12 -> 48px */
        width: 3rem;
        color: white;
        /* Opacity controlled by parent now */
    }
</style>
@endpush

@section('content')
<div class="bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <nav class="flex mb-8" aria-label="Breadcrumb">
             {{-- Breadcrumb content --}}
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-500 hover:text-[#99765c]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor"> <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" /></svg>
                        Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"> <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                        <a href="{{ route('products.index') }}" class="ml-1 text-gray-500 hover:text-[#99765c] md:ml-2">Produk</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"> <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                         <span class="ml-1 text-[#99765c] font-medium md:ml-2 truncate">{{ $product->name }}</span>
                     </div>
                 </li>
             </ol>
        </nav>

        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-6 md:p-8">
                <div class="product-gallery">
                    <div class="product-gallery-main" id="mainImageContainer"> {{-- ID for JS target --}}
                        @php
                            $firstImageUrl = $product->hasMedia('product_images') ? $product->getFirstMediaUrl('product_images') : asset('images/placeholder.jpg'); // Placeholder fallback
                        @endphp
                        @if($product->hasMedia('product_images'))
                            <img src="{{ $firstImageUrl }}" alt="{{ $product->name }}" class="gallery-main-img" id="galleryMainImg"> {{-- ID for JS target --}}
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            </div>
                        @endif

                        {{-- Overlay - Dihapus onclick, dikontrol via JS --}}
                        <div class="main-image-overlay" id="mainImageOverlay">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" /></svg>
                        </div>
                    </div>

                    @if($product->hasMedia('product_images') && $product->getMedia('product_images')->count() > 1)
                    <div class="product-gallery-thumbs">
                        @foreach($product->getMedia('product_images') as $index => $media)
                        <div class="gallery-thumb {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}" data-src="{{ $media->getUrl() }}"> {{-- Hapus onclick --}}
                            <img src="{{ $media->getUrl() }}" alt="{{ $product->name }} - Image {{ $index + 1 }}">
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <div class="product-info">
                    {{-- Product Info content (no changes needed here) --}}
                     <div class="flex items-center mb-4">
                        <span class="bg-[#99765c] text-white text-xs font-semibold px-3 py-1 rounded-full">{{ $product->category->name }}</span>
                         @if($product->is_featured)
                         <span class="bg-amber-500 text-white text-xs font-semibold px-3 py-1 rounded-full ml-2">Produk Unggulan</span>
                         @endif
                     </div>
                     <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                     <div class="mb-6">
                         <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                     </div>
                     <div class="mt-8 space-y-4">
                         <a href="{{ route('quote-request.product', ['id' => $product->id]) }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-gray-800 text-white font-medium rounded-md shadow-md hover:bg-gray-700 transition duration-300">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>
                             Minta Penawaran Harga
                         </a>
                         <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('contact.whatsapp', '6281234567890')) }}?text=Halo, saya tertarik dengan produk {{ $product->name }}. Bisakah Anda memberikan informasi lebih lanjut?" target="_blank" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-green-600 text-white font-medium rounded-md shadow-md hover:bg-green-700 transition duration-300">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="currentColor"> <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" /></svg>
                             Tanya via WhatsApp
                         </a>
                     </div>
                </div>
            </div>

            <div class="border-t border-gray-200 px-6 md:px-8 py-6">
                 {{-- Tabs content (no changes needed here) --}}
                 <div class="flex border-b border-gray-200">
                     <button class="tab-button active px-4 py-2 font-medium text-gray-700" data-tab="details">Detail Produk</button>
                     <button class="tab-button px-4 py-2 font-medium text-gray-700" data-tab="specs">Spesifikasi</button>
                     <button class="tab-button px-4 py-2 font-medium text-gray-700" data-tab="applications">Aplikasi</button>
                 </div>
                 <div class="py-6">
                     <div id="details" class="tab-content active">
                         <div class="prose max-w-none">
                             <p>{{ $product->description }}</p>
                             @if($product->details) {!! $product->details !!} @else <p>{{ $product->name }} adalah produk berkualitas tinggi...</p><p>Untuk informasi lebih lanjut...</p> @endif
                         </div>
                     </div>
                     <div id="specs" class="tab-content">
                         <div class="product-attributes">
                             @forelse($product->attributes as $attribute)
                             <div class="attribute-item">
                                 <h4 class="text-sm font-medium text-gray-500">{{ $attribute->name }}</h4>
                                 <p class="text-base font-semibold text-gray-900 mt-1">{{ $attribute->value }}</p>
                             </div>
                             @empty
                             <div class="col-span-full"><p class="text-gray-500 italic">Spesifikasi detail belum tersedia...</p></div>
                             @endforelse
                         </div>
                     </div>
                     <div id="applications" class="tab-content">
                         <div class="prose max-w-none">
                             @if($product->applications) {!! $product->applications !!} @else <p>{{ $product->name }} dapat digunakan untuk...</p><ul><li>...</li></ul><p>Untuk informasi lebih lanjut...</p> @endif
                         </div>
                     </div>
                 </div>
             </div>
        </div>

        @if($relatedProducts->isNotEmpty())
        <div class="mb-12">
             {{-- Related products content (no changes needed here) --}}
             <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Terkait</h2>
             <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                 @foreach($relatedProducts as $relatedProduct)
                 <div class="related-product-card bg-white shadow-md overflow-hidden">
                     <div class="h-48 overflow-hidden">
                         @if($relatedProduct->hasMedia('product_images'))
                             <img src="{{ $relatedProduct->getFirstMediaUrl('product_images') }}" alt="{{ $relatedProduct->name }}" class="w-full h-full object-cover">
                         @else
                         <div class="w-full h-full flex items-center justify-center bg-gray-200"> <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg></div>
                         @endif
                     </div>
                     <div class="p-4">
                         <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-1">{{ $relatedProduct->name }}</h3>
                         <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ Str::limit($relatedProduct->description, 80) }}</p>
                         <div class="flex justify-between items-center">
                             <a href="{{ route('products.show', $relatedProduct) }}" class="text-gray-700 font-medium hover:text-gray-900 border-b border-gray-300 hover:border-gray-700 pb-0.5">Lihat Detail</a>
                             <a href="{{ route('quote-request.product', ['id' => $relatedProduct->id]) }}" class="text-xs bg-gray-800 hover:bg-gray-700 text-white font-medium py-1 px-3 rounded-md transition duration-300">Minta Penawaran</a>
                         </div>
                     </div>
                 </div>
                 @endforeach
             </div>
        </div>
        @endif

        <div class="text-center">
            <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition duration-300 focus:outline-none focus:ring-2 focus:ring-gray-300">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor"> <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" /></svg>
                 Kembali ke Katalog Produk
            </a>
        </div>
    </div>
</div>

<div id="lightbox" class="lightbox"> {{-- Hapus style inline --}}
    <div class="lightbox-content">
        <img id="lightboxImage" src="" alt="Enlarged product image">
        <span class="lightbox-close" id="lightboxClose">&times;</span> {{-- ID for JS target, hapus onclick --}}

        @if($product->hasMedia('product_images') && $product->getMedia('product_images')->count() > 1)
        <div class="lightbox-prev lightbox-nav" id="lightboxPrev"> {{-- ID for JS target, hapus onclick --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
        </div>
        <div class="lightbox-next lightbox-nav" id="lightboxNext"> {{-- ID for JS target, hapus onclick --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- Tab Functionality ---
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    if (tabButtons.length > 0 && tabContents.length > 0) {
        tabButtons.forEach(button => {
            button.addEventListener('click', function () {
                const tabId = this.dataset.tab;
                const targetContent = document.getElementById(tabId);

                if (targetContent) {
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabContents.forEach(content => content.classList.remove('active'));

                    this.classList.add('active');
                    targetContent.classList.add('active');
                } else {
                    console.error(`Tab content with id "${tabId}" not found.`);
                }
            });
        });
    }

    // --- Gallery & Lightbox Functionality ---
    const galleryThumbs = document.querySelectorAll('.gallery-thumb');
    const mainImage = document.getElementById('galleryMainImg');
    const mainImageContainer = document.getElementById('mainImageContainer'); // Container for click target
    const mainImageOverlay = document.getElementById('mainImageOverlay'); // Overlay trigger

    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxCloseBtn = document.getElementById('lightboxClose');
    const lightboxPrevBtn = document.getElementById('lightboxPrev');
    const lightboxNextBtn = document.getElementById('lightboxNext');

    let currentImageIndex = 0;
    const images = [];

    // Populate images array from thumbnails or main image
    if (galleryThumbs.length > 0) {
        galleryThumbs.forEach(thumb => {
            images.push(thumb.dataset.src);
        });
    } else if (mainImage) {
        images.push(mainImage.src); // Use main image if no thumbs
    }
    // Fallback if absolutely no image source found
    if (images.length === 0) {
         // Attempt to get from the first product media if logic above failed somehow
        @if ($product->hasMedia('product_images'))
            images.push("{{ $product->getFirstMediaUrl('product_images') }}");
        @else
            images.push("{{ asset('images/placeholder.jpg') }}"); // Default placeholder
        @endif
    }


    let isLightboxOpen = false; // Track lightbox state

    // --- Helper Function to Update Main Gallery Image ---
    function updateMainGalleryImage(index) {
        if (mainImage && images[index]) {
            mainImage.src = images[index];
            galleryThumbs.forEach((thumb, i) => {
                thumb.classList.toggle('active', i === index);
            });
            currentImageIndex = index;
        }
    }

    // --- Lightbox Functions ---
    function openLightbox(index) {
        if (!lightbox || !lightboxImage || !images[index] || isLightboxOpen) {
             console.error("Lightbox elements missing, image source invalid, or already open.");
             return; // Exit if elements missing, index invalid or already open
        }

        currentImageIndex = index;
        isLightboxOpen = true; // Set flag

        // Reset image state before loading new one
        lightboxImage.classList.remove('loaded');
        lightboxImage.style.opacity = '0'; // Hide visually

        // Add loading indicator class to content (optional)
        // lightbox.querySelector('.lightbox-content').classList.add('loading');

        lightboxImage.onload = () => {
            // Image has loaded successfully
            // lightbox.querySelector('.lightbox-content').classList.remove('loading'); // Remove loader
            lightboxImage.classList.add('loaded'); // Make image visible
            lightboxImage.style.opacity = '1';
        };
        lightboxImage.onerror = () => {
            // Image failed to load
            console.error("Lightbox image failed to load:", images[currentImageIndex]);
            // lightbox.querySelector('.lightbox-content').classList.remove('loading');
            // Optionally display an error message or close lightbox
            closeLightbox(); // Close lightbox on error for safety
        };

        lightboxImage.src = images[currentImageIndex]; // Set the source to trigger loading

        // Show the lightbox background immediately (or after a short delay)
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling

        // Update main gallery to match lightbox start index (if triggered from thumb)
        updateMainGalleryImage(index);
    }

    function closeLightbox() {
        if (!lightbox || !isLightboxOpen) return; // Exit if not open

        lightbox.classList.remove('active');
        document.body.style.overflow = 'auto'; // Restore scrolling
        isLightboxOpen = false; // Reset flag
        // Reset image src to prevent showing old image briefly on reopen? (optional)
        // lightboxImage.src = "";
        lightboxImage.classList.remove('loaded');
        lightboxImage.style.opacity = '0';
    }

    function changeImage(direction) {
        if (!isLightboxOpen || images.length <= 1) return; // Exit if not open or only one image

        currentImageIndex += direction;

        if (currentImageIndex < 0) {
            currentImageIndex = images.length - 1;
        } else if (currentImageIndex >= images.length) {
            currentImageIndex = 0;
        }

        // Show next/prev image using similar loading logic as openLightbox
        lightboxImage.classList.remove('loaded');
        lightboxImage.style.opacity = '0';
        // lightbox.querySelector('.lightbox-content').classList.add('loading');

         lightboxImage.onload = () => {
            // lightbox.querySelector('.lightbox-content').classList.remove('loading');
            lightboxImage.classList.add('loaded');
            lightboxImage.style.opacity = '1';
             // Also update the main gallery image behind the scenes
             updateMainGalleryImage(currentImageIndex);
        };
         lightboxImage.onerror = () => {
            console.error("Lightbox image failed to load:", images[currentImageIndex]);
            // lightbox.querySelector('.lightbox-content').classList.remove('loading');
             // Handle error - maybe try next/prev again or close?
             // For now, just log it. The lightbox remains open.
        };

        lightboxImage.src = images[currentImageIndex];
    }


    // --- Event Listeners ---

    // Click on Main Image Overlay to Open Lightbox
    if (mainImageOverlay && images.length > 0) {
        mainImageOverlay.addEventListener('click', () => {
            openLightbox(currentImageIndex); // Open with the currently displayed main image index
        });
    } else if (mainImageContainer && images.length > 0) {
         // Fallback: If overlay doesn't exist, make container clickable
        mainImageContainer.addEventListener('click', () => {
            openLightbox(currentImageIndex);
        });
    }


    // Click on Thumbnails
    if (galleryThumbs.length > 0) {
        galleryThumbs.forEach(thumb => {
            thumb.addEventListener('click', function () {
                const index = parseInt(this.dataset.index);
                updateMainGalleryImage(index);
                // Optional: open lightbox directly when thumb is clicked?
                // openLightbox(index);
            });
        });
    }

    // Lightbox Close Button
    if (lightboxCloseBtn) {
        lightboxCloseBtn.addEventListener('click', closeLightbox);
    }

    // Lightbox Navigation
    if (lightboxPrevBtn) {
        lightboxPrevBtn.addEventListener('click', () => changeImage(-1));
    }
    if (lightboxNextBtn) {
        lightboxNextBtn.addEventListener('click', () => changeImage(1));
    }

    // Click outside Lightbox Image to Close
    if (lightbox) {
        lightbox.addEventListener('click', function (e) {
            // Close only if clicked directly on the dark background (.lightbox),
            // not on the content inside it (.lightbox-content or its children)
            if (e.target === this) {
                closeLightbox();
            }
        });
    }

    // Keyboard Navigation for Lightbox
    document.addEventListener('keydown', function (e) {
        if (!isLightboxOpen) return; // Only act if lightbox is open

        if (e.key === 'Escape') {
            closeLightbox();
        } else if (e.key === 'ArrowLeft') {
            if(lightboxPrevBtn) changeImage(-1); // Check if button exists
        } else if (e.key === 'ArrowRight') {
             if(lightboxNextBtn) changeImage(1); // Check if button exists
        }
    });

    // Initial state: Ensure lightbox is hidden on load (belt and suspenders)
    if(lightbox) {
         lightbox.classList.remove('active');
    }
    document.body.style.overflow = 'auto'; // Ensure scroll is enabled on load

});
</script>
@endpush