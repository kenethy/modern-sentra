@extends('layouts.app')

@section('title', 'Kontak Kami')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/contact-minimalist.css') }}">
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
            <div class="contact-card bg-white p-6 rounded-xl shadow-md stagger-item" style="animation-delay: 0.4s;">
                <div class="flex items-start">
                    <div class="contact-icon-container bg-[#99765c] bg-opacity-10 p-3 rounded-full mr-4 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#99765c] contact-icon" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Jam Operasional</h3>
                        <div class="text-gray-600 mb-3">
                            <div class="flex items-center mb-1">
                                <span class="font-medium w-24">Senin - Jumat:</span>
                                <span>08:00 - 17:00</span>
                            </div>
                            <div class="flex items-center mb-1">
                                <span class="font-medium w-24">Sabtu:</span>
                                <span>09:00 - 15:00</span>
                            </div>
                            <div class="flex items-center">
                                <span class="font-medium w-24">Minggu:</span>
                                <span>Tutup</span>
                            </div>
                        </div>
                        <div class="text-sm text-[#99765c] font-medium">
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full bg-green-500 mr-2"></div>
                                <span>Saat ini Buka</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form and Map Section -->
        <div class="flex flex-col lg:flex-row gap-12 mb-16">
            <!-- Contact Form -->
            <div class="lg:w-1/2 animate-on-scroll" id="contact-form">
                <div class="form-container">
                    <div class="form-content p-8">
                        <div class="flex items-center mb-6">
                            <div class="bg-[#99765c] bg-opacity-10 p-3 rounded-full mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#99765c]" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800">Kirim Pesan</h2>
                        </div>
                        <p class="text-gray-600 mb-8">Isi formulir di bawah ini untuk mengirim pesan kepada kami. Tim
                            kami akan merespons pesan Anda sesegera mungkin.</p>
                        <form action="#" method="POST" id="contactForm">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div class="relative">
                                    <input type="text" id="name" name="name" placeholder=" " required
                                        class="form-input w-full border border-gray-300 rounded-lg py-3 px-4 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-[#99765c] focus:border-transparent transition-all duration-300">
                                    <label for="name"
                                        class="form-label absolute text-gray-500 text-sm font-medium top-3 left-4 transition-all duration-300 pointer-events-none">Nama
                                        Lengkap *</label>
                                </div>

                                <div class="relative">
                                    <input type="email" id="email" name="email" placeholder=" " required
                                        class="form-input w-full border border-gray-300 rounded-lg py-3 px-4 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-[#99765c] focus:border-transparent transition-all duration-300">
                                    <label for="email"
                                        class="form-label absolute text-gray-500 text-sm font-medium top-3 left-4 transition-all duration-300 pointer-events-none">Email
                                        *</label>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div class="relative">
                                    <input type="tel" id="phone" name="phone" placeholder=" "
                                        class="form-input w-full border border-gray-300 rounded-lg py-3 px-4 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-[#99765c] focus:border-transparent transition-all duration-300">
                                    <label for="phone"
                                        class="form-label absolute text-gray-500 text-sm font-medium top-3 left-4 transition-all duration-300 pointer-events-none">Nomor
                                        Telepon</label>
                                </div>

                                <div class="relative">
                                    <input type="text" id="subject" name="subject" placeholder=" " required
                                        class="form-input w-full border border-gray-300 rounded-lg py-3 px-4 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-[#99765c] focus:border-transparent transition-all duration-300">
                                    <label for="subject"
                                        class="form-label absolute text-gray-500 text-sm font-medium top-3 left-4 transition-all duration-300 pointer-events-none">Subjek
                                        *</label>
                                </div>
                            </div>

                            <div class="mb-6 relative">
                                <textarea id="message" name="message" rows="5" placeholder=" " required
                                    class="form-input w-full border border-gray-300 rounded-lg py-3 px-4 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-[#99765c] focus:border-transparent transition-all duration-300"></textarea>
                                <label for="message"
                                    class="form-label absolute text-gray-500 text-sm font-medium top-3 left-4 transition-all duration-300 pointer-events-none">Pesan
                                    *</label>
                            </div>

                            <div class="mb-6 mt-4">
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="privacy" name="privacy" type="checkbox" required
                                            class="w-4 h-4 border border-gray-300 rounded bg-white focus:ring-3 focus:ring-[#99765c]">
                                    </div>
                                    <label for="privacy" class="ml-2 text-sm text-gray-600">
                                        Saya menyetujui <a href="#" class="text-[#99765c] hover:underline">kebijakan
                                            privasi</a> dan mengizinkan Modern Sentra untuk menghubungi saya.
                                    </label>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <button type="submit"
                                    class="bg-[#99765c] hover:bg-[#876754] text-white font-bold py-3 px-8 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 submit-button flex items-center">
                                    <span>Kirim Pesan</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </button>
                                <p class="text-sm text-gray-500">* Wajib diisi</p>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Map -->
                <div class="lg:w-1/2 animate-on-scroll" id="location">
                    <div class="map-container">
                        <div class="map-overlay"></div>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126646.19650356104!2d112.66004269849889!3d-7.4359507075784275!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e1a0848edcbf%3A0x3027a76e352bdf0!2sSidoarjo%2C%20Sidoarjo%20Regency%2C%20East%20Java!5e0!3m2!1sen!2sid!4v1650123456789!5m2!1sen!2sid"
                            allowfullscreen="" loading="lazy"></iframe>
                    </div>

                    <div class="mt-8 directions-card bg-white p-6 rounded-xl shadow-md">
                        <div class="flex items-center mb-4">
                            <div class="bg-[#99765c] bg-opacity-10 p-3 rounded-full mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#99765c]" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Cara Mencapai Kami</h3>
                        </div>
                        <div class="text-gray-600 space-y-4 pl-14">
                            <div class="flex items-start">
                                <div class="bg-blue-100 p-1 rounded-full mr-3 mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Dari Bandara Juanda:</p>
                                    <p>Sekitar 20 menit perjalanan dengan mobil melalui Jalan Tol Waru-Juanda.</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="bg-blue-100 p-1 rounded-full mr-3 mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Dari Stasiun Sidoarjo:</p>
                                    <p>Sekitar 10 menit perjalanan dengan mobil atau ojek online.</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="bg-blue-100 p-1 rounded-full mr-3 mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Transportasi Umum:</p>
                                    <p>Tersedia angkutan umum dan ojek online yang dapat mengantarkan Anda ke lokasi
                                        kami.</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 pl-14">
                            <a href="https://maps.google.com/?q={{ urlencode($contactInfo['address']) }}"
                                target="_blank"
                                class="inline-flex items-center text-[#99765c] hover:text-[#876754] font-medium">
                                <span>Buka di Google Maps</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
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
                                melalui telepon, atau datang langsung ke toko kami. Untuk pemesanan dalam jumlah besar,
                                kami
                                sarankan untuk menghubungi tim sales kami untuk mendapatkan penawaran khusus.</p>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-2">Apakah Modern Sentra menyediakan layanan
                                konsultasi untuk proyek konstruksi?</h3>
                            <p class="text-gray-600">Ya, kami memiliki tim konsultan yang berpengalaman dalam bidang
                                konstruksi. Mereka dapat membantu Anda memilih bahan bangunan yang tepat untuk proyek
                                Anda
                                dan memberikan saran teknis yang diperlukan.</p>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-2">Berapa lama waktu pengiriman untuk pesanan
                                saya?</h3>
                            <p class="text-gray-600">Waktu pengiriman tergantung pada lokasi dan ketersediaan stok.
                                Untuk
                                area Sidoarjo dan sekitarnya, pengiriman biasanya dilakukan dalam 1-2 hari kerja. Untuk
                                area
                                luar kota, pengiriman dapat memakan waktu 3-7 hari kerja.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media Section -->
            <div class="mt-16 animate-on-scroll">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Ikuti Kami</h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">Dapatkan informasi terbaru tentang produk dan
                        promo kami melalui media sosial.</p>
                </div>

                <div class="social-container bg-white p-10 rounded-xl shadow-lg">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                        <!-- Instagram -->
                        <a href="#" target="_blank" class="social-icon group">
                            <div
                                class="bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-500 p-4 rounded-xl shadow-md mb-3 transform transition-all duration-300 group-hover:scale-105 group-hover:shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white mx-auto"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-gray-800">Instagram</h3>
                            <p class="text-gray-600 text-sm">@modernsentra</p>
                        </a>

                        <!-- Facebook -->
                        <a href="#" target="_blank" class="social-icon group">
                            <div
                                class="bg-blue-600 p-4 rounded-xl shadow-md mb-3 transform transition-all duration-300 group-hover:scale-105 group-hover:shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white mx-auto"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-gray-800">Facebook</h3>
                            <p class="text-gray-600 text-sm">Modern Sentra</p>
                        </a>

                        <!-- WhatsApp -->
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('contact.whatsapp', '6281234567890')) }}"
                            target="_blank" class="social-icon group">
                            <div
                                class="bg-green-500 p-4 rounded-xl shadow-md mb-3 transform transition-all duration-300 group-hover:scale-105 group-hover:shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white mx-auto"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-gray-800">WhatsApp</h3>
                            <p class="text-gray-600 text-sm">{{ $contactInfo['phone'] }}</p>
                        </a>

                        <!-- YouTube -->
                        <a href="#" target="_blank" class="social-icon group">
                            <div
                                class="bg-red-600 p-4 rounded-xl shadow-md mb-3 transform transition-all duration-300 group-hover:scale-105 group-hover:shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white mx-auto"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                                </svg>
                            </div>
                            <h3 class="font-bold text-gray-800">YouTube</h3>
                            <p class="text-gray-600 text-sm">Modern Sentra Channel</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="{{ asset('js/contact-modern.js') }}"></script>
    @endpush

    @endsection