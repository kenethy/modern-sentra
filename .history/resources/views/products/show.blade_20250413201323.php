@extends('layouts.app')

@section('title', $product->name) {{-- Set page title to product name --}}

@section('content')

{{-- Lightbox Script (Copied from previous attempt, assuming it's desired) --}}
<script>
    function openLightbox(imageUrl) {
        document.getElementById('lightboxImage').src = imageUrl;
        document.getElementById('lightbox').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        document.getElementById('lightbox').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Close lightbox when clicking outside the image
        const lightbox = document.getElementById('lightbox');
        if (lightbox) {
            lightbox.addEventListener('click', function (e) {
                if (e.target === this) {
                    closeLightbox();
                }
            });
        }

        // Close lightbox with Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && lightbox && lightbox.style.display === 'flex') {
                closeLightbox();
            }
        });

        // Handle thumbnail clicks (if thumbnails exist)
        const thumbnails = document.querySelectorAll('.thumbnail-item');
        thumbnails.forEach(thumb => {
            thumb.addEventListener('click', function() {
                const mainImage = document.getElementById('mainImage');
                if (mainImage) {
                    mainImage.src = this.querySelector('img').src; // Update main image source
                }
            });
        });
    });
</script>

<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="flex mb-5 px-4 sm:px-0" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                        </svg>
                        Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="{{ route('products.index') }}" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">Produk</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2">{{ $product->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Main Product Section -->
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-8">
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
                    <!-- Product Images -->
                    <div>
                        @if($product->hasMedia('product_images'))
                            @php $firstImage = $product->getFirstMedia('product_images'); @endphp
                            <!-- Main Image -->
                            <div class="mb-4 relative group">
                                <img id="mainImage" src="{{ $firstImage->getUrl() }}" alt="{{ $product->name }}"
                                     class="w-full h-80 md:h-96 object-cover rounded-lg shadow-md cursor-pointer border border-gray-200"
                                     onclick="openLightbox('{{ $firstImage->getUrl() }}')">
                                <!-- Zoom icon on hover -->
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 flex items-center justify-center transition-all duration-300 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white opacity-0 group-hover:opacity-80 transition-opacity duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                    </svg>
                                </div>
                            </div>

                            {{-- Thumbnails (if more than one image) --}}
                            @php $mediaItems = $product->getMedia('product_images'); @endphp
                            @if($mediaItems->count() > 1)
                                <div class="grid grid-cols-4 gap-2">
                                    @foreach($mediaItems as $media)
                                        <div class="thumbnail-item cursor-pointer border-2 border-transparent hover:border-blue-500 rounded-md overflow-hidden transition">
                                            <img src="{{ $media->getUrl() }}" alt="Thumbnail {{ $loop->iteration }}"
                                                 class="w-full h-20 object-cover">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @else
                            <!-- Placeholder if no image -->
                            <div class="w-full h-80 md:h-96 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif

                        <!-- Lightbox Modal -->
                        <div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden items-center justify-center p-4" style="display: none;">
                            <div class="relative max-w-4xl max-h-full">
                                <img id="lightboxImage" src="" alt="Enlarged product image" class="max-w-full max-h-[90vh] object-contain rounded-lg">
                                <button onclick="closeLightbox()" class="absolute top-2 right-2 md:-top-4 md:-right-4 bg-gray-800 bg-opacity-50 text-white rounded-full p-2 hover:bg-opacity-75 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div>
                        <div class="flex justify-between items-start mb-3">
                            <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                            @if($product->category)
                            <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-2.5 py-0.5 rounded-full whitespace-nowrap">
                                {{ $product->category->name }}
                            </span>
                            @endif
                        </div>

                        <!-- Description -->
                        <div class="prose max-w-none text-gray-600 mt-4 mb-6">
                            {!! $product->description !!}
                        </div>

                        <!-- Specifications -->
                        @if(!empty($product->specifications) && is_array($product->specifications))
                        <div class="mt-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-3">Spesifikasi Produk</h2>
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <dl class="grid grid-cols-1 gap-x-4 gap-y-3 sm:grid-cols-2">
                                    @foreach($product->specifications as $key => $value)
                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">{{ $key }}</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $value }}</dd>
                                    </div>
                                    @endforeach
                                </dl>
                            </div>
                        </div>
                        @endif

                        <!-- Usage Tips -->
                        @if($product->usage_tips)
                        <div class="mt-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-3">Tips Penggunaan</h2>
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <p class="text-gray-700 text-sm leading-relaxed">{{ $product->usage_tips }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="mt-8 flex flex-wrap gap-4">
                            <!-- Link to Quote Request Form, passing product ID -->
                            <a href="{{ route('quote-request.create', ['product_id' => $product->id]) }}"
                               class="inline-flex items-center justify-center bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-300 shadow-md hover:shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                Minta Penawaran Harga
                            </a>
                            <a href="{{ route('products.index') }}"
                               class="inline-flex items-center justify-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-3 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                                </svg>
                                Kembali ke Produk
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products Section -->
        @if($relatedProducts->count() > 0)
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white border-t border-gray-200">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Produk Terkait</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedProducts as $related)
                    <div class="group bg-white rounded-lg overflow-hidden border border-gray-200 hover:shadow-lg transition duration-300">
                        <a href="{{ route('products.show', $related->slug) }}" class="block">
                            @if($related->hasMedia('product_images'))
                                <img src="{{ $related->getFirstMediaUrl('product_images') }}" alt="{{ $related->name }}"
                                     class="w-full h-48 object-cover group-hover:opacity-80 transition-opacity">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-800 mb-1 group-hover:text-blue-600 transition-colors">{{ $related->name }}</h3>
                                <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ Str::limit(strip_tags($related->description ?? ''), 80) }}</p>
                                <span class="text-blue-600 hover:text-blue-800 font-medium text-sm inline-flex items-center">
                                    Lihat Detail
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </span>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
