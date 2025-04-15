@extends('layouts.app')

@section('title', 'Kontak Kami')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/contact-modern.css') }}">
@endpush

@section('content')
<div class="py-16 bg-gray-50 contact-section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="contact-hero mb-16 animate-on-scroll">
            <div class="contact-hero-content py-16 px-8 md:py-24 md:px-12 text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Hubungi Kami</h1>
                <p class="text-xl text-white text-opacity-90 max-w-3xl mx-auto mb-10">Kami siap membantu Anda dengan
                    kebutuhan bahan bangunan untuk proyek Anda. Tim ahli kami siap memberikan solusi terbaik.</p>
                <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="#contact-form"
                        class="inline-flex items-center justify-center px-6 py-3 bg-white text-[#99765c] font-bold rounded-lg shadow-md hover:bg-gray-100 transition duration-300 transform hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        Kirim Pesan
                    </a>
                    <a href="#location"
                        class="inline-flex items-center justify-center px-6 py-3 bg-transparent border-2 border-white text-white font-bold rounded-lg hover:bg-white hover:text-[#99765c] transition duration-300 transform hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Lokasi Kami
                    </a>
                </div>
            </div>
        </div>

        <!-- Contact Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
            <!-- Address Card -->
            <div class="contact-card bg-white p-6 rounded-xl shadow-md stagger-item" style="animation-delay: 0.1s;">
                <div class="flex items-start">
                    <div class="contact-icon-container bg-[#99765c] bg-opacity-10 p-3 rounded-full mr-4 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#99765c] contact-icon" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Alamat</h3>
                        <p class="text-gray-600 mb-3">{{ $contactInfo['address'] }}</p>
                        <a href="https://maps.google.com/?q={{ urlencode($contactInfo['address']) }}" target="_blank"
                            class="text-sm text-[#99765c] hover:text-[#876754] inline-flex items-center">
                            <span>Lihat di Google Maps</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Phone Card -->
            <div class="contact-card bg-white p-6 rounded-xl shadow-md stagger-item" style="animation-delay: 0.2s;">
                <div class="flex items-start">
                    <div class="contact-icon-container bg-[#99765c] bg-opacity-10 p-3 rounded-full mr-4 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#99765c] contact-icon" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Telepon</h3>
                        <p class="text-gray-600 mb-3">{{ $contactInfo['phone'] }}</p>
                        <button type="button"
                            class="copy-button text-sm text-[#99765c] hover:text-[#876754] inline-flex items-center"
                            data-copy="{{ $contactInfo['phone'] }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            <span>Salin Nomor</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Email Card -->
            <div class="contact-card bg-white p-6 rounded-xl shadow-md stagger-item" style="animation-delay: 0.3s;">
                <div class="flex items-start">
                    <div class="contact-icon-container bg-[#99765c] bg-opacity-10 p-3 rounded-full mr-4 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#99765c] contact-icon" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Email</h3>
                        <p class="text-gray-600 mb-3">{{ $contactInfo['email'] }}</p>
                        <div class="flex space-x-2">
                            <a href="mailto:{{ $contactInfo['email'] }}"
                                class="text-sm text-[#99765c] hover:text-[#876754] inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span>Kirim Email</span>
                            </a>
                            <button type="button"
                                class="copy-button text-sm text-[#99765c] hover:text-[#876754] inline-flex items-center"
                                data-copy="{{ $contactInfo['email'] }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                </svg>
                                <span>Salin</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hours Card -->
            <div class="contact-card bg-white p-6 rounded-xl shadow-md animate-on-scroll"
                style="animation-delay: 0.3s;">
                <div class="flex items-center mb-4">
                    <div class="bg-[#99765c] bg-opacity-10 p-3 rounded-full mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#99765c] contact-icon" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Jam Operasional</h3>
                        <p class="text-gray-600">{{ $contactInfo['hours'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form and Map Section -->
        <div class="flex flex-col lg:flex-row gap-12 mb-16">
            <!-- Contact Form -->
            <div class="lg:w-1/2 animate-on-scroll">
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Kirim Pesan</h2>
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label for="name" class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                            <input type="text" id="name" name="name"
                                class="w-full border-gray-300 rounded-lg py-3 px-4 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-[#99765c] focus:border-transparent form-input"
                                required>
                        </div>

                        <div class="mb-6">
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                            <input type="email" id="email" name="email"
                                class="w-full border-gray-300 rounded-lg py-3 px-4 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-[#99765c] focus:border-transparent form-input"
                                required>
                        </div>

                        <div class="mb-6">
                            <label for="phone" class="block text-gray-700 font-medium mb-2">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone"
                                class="w-full border-gray-300 rounded-lg py-3 px-4 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-[#99765c] focus:border-transparent form-input">
                        </div>

                        <div class="mb-6">
                            <label for="subject" class="block text-gray-700 font-medium mb-2">Subjek</label>
                            <input type="text" id="subject" name="subject"
                                class="w-full border-gray-300 rounded-lg py-3 px-4 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-[#99765c] focus:border-transparent form-input"
                                required>
                        </div>

                        <div class="mb-6">
                            <label for="message" class="block text-gray-700 font-medium mb-2">Pesan</label>
                            <textarea id="message" name="message" rows="5"
                                class="w-full border-gray-300 rounded-lg py-3 px-4 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-[#99765c] focus:border-transparent form-input"
                                required></textarea>
                        </div>

                        <div>
                            <button type="submit"
                                class="bg-[#99765c] hover:bg-[#876754] text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 submit-button">
                                Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Map -->
            <div class="lg:w-1/2 animate-on-scroll">
                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126646.19650356104!2d112.66004269849889!3d-7.4359507075784275!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e1a0848edcbf%3A0x3027a76e352bdf0!2sSidoarjo%2C%20Sidoarjo%20Regency%2C%20East%20Java!5e0!3m2!1sen!2sid!4v1650123456789!5m2!1sen!2sid"
                        allowfullscreen="" loading="lazy"></iframe>
                </div>

                <div class="mt-8 bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Cara Mencapai Kami</h3>
                    <div class="text-gray-600 space-y-4">
                        <p><span class="font-medium">Dari Bandara Juanda:</span> Sekitar 20 menit perjalanan dengan
                            mobil melalui Jalan Tol Waru-Juanda.</p>
                        <p><span class="font-medium">Dari Stasiun Sidoarjo:</span> Sekitar 10 menit perjalanan dengan
                            mobil atau ojek online.</p>
                        <p><span class="font-medium">Transportasi Umum:</span> Tersedia angkutan umum dan ojek online
                            yang dapat mengantarkan Anda ke lokasi kami.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="animate-on-scroll">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Pertanyaan Umum</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">Berikut adalah beberapa pertanyaan yang sering
                    ditanyakan oleh pelanggan kami.</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="divide-y divide-gray-200">
                    <!-- FAQ Item 1 -->
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Apakah Modern Sentra melayani pengiriman ke
                            luar kota?</h3>
                        <p class="text-gray-600">Ya, kami melayani pengiriman ke berbagai kota di Indonesia. Biaya
                            pengiriman akan dihitung berdasarkan berat, volume, dan jarak pengiriman.</p>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Bagaimana cara memesan produk dari Modern
                            Sentra?</h3>
                        <p class="text-gray-600">Anda dapat memesan produk melalui website kami, menghubungi kami
                            melalui telepon, atau datang langsung ke toko kami. Untuk pemesanan dalam jumlah besar, kami
                            sarankan untuk menghubungi tim sales kami untuk mendapatkan penawaran khusus.</p>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Apakah Modern Sentra menyediakan layanan
                            konsultasi untuk proyek konstruksi?</h3>
                        <p class="text-gray-600">Ya, kami memiliki tim konsultan yang berpengalaman dalam bidang
                            konstruksi. Mereka dapat membantu Anda memilih bahan bangunan yang tepat untuk proyek Anda
                            dan memberikan saran teknis yang diperlukan.</p>
                    </div>

                    <!-- FAQ Item 4 -->
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Berapa lama waktu pengiriman untuk pesanan
                            saya?</h3>
                        <p class="text-gray-600">Waktu pengiriman tergantung pada lokasi dan ketersediaan stok. Untuk
                            area Sidoarjo dan sekitarnya, pengiriman biasanya dilakukan dalam 1-2 hari kerja. Untuk area
                            luar kota, pengiriman dapat memakan waktu 3-7 hari kerja.</p>
                    </div>
                </div>
            </div>
        </div>
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