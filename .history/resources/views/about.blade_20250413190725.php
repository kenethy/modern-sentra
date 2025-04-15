@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('header')
<!-- Kosongkan header karena kita akan menggunakan hero section custom -->
@endsection

@push('styles')
<style>
    .parallax-hero {
        position: relative;
        height: 70vh;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-align: center;
        overflow: hidden;
    }

    .parallax-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }

    .parallax-content {
        position: relative;
        z-index: 2;
        max-width: 800px;
        padding: 0 20px;
    }

    .section-title {
        position: relative;
        display: inline-block;
        margin-bottom: 2rem;
    }

    .section-title:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background-color: #99765c;
    }

    .animate-on-scroll {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }

    .animate-on-scroll.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .timeline {
        position: relative;
        max-width: 1200px;
        margin: 0 auto;
    }

    .timeline::after {
        content: '';
        position: absolute;
        width: 3px;
        background-color: #99765c;
        top: 0;
        bottom: 0;
        left: 50%;
        margin-left: -1.5px;
    }

    .timeline-item {
        padding: 10px 40px;
        position: relative;
        width: 50%;
    }

    .timeline-item::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        background-color: white;
        border: 4px solid #99765c;
        border-radius: 50%;
        top: 15px;
        z-index: 1;
    }

    .timeline-left {
        left: 0;
    }

    .timeline-right {
        left: 50%;
    }

    .timeline-left::after {
        right: -10px;
    }

    .timeline-right::after {
        left: -10px;
    }

    .timeline-content {
        padding: 20px 30px;
        background-color: white;
        position: relative;
        border-radius: 6px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .team-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .team-image-container {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
    }

    .team-social {
        position: absolute;
        bottom: -50px;
        left: 0;
        right: 0;
        background: rgba(59, 130, 246, 0.8);
        display: flex;
        justify-content: center;
        padding: 10px 0;
        transition: bottom 0.3s ease;
    }

    .team-image-container:hover .team-social {
        bottom: 0;
    }

    .stat-card {
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    @media screen and (max-width: 768px) {
        .timeline::after {
            left: 31px;
        }

        .timeline-item {
            width: 100%;
            padding-left: 70px;
            padding-right: 25px;
        }

        .timeline-item::after {
            left: 21px;
        }

        .timeline-right {
            left: 0;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Section with Parallax Effect -->
<div class="parallax-hero"
    style="background-image: url('https://images.unsplash.com/photo-1541888946425-d81bb19240f5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80');">
    <div class="parallax-overlay"></div>
    <div class="parallax-content">
        <h1 class="text-5xl md:text-6xl font-bold mb-4">Tentang Kami</h1>
        <p class="text-xl md:text-2xl mb-8">Membangun Masa Depan dengan Kualitas dan Inovasi</p>
        <a href="#our-story"
            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-full transition duration-300 ease-in-out transform hover:scale-105 inline-flex items-center">
            Pelajari Lebih Lanjut
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                    d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z"
                    clip-rule="evenodd" />
            </svg>
        </a>
    </div>
</div>

<!-- Main Content -->
<div class="py-16">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Our Story Section with Timeline -->
        <section id="our-story" class="mb-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 section-title">Cerita Kami</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto mt-4">Perjalanan kami dalam membangun Modern Sentra
                    menjadi supplier bahan bangunan terpercaya di Indonesia.</p>
            </div>

            <div class="relative py-8">
                <!-- Company Overview -->
                <div class="flex flex-col md:flex-row items-center mb-16 animate-on-scroll">
                    <div class="md:w-1/2 p-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Sejarah Perusahaan</h3>
                        <div class="text-gray-600 space-y-4 text-lg">
                            {!! nl2br(e($history)) !!}
                        </div>
                    </div>
                    <div class="md:w-1/2 p-6">
                        <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80"
                            alt="Sejarah Perusahaan"
                            class="rounded-lg shadow-xl w-full h-auto object-cover transform transition duration-500 hover:scale-105">
                    </div>
                </div>

                <!-- Timeline -->
                <div class="timeline py-8">
                    <!-- Timeline Item 1 -->
                    <div class="timeline-item timeline-left animate-on-scroll">
                        <div class="timeline-content">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">2010</h3>
                            <p class="text-gray-600">Modern Sentra didirikan sebagai toko bahan bangunan kecil di
                                Jakarta dengan fokus pada kualitas produk dan layanan pelanggan.</p>
                        </div>
                    </div>

                    <!-- Timeline Item 2 -->
                    <div class="timeline-item timeline-right animate-on-scroll">
                        <div class="timeline-content">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">2013</h3>
                            <p class="text-gray-600">Ekspansi bisnis dengan membuka cabang kedua dan memperluas
                                jangkauan produk untuk memenuhi kebutuhan proyek konstruksi yang lebih besar.</p>
                        </div>
                    </div>

                    <!-- Timeline Item 3 -->
                    <div class="timeline-item timeline-left animate-on-scroll">
                        <div class="timeline-content">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">2016</h3>
                            <p class="text-gray-600">Meluncurkan layanan konsultasi profesional untuk membantu klien
                                memilih bahan bangunan yang tepat untuk proyek mereka.</p>
                        </div>
                    </div>

                    <!-- Timeline Item 4 -->
                    <div class="timeline-item timeline-right animate-on-scroll">
                        <div class="timeline-content">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">2019</h3>
                            <p class="text-gray-600">Menjadi distributor resmi untuk beberapa merek bahan bangunan
                                terkemuka dan memperluas jangkauan distribusi ke seluruh Jabodetabek.</p>
                        </div>
                    </div>

                    <!-- Timeline Item 5 -->
                    <div class="timeline-item timeline-left animate-on-scroll">
                        <div class="timeline-content">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">2022</h3>
                            <p class="text-gray-600">Meluncurkan platform digital untuk mempermudah pelanggan memesan
                                produk dan berkonsultasi secara online.</p>
                        </div>
                    </div>

                    <!-- Timeline Item 6 -->
                    <div class="timeline-item timeline-right animate-on-scroll">
                        <div class="timeline-content">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Sekarang</h3>
                            <p class="text-gray-600">Terus berinovasi dan berkembang untuk menjadi supplier bahan
                                bangunan terdepan dengan komitmen pada kualitas dan kepuasan pelanggan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vision & Mission Section with Modern Design -->
        <section class="mb-20 animate-on-scroll">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 section-title">Visi & Misi</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto mt-4">Komitmen kami untuk memberikan produk
                    berkualitas dan layanan terbaik.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Vision Card -->
                <div
                    class="bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-xl shadow-lg transform transition duration-500 hover:scale-105">
                    <div class="flex items-center mb-6">
                        <div class="bg-blue-600 p-3 rounded-full mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-blue-800">Visi</h3>
                    </div>
                    <div class="text-gray-700 text-lg leading-relaxed">
                        {{ $vision }}
                    </div>
                </div>

                <!-- Mission Card -->
                <div
                    class="bg-gradient-to-br from-green-50 to-green-100 p-8 rounded-xl shadow-lg transform transition duration-500 hover:scale-105">
                    <div class="flex items-center mb-6">
                        <div class="bg-green-600 p-3 rounded-full mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-green-800">Misi</h3>
                    </div>
                    <div class="text-gray-700 text-lg leading-relaxed">
                        {!! nl2br(e($mission)) !!}
                    </div>
                </div>
            </div>
        </section>

        <!-- Team Section with Modern Cards -->
        <section class="mb-20 animate-on-scroll">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 section-title">Tim Kami</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto mt-4">Kenali para profesional yang berdedikasi di
                    balik kesuksesan Modern Sentra.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($team as $member)
                <div class="team-card bg-white rounded-xl overflow-hidden shadow-lg">
                    <div class="team-image-container">
                        <img src="{{ $member['photo'] }}" alt="{{ $member['name'] }}" class="w-full h-72 object-cover">
                        <div class="team-social">
                            <a href="#" class="text-white mx-2 hover:text-gray-200 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z" />
                                </svg>
                            </a>
                            <a href="#" class="text-white mx-2 hover:text-gray-200 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-2 16h-2v-6h2v6zm-1-6.891c-.607 0-1.1-.496-1.1-1.109 0-.612.492-1.109 1.1-1.109s1.1.497 1.1 1.109c0 .613-.493 1.109-1.1 1.109zm8 6.891h-1.998v-2.861c0-1.881-2.002-1.722-2.002 0v2.861h-2v-6h2v1.093c.872-1.616 4-1.736 4 1.548v3.359z" />
                                </svg>
                            </a>
                            <a href="#" class="text-white mx-2 hover:text-gray-200 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $member['name'] }}</h3>
                        <p class="text-blue-600 font-medium mb-3">{{ $member['position'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Stats Section -->
        <section class="mb-20 animate-on-scroll">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 section-title">Pencapaian Kami</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto mt-4">Angka-angka yang menunjukkan dedikasi dan
                    kesuksesan kami dalam industri bahan bangunan.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Stat Card 1 -->
                <div class="stat-card bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl shadow-md text-center">
                    <div class="bg-blue-600 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-4xl font-bold text-blue-800 mb-2">5,000+</h3>
                    <p class="text-gray-700 font-medium">Pelanggan Puas</p>
                </div>

                <!-- Stat Card 2 -->
                <div
                    class="stat-card bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl shadow-md text-center">
                    <div class="bg-green-600 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-4xl font-bold text-green-800 mb-2">1,200+</h3>
                    <p class="text-gray-700 font-medium">Proyek Selesai</p>
                </div>

                <!-- Stat Card 3 -->
                <div
                    class="stat-card bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl shadow-md text-center">
                    <div class="bg-purple-600 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                        </svg>
                    </div>
                    <h3 class="text-4xl font-bold text-purple-800 mb-2">50+</h3>
                    <p class="text-gray-700 font-medium">Merek Partner</p>
                </div>

                <!-- Stat Card 4 -->
                <div class="stat-card bg-gradient-to-br from-red-50 to-red-100 p-6 rounded-xl shadow-md text-center">
                    <div class="bg-red-600 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-4xl font-bold text-red-800 mb-2">12</h3>
                    <p class="text-gray-700 font-medium">Tahun Pengalaman</p>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="mb-20 animate-on-scroll">
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl overflow-hidden shadow-xl">
                <div class="px-8 py-12 md:p-12 text-center md:text-left md:flex items-center">
                    <div class="md:w-2/3 mb-8 md:mb-0 md:pr-8">
                        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Siap Bekerja Sama dengan Kami?</h2>
                        <p class="text-blue-100 text-lg mb-6">Hubungi kami sekarang untuk konsultasi gratis dan
                            penawaran terbaik untuk kebutuhan bahan bangunan Anda.</p>
                        <div class="flex flex-wrap justify-center md:justify-start gap-4">
                            <a href="/contact"
                                class="bg-white text-blue-700 hover:bg-blue-50 font-bold py-3 px-6 rounded-full transition duration-300 ease-in-out transform hover:scale-105 inline-flex items-center">
                                Hubungi Kami
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="/products"
                                class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-blue-700 font-bold py-3 px-6 rounded-full transition duration-300 ease-in-out transform hover:scale-105">
                                Lihat Produk Kami
                            </a>
                        </div>
                    </div>
                    <div class="md:w-1/3">
                        <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80"
                            alt="Konsultasi"
                            class="rounded-lg shadow-lg transform -rotate-3 hover:rotate-0 transition duration-500">
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@push('scripts')
<script>
    // Intersection Observer untuk animasi scroll
    document.addEventListener('DOMContentLoaded', function () {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.animate-on-scroll').forEach(item => {
            observer.observe(item);
        });
    });
</script>
@endpush

@endsection