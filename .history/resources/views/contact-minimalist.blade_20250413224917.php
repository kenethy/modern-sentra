@extends('layouts.app')

@section('title', 'Kontak Kami')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/contact-minimalist.css') }}">
@endpush

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Section - Minimalist -->
        <div class="contact-hero mb-10 fade-in">
            <div class="py-10 px-6 md:py-12 md:px-10 text-center">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 construction-heading">HUBUNGI KAMI</h1>
                <p class="text-lg text-white text-opacity-90 max-w-2xl mx-auto mb-6">Kami siap membantu Anda dengan
                    kebutuhan bahan bangunan untuk proyek Anda.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="#contact-form"
                        class="inline-flex items-center justify-center px-5 py-2 bg-white text-[#99765c] font-medium rounded-md hover:bg-gray-100 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 flex-shrink-0" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        <span>Kirim Pesan</span>
                    </a>
                    <a href="#location"
                        class="inline-flex items-center justify-center px-5 py-2 bg-transparent border border-white text-white font-medium rounded-md hover:bg-white hover:text-[#99765c] transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 flex-shrink-0" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Lokasi Kami</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Contact Info Cards - Minimalist -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
            <!-- Address Card -->
            <div class="contact-card p-5 fade-in delay-1">
                <div class="flex items-start">
                    <div class="bg-[#d17a46] bg-opacity-10 p-2 rounded-full mr-3 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 contact-icon text-[#d17a46]" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-gray-800 mb-1">Alamat</h3>
                        <p class="text-sm text-gray-600 mb-2">{{ $contactInfo['address'] }}</p>
                        <a href="https://www.google.com/maps/place/Toko+Sentra+Baja/@-7.431057676130338,112.67986385757835,17z/"
                            target="_blank"
                            class="text-xs text-[#d17a46] hover:text-[#e6a585] inline-flex items-center">
                            <span>Lihat di Maps</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Phone Card -->
            <div class="contact-card p-5 fade-in delay-2">
                <div class="flex items-start">
                    <div class="bg-[#4a6741] bg-opacity-10 p-2 rounded-full mr-3 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 contact-icon text-[#4a6741]" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-gray-800 mb-1">Telepon</h3>
                        <p class="text-sm text-gray-600 mb-2">{{ $contactInfo['phone'] }}</p>
                        <button type="button"
                            class="copy-button text-xs text-[#4a6741] hover:text-[#6b8a61] inline-flex items-center"
                            data-copy="{{ $contactInfo['phone'] }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                            <span>Salin</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Email Card -->
            <div class="contact-card p-5 fade-in delay-3">
                <div class="flex items-start">
                    <div class="bg-[#486683] bg-opacity-10 p-2 rounded-full mr-3 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 contact-icon text-[#486683]" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-gray-800 mb-1">Email</h3>
                        <p class="text-sm text-gray-600 mb-2">{{ $contactInfo['email'] }}</p>
                        <a href="mailto:{{ $contactInfo['email'] }}"
                            class="text-xs text-[#99765c] hover:text-[#876754] inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                            <span>Kirim Email</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Hours Card -->
            <div class="contact-card p-5 fade-in delay-4">
                <div class="flex items-start">
                    <div class="bg-[#99765c] bg-opacity-10 p-2 rounded-full mr-3 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 contact-icon text-[#99765c]" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-gray-800 mb-1">Jam Operasional</h3>
                        <p class="text-sm text-gray-600">Senin - Jumat: 08:00 - 17:00</p>
                        <p class="text-sm text-gray-600">Sabtu: 09:00 - 15:00</p>
                        <p class="text-sm text-gray-600">Minggu: Tutup</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <!-- Contact Form -->
            <div id="contact-form" class="fade-in delay-1 contact-column">
                <div class="form-container bg-white p-6 rounded-md shadow-sm">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 construction-heading">KIRIM PESAN</h2>

                    <form id="contactForm" class="flex-grow flex flex-col" onsubmit="sendWhatsAppMessage(event)">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 form-grid">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap
                                    *</label>
                                <input type="text" id="name" name="name" required
                                    class="form-input w-full border border-gray-300 rounded-md py-2 px-3 text-sm focus:outline-none">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                                <input type="email" id="email" name="email" required
                                    class="form-input w-full border border-gray-300 rounded-md py-2 px-3 text-sm focus:outline-none">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 form-grid">
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor
                                    Telepon</label>
                                <input type="tel" id="phone" name="phone"
                                    class="form-input w-full border border-gray-300 rounded-md py-2 px-3 text-sm focus:outline-none">
                            </div>

                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subjek
                                    *</label>
                                <input type="text" id="subject" name="subject" required
                                    class="form-input w-full border border-gray-300 rounded-md py-2 px-3 text-sm focus:outline-none">
                            </div>
                        </div>

                        <div class="mb-4 flex-grow">
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Pesan *</label>
                            <textarea id="message" name="message" rows="8" required
                                class="form-input w-full border border-gray-300 rounded-md py-2 px-3 text-sm focus:outline-none h-full min-h-[150px]"></textarea>
                        </div>

                        <div class="mb-6">
                            <div class="flex items-start mt-4">
                                <div class="flex items-center h-5">
                                    <input id="privacy" name="privacy" type="checkbox" required
                                        class="w-4 h-4 border border-gray-300 rounded">
                                </div>
                                <label for="privacy" class="ml-2 text-xs text-gray-600">
                                    Saya menyetujui kebijakan privasi dan mengizinkan Modern Sentra untuk menghubungi
                                    saya.
                                </label>
                            </div>
                        </div>

                        <div class="mt-auto flex gap-3">

                            <button type="button" onclick="sendWhatsAppMessage(event, true)"
                                class="whatsapp-button flex-1 bg-[#25D366] hover:bg-[#128C7E] text-white font-medium py-2 px-4 rounded-md transition duration-300 inline-flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5 flex-shrink-0"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                </svg>
                                <span>Kirim via WhatsApp</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Map -->
            <div id="location" class="fade-in delay-2 contact-column">
                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1305.0661298865157!2d112.67986385757835!3d-7.431057676130338!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e3d87525c543%3A0xc63d761c99a4348a!2sToko%20Sentra%20Baja!5e1!3m2!1sid!2sid!4v1744558115332!5m2!1sid!2sid"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <div class="mt-4 bg-white p-5 rounded-md shadow-sm flex-grow">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-800 construction-heading">CARA MENCAPAI KAMI</h3>
                        <a href="https://www.google.com/maps/place/Toko+Sentra+Baja/@-7.431057676130338,112.67986385757835,17z/"
                            target="_blank"
                            class="inline-flex items-center justify-center text-sm font-medium text-[#99765c] hover:text-[#876754]">
                            <span>Lihat di Google Maps</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1.5 flex-shrink-0" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </div>
                    <ul class="text-sm text-gray-600 space-y-4">
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-[#99765c] mr-3 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                            <div>
                                <p class="font-medium text-base mb-1">Dari Bandara Juanda:</p>
                                <p>Sekitar 30 menit perjalanan dengan mobil melalui Jalan Tol Waru-Juanda.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-[#99765c] mr-3 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                            <div>
                                <p class="font-medium text-base mb-1">Dari Stasiun Sidoarjo:</p>
                                <p>Sekitar 10 menit perjalanan dengan mobil atau ojek online.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-[#99765c] mr-3 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                            <div>
                                <p class="font-medium text-base mb-1">Transportasi Umum:</p>
                                <p>Tersedia angkutan umum dan ojek online yang dapat mengantarkan Anda ke lokasi kami.
                                </p>
                            </div>
                        </li>
                    </ul>
                    <div class="mt-6 pt-4 border-t border-gray-100">
                        <p class="text-sm text-gray-500 mb-2">Jam Operasional:</p>
                        <p class="text-sm"><span class="font-medium">Senin - Jumat:</span> 08:00 - 17:00</p>
                        <p class="text-sm"><span class="font-medium">Sabtu:</span> 09:00 - 15:00</p>
                        <p class="text-sm"><span class="font-medium">Minggu:</span> Tutup</p>

                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <a href="https://www.google.com/maps/dir//Toko+Sentra+Baja/@-7.431057676130338,112.67986385757835,17z/"
                                target="_blank"
                                class="inline-flex items-center justify-center px-4 py-2 bg-[#99765c] text-white text-sm font-medium rounded-md hover:bg-[#876754] transition duration-300 w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 flex-shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Dapatkan Petunjuk Arah</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Media - Minimalist -->
        <div class="mb-10 fade-in delay-3">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center construction-heading">IKUTI KAMI</h2>

            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 social-grid">
                <!-- Instagram -->
                <a href="#" target="_blank"
                    class="social-icon bg-white p-4 rounded-md shadow-sm text-center hover:shadow-md transition duration-300">
                    <div
                        class="bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-500 p-2 rounded-full w-10 h-10 mx-auto mb-2 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium text-gray-800">Instagram</h3>
                </a>

                <!-- Facebook -->
                <a href="#" target="_blank"
                    class="social-icon bg-white p-4 rounded-md shadow-sm text-center hover:shadow-md transition duration-300">
                    <div class="bg-blue-600 p-2 rounded-full w-10 h-10 mx-auto mb-2 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium text-gray-800">Facebook</h3>
                </a>

                <!-- Email -->
                <a href="mailto:{{ $contactInfo['email'] }}" target="_blank"
                    class="social-icon bg-white p-4 rounded-md shadow-sm text-center hover:shadow-md transition duration-300">
                    <div class="bg-[#99765c] p-2 rounded-full w-10 h-10 mx-auto mb-2 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium text-gray-800">Email</h3>
                </a>

                <!-- WhatsApp -->
                <a href="https://wa.me/+6287752895532" target="_blank"
                    class="social-icon bg-white p-4 rounded-md shadow-sm text-center hover:shadow-md transition duration-300">
                    <div class="bg-green-500 p-2 rounded-full w-10 h-10 mx-auto mb-2 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium text-gray-800">WhatsApp</h3>
                </a>

                <!-- YouTube -->
                <a href="#" target="_blank"
                    class="social-icon bg-white p-4 rounded-md shadow-sm text-center hover:shadow-md transition duration-300">
                    <div class="bg-red-600 p-2 rounded-full w-10 h-10 mx-auto mb-2 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium text-gray-800">YouTube</h3>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/contact-minimalist.js') }}"></script>
@endpush