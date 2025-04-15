{{-- resources/views/products/show_modern.blade.php (Contoh nama file baru) --}}
@extends('layouts.app')

@section('title', $product->name)

@push('styles')
{{-- Jika Anda punya CSS terpisah untuk produk, sertakan di sini --}}
{{-- <link rel="stylesheet" href="{{ asset('css/products-modern-revised.css') }}"> --}}
<style>
    /* Gaya Kustom Tambahan (Minimal) */
    body {
        font-family: 'Inter', sans-serif; /* Contoh penggunaan font modern */
    }

    /* Galeri */
    .product-gallery-main {
        aspect-ratio: 1 / 1; /* Rasio 1:1 untuk gambar utama */
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        background-color: #f3f4f6; /* Latar belakang jika gambar belum load */
    }
    .product-gallery-main img {
        width: 100%;
        height: 100%;
        object-fit: contain; /* 'contain' agar seluruh produk terlihat, 'cover' jika ingin memenuhi area */
        transition: transform 0.3s ease;
    }
    .product-gallery-main:hover img {
        transform: scale(1.05);
    }
    .product-gallery-thumbs {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(80px, 1fr)); /* Thumbnails responsif */
        gap: 1rem; /* Jarak antar thumbnail */
        margin-top: 1rem;
    }
    .gallery-thumb {
        aspect-ratio: 1 / 1;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        border: 2px solid transparent;
        transition: border-color 0.3s ease, transform 0.2s ease;
        background-color: #f3f4f6;
    }
    .gallery-thumb img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    .gallery-thumb.active {
        border-color: #99765c; /* Warna aksen */
    }
    .gallery-thumb:hover {
        transform: scale(1.05);
    }

    /* Konten Informasi */
    .product-section + .product-section {
        margin-top: 2.5rem; /* Jarak antar bagian (Deskripsi, Spek, Aplikasi) */
        padding-top: 2.5rem;
        border-top: 1px solid #e5e7eb; /* Garis pemisah halus */
    }
    .product-section h3 {
        font-size: 1.25rem; /* 20px */
        font-weight: 600;
        color: #111827; /* Dark gray */
        margin-bottom: 1rem;
    }
    .product-section .prose {
        color: #4b5563; /* Medium gray */
    }
    .product-section .prose p,
    .product-section .prose ul,
    .product-section .prose ol {
        margin-bottom: 1em;
    }
     .product-section .prose ul {
        list-style: disc;
        padding-left: 1.5em;
     }

    /* Spesifikasi */
    .spec-list dt { /* Nama atribut */
        font-weight: 500;
        color: #111827;
    }
    .spec-list dd { /* Nilai atribut */
        color: #4b5563;
        margin-left: 0; /* Reset margin */
        margin-bottom: 0.75rem; /* Jarak antar item spek */
    }

    /* Tombol CTA */
    .cta-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.75rem 1.5rem; /* Padding tombol */
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        text-align: center;
    }
    .cta-primary {
        background-color: #1f2937; /* Dark gray / black */
        color: white;
    }
    .cta-primary:hover {
        background-color: #374151;
    }
    .cta-secondary {
        background-color: #4ade80; /* Green */
        color: white; /* Dark green text */
    }
     .cta-secondary:hover {
         background-color: #22c55e; /* Darker green */
     }

    /* Related Products Card */
     .related-product-card {
         background-color: white;
         border-radius: 12px;
         overflow: hidden;
         transition: transform 0.3s ease, box-shadow 0.3s ease;
         border: 1px solid #e5e7eb; /* Border halus */
     }
     .related-product-card:hover {
         transform: translateY(-5px);
         box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.03);
     }
     .related-product-card .img-container {
         aspect-ratio: 16 / 10; /* Rasio gambar terkait */
         background-color: #f3f4f6;
         overflow: hidden;
     }
     .related-product-card img {
         width: 100%;
         height: 100%;
         object-fit: cover; /* Cover lebih cocok untuk card */
     }


    /* Lightbox (Gaya sebelumnya sudah cukup baik, bisa disesuaikan jika perlu) */
    /* ... Gaya Lightbox dari kode sebelumnya ... */
    .lightbox {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.9); justify-content: center; align-items: center; z-index: 9999; opacity: 0; visibility: hidden; transition: opacity 0.3s ease, visibility 0.3s ease; display: flex;
    }
    .lightbox.active { opacity: 1; visibility: visible; }
    .lightbox-content { position: relative; max-width: 90%; max-height: 90%; }
    .lightbox-content img { max-width: 100%; max-height: 90vh; object-fit: contain; display: block; opacity: 0; transition: opacity 0.3s ease; }
    .lightbox-content img.loaded { opacity: 1; }
    .lightbox-close { position: absolute; top: -35px; right: -10px; color: white; font-size: 35px; cursor: pointer; transition: all 0.3s ease; z-index: 10001; line-height: 1;}
    .lightbox-close:hover { transform: scale(1.1); }
    .lightbox-nav { position: absolute; top: 50%; transform: translateY(-50%); color: white; font-size: 30px; cursor: pointer; background-color: rgba(0, 0, 0, 0.4); width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; z-index: 10000; }
    .lightbox-nav:hover { background-color: rgba(0, 0, 0, 0.7); }
    .lightbox-prev { left: 15px; }
    .lightbox-next { right: 15px; }
    .main-image-overlay { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; background-color: rgba(0,0,0,0); transition: background-color 0.3s ease, opacity 0.3s ease; cursor: pointer; opacity: 0; }
    .product-gallery-main:hover .main-image-overlay { background-color: rgba(0,0,0,0.3); opacity: 1; }
    .main-image-overlay svg { height: 3rem; width: 3rem; color: white; }

</style>
@endpush

@section('content')
<div class="bg-gray-50 py-16 sm:py-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <nav class="mb-10 text-sm text-gray-500" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="hover:text-[#99765c] transition-colors">
                        Beranda
                    </a>
                </li>
                <li><span class="text-gray-400 mx-1">/</span></li>
                <li>
                    <a href="{{ route('products.index') }}" class="hover:text-[#99765c] transition-colors">Produk</a>
                </li>
                <li><span class="text-gray-400 mx-1">/</span></li>
                <li aria-current="page">
                    <span class="font-medium text-gray-700 truncate">{{ $product->name }}</span>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16">

            <div class="product-gallery">
                <div class="product-gallery-main" id="mainImageContainer">
                    @php
                        $firstImageUrl = $product->hasMedia('product_images') ? $product->getFirstMediaUrl('product_images') : asset('images/placeholder-product.svg'); // Placeholder SVG lebih baik
                    @endphp
                    @if($product->hasMedia('product_images'))
                        <img src="{{ $firstImageUrl }}" alt="{{ $product->name }}" class="gallery-main-img" id="galleryMainImg">
                    @else
                        <div class="w-full h-full flex items-center justify-center p-8">
                            <svg class="w-24 h-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                     @endif
                     {{-- Overlay Lightbox Trigger --}}
                    <div class="main-image-overlay" id="mainImageOverlay">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" /></svg>
                    </div>
                </div>

                 {{-- Thumbnails --}}
                 @if($product->hasMedia('product_images') && $product->getMedia('product_images')->count() > 1)
                 <div class="product-gallery-thumbs">
                     @foreach($product->getMedia('product_images') as $index => $media)
                     <div class="gallery-thumb {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}" data-src="{{ $media->getUrl() }}">
                         <img src="{{ $media->getUrl() }}" alt="{{ $product->name }} - Thumbnail {{ $index + 1 }}">
                     </div>
                     @endforeach
                 </div>
                 @endif
            </div>

            <div class="product-info">
                {{-- Kategori & Status --}}
                <div class="flex items-center space-x-2 mb-3">
                    <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-gray-100 text-gray-600 border border-gray-200">{{ $product->category->name }}</span>
                    @if($product->is_featured)
                    <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-yellow-100 text-yellow-700 border border-yellow-200">Unggulan</span>
                    @endif
                </div>

                {{-- Nama Produk --}}
                <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>

                {{-- Deskripsi Singkat --}}
                <p class="text-lg text-gray-600 mb-8">{{ $product->description }}</p>

                {{-- Tombol Aksi (CTA) --}}
                <div class="flex flex-col sm:flex-row gap-4 mb-10">
                    <a href="{{ route('quote-request.product', ['id' => $product->id]) }}" class="cta-button cta-primary w-full sm:w-auto">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        Minta Penawaran
                    </a>
                     <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('contact.whatsapp', '6281234567890')) }}?text=Halo, saya tertarik dengan produk {{ $product->name }}." target="_blank" class="cta-button cta-secondary w-full sm:w-auto">
                        <svg class="w-5 h-5 mr-2 -ml-1" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"></path></svg>
                        Tanya via WhatsApp
                    </a>
                </div>

                {{-- Divider Pemisah (opsional, bisa dihapus jika terlalu ramai) --}}
                 <hr class="border-gray-200">

                {{-- Bagian Detail / Deskripsi Lengkap --}}
                <div class="product-section">
                    <h3>Detail Produk</h3>
                    <div class="prose prose-sm sm:prose lg:prose-base max-w-none">
                        @if($product->details)
                            {!! $product->details !!}
                        @else
                            {{-- Tampilkan deskripsi lagi jika tidak ada detail spesifik --}}
                            <p>{{ $product->description }}</p>
                            <p class="mt-4 text-gray-500">Informasi detail lebih lanjut belum tersedia untuk produk ini. Silakan hubungi kami untuk pertanyaan spesifik.</p>
                        @endif
                    </div>
                </div>

                {{-- Bagian Spesifikasi --}}
                 @if($product->attributes->isNotEmpty())
                <div class="product-section">
                    <h3>Spesifikasi Teknis</h3>
                    <dl class="spec-list space-y-3">
                        @foreach($product->attributes as $attribute)
                        <div>
                           <dt>{{ $attribute->name }}</dt>
                           <dd>{{ $attribute->value }}</dd>
                        </div>
                        @endforeach
                    </dl>
                </div>
                @endif

                 {{-- Bagian Aplikasi --}}
                <div class="product-section">
                    <h3>Aplikasi Penggunaan</h3>
                    <div class="prose prose-sm sm:prose lg:prose-base max-w-none">
                         @if($product->applications)
                             {!! $product->applications !!}
                         @else
                             <p class="text-gray-500">Informasi mengenai aplikasi penggunaan spesifik belum tersedia. Produk ini umumnya cocok untuk berbagai kebutuhan konstruksi standar. Hubungi kami untuk diskusi kesesuaian dengan proyek Anda.</p>
                             {{-- Contoh list default jika tidak ada data --}}
                             {{-- <ul>
                                 <li>Proyek konstruksi umum</li>
                                 <li>Bangunan komersial</li>
                                 <li>Bangunan residensial</li>
                             </ul> --}}
                         @endif
                    </div>
                </div>

            </div>

        </div>@if($relatedProducts->isNotEmpty())
        <div class="mt-20 lg:mt-28 pt-10 border-t border-gray-200">
            <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Produk Terkait Lainnya</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach($relatedProducts as $relatedProduct)
                <div class="related-product-card">
                     <a href="{{ route('products.show', $relatedProduct) }}" class="block">
                         <div class="img-container">
                             @if($relatedProduct->hasMedia('product_images'))
                                 <img src="{{ $relatedProduct->getFirstMediaUrl('product_images') }}" alt="{{ $relatedProduct->name }}">
                             @else
                             <div class="w-full h-full flex items-center justify-center p-4">
                                 <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                             </div>
                             @endif
                         </div>
                         <div class="p-5">
                             <h3 class="text-base font-semibold text-gray-900 mb-1 line-clamp-1">{{ $relatedProduct->name }}</h3>
                             <p class="text-sm text-gray-500 line-clamp-2 mb-3">{{ Str::limit($relatedProduct->description, 60) }}</p>
                             <span class="text-sm font-medium text-[#99765c] hover:text-[#7c5f4a]">
                                 Lihat Detail &rarr;
                             </span>
                         </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif

         <div class="mt-16 text-center">
            <a href="{{ route('products.index') }}" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Semua Produk
             </a>
         </div>

    </div>
</div>

<div id="lightbox" class="lightbox">
    <div class="lightbox-content">
        <img id="lightboxImage" src="" alt="Enlarged product image">
        <span class="lightbox-close" id="lightboxClose">&times;</span>
        @if($product->hasMedia('product_images') && $product->getMedia('product_images')->count() > 1)
        <div class="lightbox-prev lightbox-nav" id="lightboxPrev">
             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </div>
        <div class="lightbox-next lightbox-nav" id="lightboxNext">
             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // --- Hapus Logika Tab ---

    // --- Gallery & Lightbox Functionality (Sama seperti kode perbaikan sebelumnya) ---
    const galleryThumbs = document.querySelectorAll('.gallery-thumb');
    const mainImage = document.getElementById('galleryMainImg');
    const mainImageContainer = document.getElementById('mainImageContainer');
    const mainImageOverlay = document.getElementById('mainImageOverlay');

    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxCloseBtn = document.getElementById('lightboxClose');
    const lightboxPrevBtn = document.getElementById('lightboxPrev');
    const lightboxNextBtn = document.getElementById('lightboxNext');

    let currentImageIndex = 0;
    const images = [];

    if (galleryThumbs.length > 0) {
        galleryThumbs.forEach(thumb => { images.push(thumb.dataset.src); });
    } else if (mainImage && mainImage.src && !mainImage.src.includes('placeholder')) { // Cek placeholder
        images.push(mainImage.src);
    }

    // Isi placeholder jika array masih kosong setelah cek di atas
    if (images.length === 0) {
        images.push("{{ asset('images/placeholder-product.svg') }}");
    }

    let isLightboxOpen = false;

    function updateMainGalleryImage(index) {
        if (mainImage && images[index]) {
             // Jangan update src jika sumbernya placeholder dan hanya ada 1 gambar
             if (!(images.length === 1 && images[0].includes('placeholder'))) {
                mainImage.src = images[index];
             }
             galleryThumbs.forEach((thumb, i) => {
                 thumb.classList.toggle('active', i === index);
             });
             currentImageIndex = index;
        }
    }

    function openLightbox(index) {
         // Jangan buka lightbox jika hanya ada gambar placeholder
         if (images.length === 1 && images[0].includes('placeholder')) {
             return;
         }

        if (!lightbox || !lightboxImage || !images[index] || isLightboxOpen) {
             console.error("Lightbox elements missing, image source invalid, or already open.");
             return;
        }
        currentImageIndex = index;
        isLightboxOpen = true;
        lightboxImage.classList.remove('loaded');
        lightboxImage.style.opacity = '0';

        lightboxImage.onload = () => { lightboxImage.classList.add('loaded'); lightboxImage.style.opacity = '1'; };
        lightboxImage.onerror = () => { console.error("Lightbox image failed:", images[currentImageIndex]); closeLightbox(); };
        lightboxImage.src = images[currentImageIndex];
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
        updateMainGalleryImage(index); // Update galeri utama juga
    }

    function closeLightbox() {
        if (!lightbox || !isLightboxOpen) return;
        lightbox.classList.remove('active');
        document.body.style.overflow = 'auto';
        isLightboxOpen = false;
        lightboxImage.classList.remove('loaded');
        lightboxImage.style.opacity = '0';
    }

    function changeImage(direction) {
        if (!isLightboxOpen || images.length <= 1) return;
        currentImageIndex += direction;
        if (currentImageIndex < 0) { currentImageIndex = images.length - 1; }
        else if (currentImageIndex >= images.length) { currentImageIndex = 0; }

        lightboxImage.classList.remove('loaded');
        lightboxImage.style.opacity = '0';
        lightboxImage.onload = () => { lightboxImage.classList.add('loaded'); lightboxImage.style.opacity = '1'; updateMainGalleryImage(currentImageIndex); };
        lightboxImage.onerror = () => { console.error("Lightbox image failed:", images[currentImageIndex]); };
        lightboxImage.src = images[currentImageIndex];
    }

    // Event Listeners (Sama seperti sebelumnya)
    if (mainImageOverlay && images.length > 0 && !(images.length === 1 && images[0].includes('placeholder'))) { // Cek placeholder
         mainImageOverlay.addEventListener('click', () => { openLightbox(currentImageIndex); });
    } else if (mainImageContainer && images.length > 0 && !(images.length === 1 && images[0].includes('placeholder'))) { // Fallback + Cek Placeholder
        mainImageContainer.style.cursor = 'pointer'; // Tambahkan cursor jika overlay tak ada tapi bisa diklik
        mainImageContainer.addEventListener('click', () => { openLightbox(currentImageIndex); });
    }

    if (galleryThumbs.length > 0) {
        galleryThumbs.forEach(thumb => {
            thumb.addEventListener('click', function () {
                const index = parseInt(this.dataset.index);
                updateMainGalleryImage(index);
            });
        });
    }
    if (lightboxCloseBtn) { lightboxCloseBtn.addEventListener('click', closeLightbox); }
    if (lightboxPrevBtn) { lightboxPrevBtn.addEventListener('click', () => changeImage(-1)); }
    if (lightboxNextBtn) { lightboxNextBtn.addEventListener('click', () => changeImage(1)); }
    if (lightbox) {
        lightbox.addEventListener('click', function (e) { if (e.target === this) { closeLightbox(); } });
    }
    document.addEventListener('keydown', function (e) {
        if (!isLightboxOpen) return;
        if (e.key === 'Escape') { closeLightbox(); }
        else if (e.key === 'ArrowLeft' && lightboxPrevBtn) { changeImage(-1); }
        else if (e.key === 'ArrowRight' && lightboxNextBtn) { changeImage(1); }
    });

    // Initial state
    if(lightbox) { lightbox.classList.remove('active'); }
    document.body.style.overflow = 'auto';

});
</script>
@endpush