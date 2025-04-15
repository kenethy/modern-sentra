@extends('layouts.app')

@section('title', 'Beranda')

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
    
    .stagger-item {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.5s ease-out, transform 0.5s ease-out;
    }
    
    .stagger-item.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    .product-card {
        transition: all 0.4s ease;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    
    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    
    .product-image-container {
        position: relative;
        overflow: hidden;
    }
    
    .product-image {
        transition: transform 0.5s ease;
    }
    
    .product-card:hover .product-image {
        transform: scale(1.05);
    }
    
    .product-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.4) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .product-card:hover .product-overlay {
        opacity: 1;
    }
    
    .category-badge {
        transition: all 0.3s ease;
    }
    
    .product-card:hover .category-badge {
        transform: translateY(-3px);
    }
    
    .detail-button {
        position: relative;
        overflow: hidden;
    }
    
    .detail-button::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background-color: #99765c;
        transition: width 0.3s ease;
    }
    
    .detail-button:hover::after {
        width: 100%;
    }
    
    .feature-card {
        transition: all 0.3s ease;
        border-radius: 1rem;
    }
    
    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    
    .feature-icon {
        transition: all 0.3s ease;
    }
    
    .feature-card:hover .feature-icon {
        transform: scale(1.1);
    }
    
    /* Hero section styles */
    .hero-section {
        position: relative;
        overflow: hidden;
        background-size: cover;
        background-position: center;
    }
    
    .hero-overlay {
        background: linear-gradient(to right, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.4) 100%);
    }
    
    .hero-text {
        text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    
    ::-webkit-scrollbar-thumb {
        background: #99765c;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: #876754;
    }
</style>
@endpush

@section('content')
<!-- Hero Section with Dramatic Design -->
<div class="relative bg-white overflow-hidden">
    <div class="hero-section bg-cover bg-center h-screen flex items-center" style="background-image: url('https://images.unsplash.com/photo-1541123437800-1bb1317badc2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');">
        <div class="hero-overlay absolute inset-0"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-lg">
                <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 hero-text">Material Konstruksi Pilihan Anda</h1>
                <p class="text-xl text-white mb-10 opacity-90">Modern Sentra: Solusi lengkap bahan bangunan berkualitas untuk proyek Anda di Sidoarjo.</p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('products.index') }}" class="bg-[#99765c] hover:bg-[#876754] text-white font-bold py-3 px-8 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 inline-flex items-center">
                        Lihat Produk
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="{{ route('quote-request.create') }}" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-[#99765c] font-bold py-3 px-8 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                        Minta Penawaran
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Keunggulan Section -->
        <div class="mb-20 fade-in">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-16">Mengapa Memilih Kami</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Keunggulan 1 -->
                <div class="feature-card bg-white p-8 text-center rounded-xl shadow-md stagger-item">
                    <div class="flex justify-center mb-6">
                        <div class="feature-icon bg-[#99765c] bg-opacity-10 p-4 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#99765c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Kualitas Terjamin</h3>
                    <p class="text-gray-600">Kami hanya menyediakan produk berkualitas tinggi dari merek terpercaya untuk memastikan keberhasilan proyek Anda.</p>
                </div>
                
                <!-- Keunggulan 2 -->
                <div class="feature-card bg-white p-8 text-center rounded-xl shadow-md stagger-item" style="animation-delay: 0.2s;">
                    <div class="flex justify-center mb-6">
                        <div class="feature-icon bg-[#99765c] bg-opacity-10 p-4 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#99765c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Harga Kompetitif</h3>
                    <p class="text-gray-600">Dapatkan material konstruksi berkualitas dengan harga yang bersaing dan transparansi penuh dalam setiap penawaran.</p>
                </div>
                
                <!-- Keunggulan 3 -->
                <div class="feature-card bg-white p-8 text-center rounded-xl shadow-md stagger-item" style="animation-delay: 0.4s;">
                    <div class="flex justify-center mb-6">
                        <div class="feature-icon bg-[#99765c] bg-opacity-10 p-4 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#99765c]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Konsultasi Ahli</h3>
                    <p class="text-gray-600">Tim profesional kami siap membantu Anda menemukan solusi material yang tepat untuk kebutuhan proyek Anda.</p>
                </div>
            </div>
        </div>
        
        <!-- Produk Unggulan Section -->
        @if($featuredProducts->isNotEmpty())
        <div class="mb-20 fade-in">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-16">Produk Unggulan</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredProducts as $index => $product)
                    <div class="product-card bg-white stagger-item" style="animation-delay: {{ $index * 0.1 }}s;">
                        <div class="product-image-container">
                            @if($product->hasMedia('product_images'))
                                <img src="{{ $product->getFirstMediaUrl('product_images') }}" alt="{{ $product->name }}" class="product-image w-full h-64 object-cover">
                            @else
                                <img src="https://via.placeholder.com/600x400?text=No+Image" alt="{{ $product->name }}" class="product-image w-full h-64 object-cover">
                            @endif
                            <div class="product-overlay"></div>
                            <div class="absolute top-4 right-4">
                                <span class="category-badge bg-[#99765c] bg-opacity-90 text-white text-xs font-bold px-3 py-1.5 rounded-full">
                                    {{ $product->category->name }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $product->name }}</h3>
                            <p class="text-gray-600 mb-6 line-clamp-2">{{ Str::limit($product->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <a href="{{ route('products.show', $product->slug) }}" class="detail-button text-[#99765c] hover:text-[#876754] font-medium inline-flex items-center">
                                    Lihat Detail
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href="{{ route('quote-request.create', ['product_id' => $product->id]) }}" class="bg-[#99765c] hover:bg-[#876754] text-white text-sm font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 transform hover:scale-105">
                                    Minta Penawaran
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('products.index') }}" class="inline-block bg-[#99765c] hover:bg-[#876754] text-white font-bold py-3 px-8 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                    Lihat Semua Produk
                </a>
            </div>
        </div>
        @endif
        
        <!-- Partner Section -->
        <div class="mb-20 fade-in">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-16">Partner Kami</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 items-center">
                <div class="flex justify-center stagger-item">
                    <img src="https://via.placeholder.com/150x60/F5F5F5/99765c?text=PARTNER+1" alt="Partner 1" class="h-12 opacity-70 hover:opacity-100 transition duration-300">
                </div>
                <div class="flex justify-center stagger-item" style="animation-delay: 0.1s;">
                    <img src="https://via.placeholder.com/150x60/F5F5F5/99765c?text=PARTNER+2" alt="Partner 2" class="h-12 opacity-70 hover:opacity-100 transition duration-300">
                </div>
                <div class="flex justify-center stagger-item" style="animation-delay: 0.2s;">
                    <img src="https://via.placeholder.com/150x60/F5F5F5/99765c?text=PARTNER+3" alt="Partner 3" class="h-12 opacity-70 hover:opacity-100 transition duration-300">
                </div>
                <div class="flex justify-center stagger-item" style="animation-delay: 0.3s;">
                    <img src="https://via.placeholder.com/150x60/F5F5F5/99765c?text=PARTNER+4" alt="Partner 4" class="h-12 opacity-70 hover:opacity-100 transition duration-300">
                </div>
                <div class="flex justify-center stagger-item" style="animation-delay: 0.4s;">
                    <img src="https://via.placeholder.com/150x60/F5F5F5/99765c?text=PARTNER+5" alt="Partner 5" class="h-12 opacity-70 hover:opacity-100 transition duration-300">
                </div>
                <div class="flex justify-center stagger-item" style="animation-delay: 0.5s;">
                    <img src="https://via.placeholder.com/150x60/F5F5F5/99765c?text=PARTNER+6" alt="Partner 6" class="h-12 opacity-70 hover:opacity-100 transition duration-300">
                </div>
            </div>
        </div>
        
        <!-- Call to Action Section -->
        <div class="fade-in">
            <div class="bg-gradient-to-r from-[#99765c] to-[#7d5e48] rounded-2xl overflow-hidden shadow-xl">
                <div class="px-8 py-12 md:p-12 text-center md:text-left md:flex items-center">
                    <div class="md:w-2/3 mb-8 md:mb-0 md:pr-8">
                        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Siap Memulai Proyek Anda?</h2>
                        <p class="text-[#f5f2ef] text-lg mb-6">Hubungi tim kami untuk konsultasi gratis dan penawaran khusus untuk kebutuhan proyek Anda.</p>
                        <div class="flex flex-wrap justify-center md:justify-start gap-4">
                            <a href="/contact" class="bg-white text-[#99765c] hover:bg-[#f5f2ef] font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 inline-flex items-center">
                                Hubungi Kami
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="/quote-request" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-[#99765c] font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                                Minta Penawaran Khusus
                            </a>
                        </div>
                    </div>
                    <div class="md:w-1/3">
                        <img src="https://images.unsplash.com/photo-1581094794329-c8112a89af12?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="Material Konstruksi" class="rounded-lg shadow-lg transform -rotate-3 hover:rotate-0 transition duration-500">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Intersection Observer untuk animasi scroll
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1
        });
        
        document.querySelectorAll('.fade-in, .stagger-item').forEach(item => {
            observer.observe(item);
        });
    });
</script>
@endpush

@endsection
