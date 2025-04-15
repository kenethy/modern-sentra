@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')

<!-- Hero Section -->
<div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-20 md:py-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-4 animate-fade-in-down">Tentang Modern Sentra</h1>
        <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto animate-fade-in-up">
            Mendorong inovasi dan menyediakan solusi berkualitas tinggi untuk kebutuhan industri Anda.
        </p>
    </div>
</div>

<!-- Main Content Area -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Our Story Section -->
        <section class="mb-16 md:mb-24">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Cerita Kami</h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Modern Sentra didirikan dengan visi untuk menjadi mitra terpercaya dalam menyediakan produk dan layanan industri terbaik. Sejak awal, kami berkomitmen pada kualitas, inovasi, dan kepuasan pelanggan.
                    </p>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Perjalanan kami dimulai dari [Tahun Berdiri] dengan fokus pada [Sebutkan Fokus Awal]. Seiring waktu, kami berkembang dan memperluas jangkauan produk kami untuk memenuhi permintaan pasar yang dinamis.
                    </p>
                    <p class="text-gray-600 leading-relaxed">
                        Kami bangga dengan tim kami yang berdedikasi dan terus berupaya memberikan solusi yang melebihi ekspektasi klien kami.
                    </p>
                </div>
                <div class="rounded-lg overflow-hidden shadow-lg">
                    <!-- Placeholder image - ganti dengan gambar relevan -->
                    <img src="https://via.placeholder.com/600x400/bfdbfe/1e3a8a?text=Modern+Sentra+Team" alt="Tim Modern Sentra" class="w-full h-auto object-cover">
                </div>
            </div>
        </section>

        <!-- Our Values Section -->
        <section class="mb-16 md:mb-24 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-12">Nilai-Nilai Kami</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Value 1 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300">
                    <!-- Placeholder Icon -->
                    <div class="text-blue-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Kualitas</h3>
                    <p class="text-gray-500">Menyediakan produk dan layanan dengan standar tertinggi.</p>
                </div>
                <!-- Value 2 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300">
                    <!-- Placeholder Icon -->
                    <div class="text-blue-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Inovasi</h3>
                    <p class="text-gray-500">Selalu mencari cara baru untuk meningkatkan dan memberikan solusi.</p>
                </div>
                <!-- Value 3 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300">
                    <!-- Placeholder Icon -->
                    <div class="text-blue-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Pelanggan</h3>
                    <p class="text-gray-500">Kepuasan pelanggan adalah prioritas utama kami.</p>
                </div>
                 <!-- Value 4 -->
                <div class="bg-white p-8 rounded-lg shadow-md hover:shadow-xl transition duration-300">
                    <!-- Placeholder Icon -->
                    <div class="text-blue-600 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Integritas</h3>
                    <p class="text-gray-500">Berbisnis dengan jujur, transparan, dan etis.</p>
                </div>
            </div>
        </section>

        <!-- Meet the Team Section (Placeholder) -->
        <section class="text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-12">Tim Kami</h2>
            <p class="text-gray-600 max-w-2xl mx-auto mb-8">
                Kami adalah tim profesional yang bersemangat dan berdedikasi untuk kesuksesan Anda. (Detail tim akan ditambahkan di sini).
            </p>
             <!-- Placeholder for team members -->
             <div class="flex justify-center items-center h-40 bg-gray-200 rounded-lg">
                <span class="text-gray-500">Foto & Profil Tim Segera Hadir</span>
             </div>
        </section>

    </div>
</div>

<!-- Add some basic CSS for animations (optional) -->
<style>
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-fade-in-down {
        animation: fadeInDown 0.8s ease-out forwards;
    }
    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out 0.3s forwards; /* Delay animation */
        opacity: 0; /* Start hidden */
    }
</style>

@endsection
