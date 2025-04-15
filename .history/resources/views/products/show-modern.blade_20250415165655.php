@extends('layouts.app')

@section('title', $product->name . ' - Product Details')

@push('styles')
    {{-- Add any specific styles for this page if needed --}}
{{-- <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"> --}}
<style>
    body {
        font-family: 'Inter', sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    /* Galeri - Lebih Dominan */
    .product-gallery-main {
        aspect-ratio: 1 / 1; /* Kotak, membuat galeri terasa solid */
        border-radius: 16px; /* Rounded lebih besar */
        overflow: hidden;
        position: relative;
        background-color: #f9fafb; /* Slightly off-white background */
    }
    .product-gallery-main img {
        width: 100%;
        height: 100%;
        object-fit: contain; /* Contain lebih aman untuk produk utuh */
        transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    /* Subtle zoom on hover */
    .product-gallery-main:hover img {
        transform: scale(1.03);
    }

    /* Thumbnails - Minimal */
    .product-gallery-thumbs {
        display: grid;
        grid-template-columns: repeat(5, 1fr); /* Lebih banyak thumb per baris jika muat */
        gap: 0.75rem; /* 12px gap */
        margin-top: 1rem; /* 16px margin */
    }
    .gallery-thumb {
        aspect-ratio: 1 / 1;
        border-radius: 10px; /* Match main image rounding */
        overflow: hidden;
        cursor: pointer;
        border: 1px solid #e5e7eb; /* Border sangat halus */
        transition: border-color 0.3s ease, opacity 0.3s ease;
        opacity: 0.7; /* Sedikit redup by default */
    }
    .gallery-thumb img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        background-color: #fff; /* Background putih untuk gambar contain */
    }
    .gallery-thumb.active {
        border-color: #99765c; /* Warna aksen */
        opacity: 1.0; /* Full opacity */
    }
    .gallery-thumb:hover {
        opacity: 1.0; /* Full opacity on hover */
    }

    /* Tombol CTA - Modern & Clean */
    .cta-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.875rem 1.5rem; /* 14px vert, 24px horiz */
        border-radius: 10px; /* Rounded lebih halus */
        font-weight: 500; /* Medium weight */
        transition: all 0.2s ease-out;
        text-align: center;
        border: 1px solid transparent; /* Base border */
        font-size: 0.875rem; /* 14px */
        line-height: 1.25rem; /* 20px */
    }
    .cta-primary {
        background-color: #111827; /* Near black */
        color: white;
        border-color: #111827;
    }
    .cta-primary:hover {
        background-color: #374151; /* Darker gray */
        border-color: #374151;
    }
    .cta-secondary { /* Tombol WhatsApp */
        background-color: #25D366; /* WhatsApp Green */
        color: white;
        border-color: #25D366;
    }
    .cta-secondary:hover {
        background-color: #128C7E; /* Darker WhatsApp Green */
        border-color: #128C7E;
    }
    .cta-secondary svg { /* Pastikan ikon WA putih */
        fill: white;
    }

    /* Tabs - Ultra Minimal */
    .product-tabs {
        margin-top: 2.5rem; /* 40px */
        padding-top: 2rem; /* 32px */
        border-top: 1px solid #f3f4f6; /* Border super halus pemisah info & tab */
    }
    .tab-buttons-container {
        display: flex;
        gap: 1.5rem; /* 24px gap antar tombol tab */
        border-bottom: 1px solid #e5e7eb; /* Garis bawah container */
        margin-bottom: 1.5rem; /* 24px margin */
    }
    .tab-button {
        padding-bottom: 0.75rem; /* 12px padding bawah */
        font-size: 0.875rem; /* 14px */
        font-weight: 500; /* Medium */
        color: #6b7280; /* Gray-500 */
        background: none;
        border: none;
        cursor: pointer;
        position: relative;
        transition: color 0.3s ease;
    }
    .tab-button:hover {
        color: #111827; /* Dark gray on hover */
    }
    .tab-button.active {
        color: #99765c; /* Warna aksen */
        font-weight: 600; /* Sedikit bold */
    }
    /* Indikator aktif halus di bawah */
    .tab-button.active::after {
        content: '';
        position: absolute;
        bottom: -1px; /* Tepat di atas border container */
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #99765c; /* Warna aksen */
    }

    /* Tab Content - Clean Prose */
    .tab-content {
        display: none;
        color: #374151; /* Gray-700 */
        font-size: 0.9375rem; /* Slightly larger base text (15px) */
        line-height: 1.65; /* Improved readability */
    }
    .tab-content.active {
        display: block;
        animation: fadeIn 0.5s ease forwards; /* Gunakan animasi dari inspirasi */
    }
     @keyframes fadeIn { /* Definisikan ulang jika perlu */
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .tab-content h3 { /* Judul dalam tab (jika ada) */
        font-size: 1.125rem; /* 18px */
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: #111827;
    }
    .tab-content ul {
        list-style: disc;
        padding-left: 1.25rem; /* 20px */
        margin-top: 0.75rem;
        margin-bottom: 1rem;
    }
     .tab-content li {
         margin-bottom: 0.4rem;
     }
     .tab-content p + p {
         margin-top: 0.75rem;
     }
     /* Spesifikasi dalam tab */
     .spec-list-tab dt { font-weight: 500; color: #1f2937; margin-bottom: 0.15rem; }
     .spec-list-tab dd { color: #4b5563; margin-left: 0; margin-bottom: 0.85rem; }


    /* Related Products - Konsisten Minimal */
    .related-product-card {
        background-color: white;
        border-radius: 16px; /* Match main card rounding */
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid #f3f4f6; /* Border sangat halus */
    }
     .related-product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 20px -4px rgba(0, 0, 0, 0.04); /* Shadow lebih subtle */
    }
    .related-product-card .img-container {
        aspect-ratio: 16 / 10;
        background-color: #f9fafb;
        overflow: hidden;
    }
    .related-product-card img { width: 100%; height: 100%; object-fit: cover; }
    .related-product-card .p-5 { padding: 1.25rem; } /* 20px padding */
    .related-product-card h3 { font-size: 1rem; font-weight: 600; margin-bottom: 0.25rem; }
    .related-product-card p { font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem; }
    .related-product-card .link-details { font-size: 0.875rem; font-weight: 500; color: #99765c; }

    /* Lightbox (Gunakan gaya dari inspirasi/perbaikan sebelumnya) */
    /* ... Style Lightbox ... */
    .lightbox { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.92); justify-content: center; align-items: center; z-index: 9999; opacity: 0; visibility: hidden; transition: opacity 0.3s ease, visibility 0.3s ease; display: flex; }
    .lightbox.active { opacity: 1; visibility: visible; }
    .lightbox-content { position: relative; max-width: 90%; max-height: 90%; }
    .lightbox-content img { max-width: 100%; max-height: 90vh; object-fit: contain; display: block; opacity: 0; transition: opacity 0.3s ease; }
    .lightbox-content img.loaded { opacity: 1; }
    .lightbox-close { position: absolute; top: -35px; right: -10px; color: white; font-size: 35px; cursor: pointer; transition: all 0.3s ease; z-index: 10001; line-height: 1;}
    .lightbox-close:hover { transform: scale(1.1); color: #ccc; }
    .lightbox-nav { position: absolute; top: 50%; transform: translateY(-50%); color: white; font-size: 24px; cursor: pointer; background-color: rgba(30, 30, 30, 0.5); width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; z-index: 10000; border: 1px solid rgba(255,255,255,0.2); }
    .lightbox-nav:hover { background-color: rgba(0, 0, 0, 0.7); border-color: rgba(255,255,255,0.4); }
    .lightbox-prev { left: 20px; }
    .lightbox-next { right: 20px; }
    .main-image-overlay { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; background-color: rgba(0,0,0,0); transition: background-color 0.3s ease, opacity 0.3s ease; cursor: pointer; opacity: 0; border-radius: 16px;} /* Match rounding */
    .product-gallery-main:hover .main-image-overlay { background-color: rgba(0,0,0,0.4); opacity: 1; }
    .main-image-overlay svg { height: 2.75rem; width: 2.75rem; color: rgba(255,255,255,0.9); stroke-width: 1.5; }

</style>
@endpush

@section('content')
<div class="bg-white py-12 sm:py-16 px-4 sm:px-6 lg:px-8"> {{-- Reduced padding --}}
    <div class="max-w-7xl mx-auto">
        <nav class="mb-8 text-xs text-gray-400" aria-label="Breadcrumb"> {{-- Reduced margin, slightly lighter text --}}
            <ol class="inline-flex items-center space-x-1 md:space-x-1.5"> {{-- Reduced space --}}
                 {{-- Konten breadcrumbs sama --}}
                 <li class="inline-flex items-center"><a href="{{ route('home') }}" class="hover:text-[#99765c] transition-colors">Beranda</a></li>
                 <li><span class="text-gray-300 mx-1">/</span></li>
                 <li><a href="{{ route('products.index') }}" class="hover:text-[#99765c] transition-colors">Produk</a></li>
                 <li><span class="text-gray-300 mx-1">/</span></li>
                 <li aria-current="page"><span class="font-medium text-gray-500 truncate">{{ $product->name }}</span></li>
             </ol>
         </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16"> {{-- Reduced gap --}}

            <div class="product-gallery">
                {{-- Main Image --}}
                <div class="product-gallery-main" id="mainImageContainer">
                    @php
                        $firstImageUrl = $product->hasMedia('product_images') ? $product->getFirstMediaUrl('product_images') : asset('images/placeholder-product-minimal.svg'); // Placeholder minimal
                    @endphp
                    @if($product->hasMedia('product_images'))
                        <img src="{{ $firstImageUrl }}" alt="{{ $product->name }}" class="gallery-main-img" id="galleryMainImg">
                    @else
                        <div class="w-full h-full flex items-center justify-center p-10">
                            <svg class="w-20 h-20 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                         </div>
                    @endif
                    {{-- Lightbox Trigger Overlay --}}
                    <div class="main-image-overlay" id="mainImageOverlay">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" /></svg>
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

            <div class="product-info flex flex-col"> {{-- Flex column untuk kontrol ordering jika perlu --}}
                 {{-- Kategori/Tag (Minimal) --}}
                <div class="mb-2">
                    <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">{{ $product->category->name }}</span>
                 </div>

                {{-- Nama Produk --}}
                <h1 class="text-2xl lg:text-3xl font-semibold text-gray-900 mb-3 leading-snug">{{ $product->name }}</h1> {{-- Smaller heading, less margin --}}

                {{-- Deskripsi Singkat --}}
                <p class="text-sm text-gray-600 mb-6">{{ $product->description }}</p> {{-- Smaller text, less margin --}}

                {{-- Tombol Aksi (CTA) - Ditempatkan sebelum Tab --}}
                <div class="flex flex-col sm:flex-row gap-2.5 mt-auto pt-5"> {{-- Reduced gap, reduced padding top --}}
                    <a href="{{ route('quote-request.product', ['id' => $product->id]) }}" class="cta-button cta-primary w-full sm:w-auto">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg> {{-- Reduced icon margin --}}
                        Minta Penawaran
                    </a>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('contact.whatsapp', '6281234567890')) }}?text=Halo, saya tertarik dengan produk {{ $product->name }}." target="_blank" class="cta-button cta-secondary w-full sm:w-auto">
                        <svg class="w-4 h-4 mr-1.5" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" /></svg> {{-- Reduced icon margin --}}
                        Tanya via WhatsApp
                    </a>
                 </div>

                {{-- Kontainer Tab --}}
                <div class="product-tabs">
                    <div class="tab-buttons-container mb-1rem"> {{-- Reduced margin bottom --}}
                        <button class="tab-button active" data-tab="details">Detail</button>
                        <button class="tab-button" data-tab="specs">Spesifikasi</button>
                        <button class="tab-button" data-tab="applications">Aplikasi</button>
                    </div>

                    <div class="tab-content-container">
                        {{-- Konten Detail --}}
                        <div id="details" class="tab-content active text-sm"> {{-- Smaller base text for tab content --}}
                             @if($product->details)
                                {!! $product->details !!} {{-- Anggap $product->details sudah bersih/aman --}}
                             @else
                                 {{-- Tampilkan deskripsi panjang lagi jika tidak ada $product->details --}}
                                 <p>{{ $product->description }}</p>
                                 <p class="mt-3 text-gray-500 text-xs">Informasi detail lengkap belum tersedia.</p> {{-- Smaller text --}}
                             @endif
                        </div>

                        {{-- Konten Spesifikasi --}}
                        <div id="specs" class="tab-content text-sm"> {{-- Smaller base text --}}
                            @if($product->attributes->isNotEmpty())
                            <dl class="spec-list-tab grid grid-cols-1 sm:grid-cols-2 gap-x-5 gap-y-3"> {{-- Reduced gap --}}
                                @foreach($product->attributes as $attribute)
                                <div>
                                    <dt class="text-xs font-medium">{{ $attribute->name }}</dt> {{-- Smaller dt --}}
                                    <dd class="text-xs">{{ $attribute->value }}</dd> {{-- Smaller dd --}}
                                 </div>
                                @endforeach
                            </dl>
                            @else
                            <p class="text-gray-500 text-xs">Spesifikasi teknis tidak tersedia.</p> {{-- Smaller text --}}
                            @endif
                        </div>

                        {{-- Konten Aplikasi --}}
                        <div id="applications" class="tab-content text-sm"> {{-- Smaller base text --}}
                             @if($product->applications)
                                {!! $product->applications !!} {{-- Anggap $product->applications sudah bersih/aman --}}
                             @else
                                 <p class="text-gray-500 text-xs">Informasi aplikasi penggunaan tidak tersedia.</p> {{-- Smaller text --}}
                             @endif
                        </div>
                    </div>
                </div>

            </div> </div> @if($relatedProducts->isNotEmpty())
        <div class="mt-16 lg:mt-20 pt-10 border-t border-gray-100"> {{-- Reduced margin/padding, border halus --}}
            <h2 class="text-lg font-medium text-gray-800 mb-6 text-center">Anda Mungkin Juga Suka</h2> {{-- Smaller heading, less margin --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-6"> {{-- Adjusted grid cols & gap --}}
                 @foreach($relatedProducts as $relatedProduct)
                <div class="related-product-card group border border-transparent hover:border-gray-200 transition-colors duration-200"> {{-- Subtle border on hover --}}
                    <a href="{{ route('products.show', $relatedProduct) }}" class="block">
                        <div class="img-container bg-gray-50"> {{-- Lighter bg --}}
                             @if($relatedProduct->hasMedia('product_images'))
                                <img src="{{ $relatedProduct->getFirstMediaUrl('product_images') }}" alt="{{ $relatedProduct->name }}" class="transition-transform duration-300 group-hover:scale-103"> {{-- Less scale --}}
                             @else
                             <div class="w-full h-full flex items-center justify-center p-3">
                                 <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg> {{-- Smaller placeholder --}}
                             </div>
                             @endif
                        </div>
                        <div class="p-3"> {{-- Reduced padding --}}
                            <h3 class="text-xs font-medium text-gray-700 mb-0.5 line-clamp-1 group-hover:text-[#99765c] transition-colors">{{ $relatedProduct->name }}</h3> {{-- Smaller text --}}
                            {{-- Removed "Lihat Detail" text for minimalism --}}
                        </div>
                    </a>
                </div>
                @endforeach
             </div>
        </div>
        @endif

        <div class="mt-12 text-center"> {{-- Reduced margin --}}
            <a href="{{ route('products.index') }}" class="inline-flex items-center text-xs font-medium text-gray-400 hover:text-gray-700 transition-colors group"> {{-- Lighter text --}}
        @endif

        <div class="mt-16 text-center">
            <a href="{{ route('products.index') }}" class="inline-flex items-center text-xs font-medium text-gray-500 hover:text-gray-800 transition-colors group">
                <svg class="w-3 h-3 mr-1.5 transition-transform duration-200 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                 Lihat Semua Produk
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
// Script di sini SAMA PERSIS dengan script dari KODE INSPIRASI Anda
// (Yang mencakup fungsi tab, galeri, dan lightbox)
// Pastikan Anda menyalin script dari file inspirasi Anda ke sini.
// Atau gunakan script perbaikan lightbox sebelumnya jika ingin lebih robust.

// Contoh (minimal) dari script inspirasi Anda yang relevan:
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
                    // Nonaktifkan semua
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    tabContents.forEach(content => content.classList.remove('active'));
                    // Aktifkan yang diklik
                    this.classList.add('active');
                    targetContent.classList.add('active');
                }
            });
        });
    }

    // --- Gallery & Lightbox Functionality (Robust version recommended) ---
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

     // Populate images array
     if (galleryThumbs.length > 0) {
         galleryThumbs.forEach(thumb => { images.push(thumb.dataset.src); });
     } else if (mainImage && mainImage.src && !mainImage.src.includes('placeholder')) {
         images.push(mainImage.src);
     }
     if (images.length === 0) { // Placeholder fallback
         @if ($product->hasMedia('product_images'))
            images.push("{{ $product->getFirstMediaUrl('product_images') }}");
         @else
            images.push("{{ asset('images/placeholder-product-minimal.svg') }}"); // Match placeholder in HTML
         @endif
     }

    let isLightboxOpen = false;

    function updateMainGalleryImage(index) {
        if (mainImage && images[index]) {
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
         if (images.length === 1 && images[0].includes('placeholder')) return;
         if (!lightbox || !lightboxImage || !images[index] || isLightboxOpen) return;

        currentImageIndex = index;
        isLightboxOpen = true;
        lightboxImage.classList.remove('loaded');
        lightboxImage.style.opacity = '0';

        lightboxImage.onload = () => { lightboxImage.classList.add('loaded'); lightboxImage.style.opacity = '1'; };
        lightboxImage.onerror = () => { console.error("Lightbox image failed:", images[currentImageIndex]); closeLightbox(); };
        lightboxImage.src = images[currentImageIndex];
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
         // Don't necessarily update main gallery when opening lightbox
         // updateMainGalleryImage(index);
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
        lightboxImage.onload = () => { lightboxImage.classList.add('loaded'); lightboxImage.style.opacity = '1'; };
        lightboxImage.onerror = () => { console.error("Lightbox image failed:", images[currentImageIndex]); };
        lightboxImage.src = images[currentImageIndex];
    }

    // Event Listeners
    if (mainImageOverlay && images.length > 0 && !(images.length === 1 && images[0].includes('placeholder'))) {
         mainImageOverlay.addEventListener('click', () => { openLightbox(currentImageIndex); });
    } else if (mainImageContainer && images.length > 0 && !(images.length === 1 && images[0].includes('placeholder'))) {
        mainImageContainer.style.cursor = 'pointer';
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