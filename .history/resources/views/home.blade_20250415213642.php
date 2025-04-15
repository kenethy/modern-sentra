{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Beranda - Modern Sentra')

@push('styles')
<style>
    /* Animasi Entri Halus */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeInUp {
        animation: fadeInUp 0.8s ease-out forwards;
        opacity: 0;
        /* Start hidden */
    }

    /* Staggered animation delay helper (jika diperlukan, bisa juga inline) */
    .delay-100 {
        animation-delay: 0.1s;
    }

    .delay-200 {
        animation-delay: 0.2s;
    }

    .delay-300 {
        animation-delay: 0.3s;
    }

    .delay-400 {
        animation-delay: 0.4s;
    }

    .delay-500 {
        animation-delay: 0.5s;
    }

    /* Tambahkan sedikit transisi untuk interaksi umum */
    body {
        /* Font smoothing opsional untuk tampilan lebih halus di beberapa browser */
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    /* Placeholder untuk gambar jika diperlukan styling khusus */
    .img-placeholder {
        background-color: #f3f4f6;
        /* gray-100 */
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9ca3af;
        /* gray-400 */
    }
</style>
@endpush

@section('content')

{{-- Hero Section --}}
<section
    class="relative h-screen flex items-center justify-center text-center bg-gradient-to-br from-gray-900 via-gray-800 to-black text-white overflow-hidden">
    {{-- Background Image with Overlay --}}
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1541123437800-1bb1317badc2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=85"
            alt="Background Konstruksi" class="object-cover w-full h-full opacity-30">
        {{-- Subtle Gradient Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/30"></div>
    </div>

    {{-- Hero Content --}}
    <div class="relative z-10 container mx-auto px-6 max-w-3xl" data-observe>
        <h1 style="color:white"
            class="text-4xl sm:text-5xl md:text-6xl font-extrabold mb-5 leading-tight animate-fadeInUp">
            Material Konstruksi Pilihan Anda
        </h1>
        <p class="text-lg md:text-xl text-white mb-10 animate-fadeInUp delay-100">
            Modern Sentra: Solusi lengkap bahan bangunan berkualitas untuk proyek Anda di Sidoarjo.
        </p>
        <div class="flex flex-col sm:flex-row justify-center items-center gap-4 animate-fadeInUp delay-200">
            <a href="{{ route('products.index') }}"
                class="inline-flex items-center justify-center bg-[#99765c] hover:bg-[#876754] text-white font-semibold py-3 px-8 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-[#99765c] focus:ring-offset-2 focus:ring-offset-black w-full sm:w-auto">
                Jelajahi Produk
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
            <a href="{{ route('quote-request.create') }}"
                class="inline-flex items-center justify-center bg-transparent border-2 border-gray-400 hover:border-white text-gray-300 hover:text-white hover:bg-white/10 font-semibold py-3 px-8 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-black w-full sm:w-auto">
                Minta Penawaran
            </a>
        </div>
    </div>
</section>

{{-- Main Content Area --}}
<div class="bg-gray-50 py-20 sm:py-24 lg:py-32">
    <div class="container mx-auto px-6 space-y-20 sm:space-y-24 lg:space-y-32">

        {{-- Keunggulan Section --}}
        <section data-observe>
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-16 animate-fadeInUp">Mengapa Memilih
                <span class="text-[#99765c]">Modern Sentra</span>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12">
                {{-- Feature Card 1 --}}
                <div
                    class="bg-white p-8 rounded-xl shadow-md border border-gray-100 hover:shadow-xl hover:border-[#99765c]/30 transition-all duration-300 ease-in-out text-center animate-fadeInUp delay-100 group relative overflow-hidden">
                    <div
                        class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#b79b86] via-[#99765c] to-[#876754] opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div class="flex justify-center mb-6">
                        <div
                            class="bg-gradient-to-br from-[#f5f2ef] to-[#e8ddd5] p-4 rounded-full shadow-sm transition-all duration-300 group-hover:shadow-md group-hover:bg-gradient-to-br group-hover:from-[#f0e9e4] group-hover:to-[#d8cfc7]">
                            {{-- Heroicon: ShieldCheckIcon --}}
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10 text-[#99765c] transition-all duration-300 group-hover:scale-110 group-hover:text-[#876754]"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                    </div>
                    <h3
                        class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-[#99765c] transition-colors duration-300">
                        Kualitas Terjamin</h3>
                    <p class="text-gray-600 leading-relaxed">Produk dari merek terpercaya untuk memastikan daya tahan
                        dan hasil terbaik proyek Anda.</p>
                </div>
                {{-- Feature Card 2 --}}
                <div
                    class="bg-white p-8 rounded-xl shadow-md border border-gray-100 hover:shadow-xl hover:border-[#99765c]/30 transition-all duration-300 ease-in-out text-center animate-fadeInUp delay-200 group relative overflow-hidden">
                    <div
                        class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#b79b86] via-[#99765c] to-[#876754] opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div class="flex justify-center mb-6">
                        <div
                            class="bg-gradient-to-br from-[#f5f2ef] to-[#e8ddd5] p-4 rounded-full shadow-sm transition-all duration-300 group-hover:shadow-md group-hover:bg-gradient-to-br group-hover:from-[#f0e9e4] group-hover:to-[#d8cfc7]">
                            {{-- Heroicon: CurrencyDollarIcon --}}
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10 text-[#99765c] transition-all duration-300 group-hover:scale-110 group-hover:text-[#876754]"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <h3
                        class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-[#99765c] transition-colors duration-300">
                        Harga Kompetitif</h3>
                    <p class="text-gray-600 leading-relaxed">Penawaran terbaik untuk material berkualitas tinggi,
                        transparan dan tanpa biaya tersembunyi.</p>
                </div>
                {{-- Feature Card 3 --}}
                <div
                    class="bg-white p-8 rounded-xl shadow-md border border-gray-100 hover:shadow-xl hover:border-[#99765c]/30 transition-all duration-300 ease-in-out text-center animate-fadeInUp delay-300 group relative overflow-hidden">
                    <div
                        class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#b79b86] via-[#99765c] to-[#876754] opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                    <div class="flex justify-center mb-6">
                        <div
                            class="bg-gradient-to-br from-[#f5f2ef] to-[#e8ddd5] p-4 rounded-full shadow-sm transition-all duration-300 group-hover:shadow-md group-hover:bg-gradient-to-br group-hover:from-[#f0e9e4] group-hover:to-[#d8cfc7]">
                            {{-- Heroicon: UserGroupIcon --}}
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-10 w-10 text-[#99765c] transition-all duration-300 group-hover:scale-110 group-hover:text-[#876754]"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <h3
                        class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-[#99765c] transition-colors duration-300">
                        Konsultasi Ahli</h3>
                    <p class="text-gray-600 leading-relaxed">Tim kami siap membantu Anda memilih material yang paling
                        sesuai dengan kebutuhan spesifik proyek.</p>
                </div>
            </div>
        </section>

        {{-- Produk Unggulan Section --}}
        @if($featuredProducts->isNotEmpty())
        <section data-observe>
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-16 animate-fadeInUp">Produk Unggulan
                Kami</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredProducts as $index => $product)
                <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 group transition-all duration-300 ease-in-out hover:shadow-xl animate-fadeInUp"
                    style="animation-delay: {{ ($index + 1) * 0.1 }}s;">
                    <a href="{{ route('products.show', $product->slug) }}" class="block">
                        <div class="relative aspect-w-4 aspect-h-3 overflow-hidden">
                            @if(method_exists($product, 'hasMedia') && $product->hasMedia('product_images'))
                            <img src="{{ $product->getFirstMediaUrl('product_images') }}" alt="{{ $product->name }}"
                                class="object-cover w-full h-full transition-transform duration-500 ease-in-out group-hover:scale-105">
                            @else
                            {{-- Placeholder Lebih Baik --}}
                            <div class="w-full h-full img-placeholder">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            @endif
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                            <div class="absolute top-3 right-3">
                                <span
                                    class="bg-[#99765c]/90 text-white text-xs font-medium px-3 py-1 rounded-full shadow-sm">
                                    {{ $product->category->name }}
                                </span>
                            </div>
                        </div>
                    </a>
                    <div class="p-6">
                        <h3
                            class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-[#99765c] transition-colors duration-200">
                            <a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
                        </h3>
                        <p class="text-gray-600 text-sm mb-5 line-clamp-2">{{ Str::limit($product->description, 90) }}
                        </p>
                        <div class="flex justify-between items-center">
                            <a href="{{ route('products.show', $product->slug) }}"
                                class="text-sm font-medium text-[#99765c] hover:text-[#876754] hover:underline transition-colors duration-200 inline-flex items-center">
                                Lihat Detail
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                            <a href="{{ route('quote-request.create', ['product_id' => $product->id]) }}"
                                class="bg-gray-100 hover:bg-[#f5f2ef] text-[#876754] text-xs font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-[#99765c] focus:ring-offset-2">
                                Minta Penawaran
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-16 animate-fadeInUp"
                style="animation-delay: {{ ($featuredProducts->count() + 1) * 0.1 }}s;">
                <a href="{{ route('products.index') }}"
                    class="inline-block bg-[#99765c] hover:bg-[#876754] text-white font-semibold py-3 px-8 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-[#99765c] focus:ring-offset-2 focus:ring-offset-gray-50">
                    Lihat Semua Produk
                </a>
            </div>
        </section>
        @endif

        {{-- Partner Section --}}
        <section data-observe>
            @include('partials.partners')
        </section>

        {{-- Call to Action Section --}}
        <section data-observe>
            <div class="rounded-2xl overflow-hidden shadow-lg animate-fadeInUp relative">
                {{-- Enhanced brand gradient with shine effect --}}
                <div class="absolute inset-0 bg-gradient-to-r from-[#b79b86] via-[#99765c] to-[#876754] opacity-95">
                </div>
                <div class="absolute inset-0 bg-gradient-to-br from-transparent via-black/5 to-black/20"></div>
                <div
                    class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/30 to-transparent">
                </div>
                <div
                    class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/20 to-transparent">
                </div>
                <div class="px-8 py-12 md:p-16 lg:flex lg:items-center lg:justify-between relative z-10">
                    <div class="lg:w-0 lg:flex-1 mb-10 lg:mb-0 text-center lg:text-left">
                        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 leading-tight drop-shadow-sm">Siap
                            Memulai <span class="text-amber-100">Proyek Anda?</span></h2>
                        <p class="text-white/90 text-lg mb-8 max-w-2xl mx-auto lg:mx-0">
                            Hubungi tim kami sekarang untuk konsultasi gratis dan dapatkan penawaran khusus yang
                            disesuaikan dengan kebutuhan proyek konstruksi Anda.
                        </p>
                        <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                            <a href="/contact" {{-- Ganti dengan route('contact') jika ada --}}
                                class="inline-flex items-center justify-center bg-white/90 text-[#876754] hover:bg-white font-semibold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#99765c] w-full sm:w-auto shadow-md">
                                Hubungi Kami
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </a>
                            <a href="{{ route('quote-request.create') }}"
                                class="inline-flex items-center justify-center bg-[#876754]/80 hover:bg-[#876754] border-2 border-white/20 text-white font-semibold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#99765c] w-full sm:w-auto shadow-md">
                                Minta Penawaran Khusus
                            </a>
                        </div>
                    </div>
                    <div class="hidden lg:block lg:w-1/3 flex-shrink-0 mt-10 lg:mt-0 lg:ml-12">
                        {{-- Gambar yang lebih relevan atau abstrak --}}
                        <img src="https://images.unsplash.com/photo-1581092916389-95414b16f481?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80"
                            alt="Diskusi Proyek Konstruksi"
                            class="rounded-lg shadow-xl object-cover w-full h-auto max-h-80 border-4 border-white/20">
                    </div>
                </div>
            </div>
        </section>

    </div> {{-- End Container --}}
</div> {{-- End Main Content BG --}}

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Simple Intersection Observer for Fade-In Animation on Scroll
        const observerOptions = {
            root: null, // relative to document viewport
            rootMargin: '0px',
            threshold: 0.1 // trigger when 10% of the element is visible
        };

        const observerCallback = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Find all animatable children within the observed section
                    const elementsToAnimate = entry.target.querySelectorAll('.animate-fadeInUp');
                    if (elementsToAnimate.length > 0) {
                        elementsToAnimate.forEach(el => {
                            // Check if animation hasn't already started
                            if (el.style.opacity === '0' || el.style.opacity === '') {
                                el.style.opacity = '1'; // Make sure it stays visible
                                el.style.animationPlayState = 'running';
                            }
                        });
                    } else {
                        // If the observed element itself should animate
                        if (entry.target.classList.contains('animate-fadeInUp')) {
                            if (entry.target.style.opacity === '0' || entry.target.style.opacity === '') {
                                entry.target.style.opacity = '1';
                                entry.target.style.animationPlayState = 'running';
                            }
                        }
                    }

                    // Optional: Unobserve after animation to save resources
                    // observer.unobserve(entry.target);
                }
                // Optional: Reset animation if element scrolls out of view
                // else {
                //     const elementsToReset = entry.target.querySelectorAll('.animate-fadeInUp');
                //     if (elementsToReset.length > 0) {
                //         elementsToReset.forEach(el => {
                //             el.style.opacity = '0';
                //             el.style.animationPlayState = 'paused'; // Or remove class / reset animation
                //         });
                //     } else if (entry.target.classList.contains('animate-fadeInUp')) {
                //          entry.target.style.opacity = '0';
                //          entry.target.style.animationPlayState = 'paused';
                //     }
                // }
            });
        };

        const intersectionObserver = new IntersectionObserver(observerCallback, observerOptions);

        // Target sections or elements that trigger animations within them
        document.querySelectorAll('[data-observe]').forEach(section => {
            // Initially pause animations until they enter viewport
            section.querySelectorAll('.animate-fadeInUp').forEach(el => {
                el.style.opacity = '0'; // Start hidden
                el.style.animationPlayState = 'paused'; // Wait for observer
            });
            intersectionObserver.observe(section);
        });

        // Handle hero section animation immediately without observing (if desired)
        const heroContent = document.querySelector('.hero-section .relative.z-10');
        if (heroContent) {
            heroContent.querySelectorAll('.animate-fadeInUp').forEach(el => {
                el.style.opacity = '1';
                el.style.animationPlayState = 'running';
            });
        }
    });
</script>
@endpush