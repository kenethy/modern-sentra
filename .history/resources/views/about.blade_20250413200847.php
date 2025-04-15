@extends('layouts.app')

@section('title', 'Tentang Kami - Modern Sentra')

{{-- Kosongkan header default jika layout Anda memilikinya --}}
@section('header')
@endsection

@push('styles')
<style>
    /* Optional: Smooth scroll behavior */
    html {
        scroll-behavior: smooth;
    }

    /* Styling for timeline line and dots */
    .timeline-line::before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 1.5rem; /* Adjust based on icon size */
        width: 3px;
        background-color: #e5e7eb; /* gray-200 */
        z-index: 0;
    }
    .timeline-dot {
        position: absolute;
        left: 1.5rem; /* Center align with line */
        top: 0.5rem; /* Adjust vertical alignment */
        transform: translateX(-50%);
        z-index: 1;
    }

    /* Animation */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeInUp {
        animation: fadeInUp 0.8s ease-out forwards;
        opacity: 0; /* Start hidden */
    }
    /* Staggered animation delay helper */
    .delay-100 { animation-delay: 0.1s; }
    .delay-200 { animation-delay: 0.2s; }
    .delay-300 { animation-delay: 0.3s; }
    .delay-400 { animation-delay: 0.4s; }
    .delay-500 { animation-delay: 0.5s; }
    .delay-600 { animation-delay: 0.6s; }

    /* Gradient Text */
    .gradient-text {
        background: linear-gradient(to right, #99765c, #b59a84); /* Primary brown gradient */
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

</style>
@endpush

@section('content')

{{-- 1. Modern Hero Section --}}
<section class="relative bg-gradient-to-b from-slate-50 to-white pt-24 pb-16 md:pt-32 md:pb-24 text-center overflow-hidden">
    <div class="container mx-auto px-6 relative z-10">
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold mb-5 leading-tight text-slate-900 animate-fadeInUp">
            Tentang <span class="gradient-text">Modern Sentra</span>
        </h1>
        <p class="text-lg md:text-xl text-slate-600 max-w-3xl mx-auto mb-10 animate-fadeInUp delay-100">
            Kami adalah partner terpercaya Anda dalam menyediakan material konstruksi berkualitas tinggi untuk membangun masa depan yang kokoh dan berkelanjutan.
        </p>
        <a href="#our-story"
           class="inline-flex items-center bg-[#99765c] hover:bg-[#876754] text-white font-semibold py-3 px-8 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-[#99765c] focus:ring-offset-2 animate-fadeInUp delay-200">
           Lihat Perjalanan Kami
           {{-- Heroicon: ArrowDownIcon --}}
           <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
             <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
           </svg>
        </a>
    </div>
    {{-- Optional: Subtle background elements --}}
    <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-white via-white/80 to-transparent z-0"></div>
</section>

{{-- Main Content Area --}}
<div class="py-16 sm:py-20 bg-white">
    <div class="container mx-auto px-6 space-y-20 sm:space-y-24 lg:space-y-32">

        {{-- 2. Our Story / History Section --}}
        <section id="our-story" class="scroll-mt-20" data-observe> {{-- scroll-mt for anchor link offset --}}
             <div class="text-center mb-12 md:mb-16 animate-fadeInUp">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-3 relative inline-block">
                    Cerita Kami
                    <span class="absolute bottom-[-8px] left-1/2 transform -translate-x-1/2 w-16 h-1 bg-[#99765c] rounded-full"></span>
                </h2>
                 <p class="text-base sm:text-lg text-slate-600 max-w-3xl mx-auto mt-8">
                     Perjalanan kami dalam membangun Modern Sentra menjadi supplier bahan bangunan terpercaya.
                 </p>
            </div>

            {{-- History Overview --}}
            <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-12 mb-16">
                <div class="lg:w-1/2 order-2 lg:order-1 animate-fadeInUp delay-100">
                    <h3 class="text-2xl font-semibold text-slate-800 mb-4">Awal Mula dan Pertumbuhan</h3>
                    <div class="text-slate-600 space-y-4 leading-relaxed text-base md:text-lg prose max-w-none">
                        {!! nl2br(e($history ?? 'Modern Sentra dimulai dengan visi sederhana: menyediakan material bangunan berkualitas dengan layanan pelanggan yang tak tertandingi. Berdiri sejak [Tahun Berdiri], kami memulai sebagai toko kecil di [Lokasi Awal] dan secara bertahap berkembang berkat kepercayaan pelanggan dan dedikasi tim kami. Kami terus beradaptasi dengan kebutuhan pasar, memperluas jangkauan produk dan layanan kami untuk mendukung berbagai skala proyek konstruksi.')) !!}
                    </div>
                </div>
                <div class="lg:w-1/2 order-1 lg:order-2 animate-fadeInUp delay-200">
                    <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80"
                         alt="Sejarah Perusahaan Modern Sentra"
                         class="rounded-xl shadow-lg w-full h-auto object-cover aspect-video lg:aspect-square transition duration-500 hover:scale-102 hover:shadow-xl">
                </div>
            </div>

            {{-- 3. Modern Timeline Section --}}
            <div class="relative pt-8 animate-fadeInUp delay-300">
                 <h3 class="text-2xl font-semibold text-slate-800 mb-10 text-center">Tonggak Pencapaian Kami</h3>
                 <div class="relative timeline-line space-y-12">
                     {{-- Timeline Item 1 --}}
                     @php
                         $timelineItems = [
                             ['year' => '2010', 'icon' => 'M19.75 14.5v6a1.75 1.75 0 01-1.75 1.75h-12A1.75 1.75 0 014.25 20.5v-6H1.75a.75.75 0 010-1.5h2.5V7A1.75 1.75 0 016 5.25h12A1.75 1.75 0 0121.75 7v6h-2zm-16-1.5h14V7a.25.25 0 00-.25-.25H6a.25.25 0 00-.25.25v6zm14 1.5v5.25a.25.25 0 00.25.25h.5a.25.25 0 00.25-.25v-5.25h-1zM6 20.5a.25.25 0 00.25-.25v-5.25h11.5v5.25a.25.25 0 00.25.25h.5a.25.25 0 00.25-.25v-5.25H6z', 'description' => 'Modern Sentra didirikan sebagai toko bahan bangunan kecil di Jakarta dengan fokus pada kualitas produk dan layanan pelanggan.'],
                             ['year' => '2013', 'icon' => 'M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h6M9 11.25h6m-6 4.5h6M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'description' => 'Ekspansi bisnis dengan membuka cabang kedua dan memperluas jangkauan produk untuk memenuhi kebutuhan proyek konstruksi yang lebih besar.'],
                             ['year' => '2016', 'icon' => 'M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666l.034-.163M7.5 14.25l-2.223 2.223a3 3 0 004.242 4.242l2.223-2.223M1.65 1.65l1.78 1.78m1.828 1.828a10.506 10.506 0 003.732 3.732m5.823 1.158a10.477 10.477 0 01-5.823-1.158m5.823 1.158l1.78 1.78m1.828 1.828l-1.78-1.78m-1.828-1.828a10.5 10.5 0 013.732-3.732M14.25 7.5l2.223-2.223a3 3 0 00-4.242-4.242L10.03 3.255M1.65 1.65a9.094 9.094 0 013.741.479 3 3 0 014.682 2.72m-.94-3.198l-.001-.031c0-.225.012-.447.037-.666l-.034.163z', 'description' => 'Meluncurkan layanan konsultasi profesional untuk membantu klien memilih bahan bangunan yang tepat untuk proyek mereka.'],
                             ['year' => '2019', 'icon' => 'M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125V14.25m-17.25 4.5h12.75m-12.75 0V6.75A2.25 2.25 0 013.375 4.5h9.375a3.75 3.75 0 013.75 3.75V13.5m1.125 5.25h-1.125m0 0V8.25a3.75 3.75 0 00-3.75-3.75h-9.375A2.25 2.25 0 001.5 6.75v11.25m15-4.875a.75.75 0 00.75-.75V6.75a.75.75 0 00-.75-.75h-.75a.75.75 0 00-.75.75v7.5a.75.75 0 00.75.75h.75z', 'description' => 'Menjadi distributor resmi untuk beberapa merek bahan bangunan terkemuka dan memperluas jangkauan distribusi.'],
                             ['year' => '2022', 'icon' => 'M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3', 'description' => 'Meluncurkan platform digital untuk mempermudah pelanggan memesan produk dan berkonsultasi secara online.'],
                             ['year' => 'Sekarang', 'icon' => 'M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.517l2.74-1.22m0 0l-5.94-2.28a11.95 11.95 0 00-5.814 5.517L9 18.75l-6.75-6.75', 'description' => 'Terus berinovasi dan berkembang untuk menjadi supplier bahan bangunan terdepan dengan komitmen pada kualitas dan kepuasan pelanggan.']
                         ];
                     @endphp

                     @foreach ($timelineItems as $item)
                     <div class="relative pl-12 md:pl-16 pb-8">
                         <div class="timeline-dot w-8 h-8 bg-[#99765c] text-white rounded-full flex items-center justify-center ring-4 ring-white shadow">
                             {{-- Heroicon matching the year's theme (simplified) --}}
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"> <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}" /> </svg>
                         </div>
                         <div class="ml-4 p-6 bg-slate-50 rounded-lg border border-slate-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                             <span class="absolute -left-4 top-5 text-sm font-semibold text-white bg-[#a3856e] px-2 py-0.5 rounded shadow">
                                 {{ $item['year'] }}
                             </span>
                             <p class="text-slate-700 leading-relaxed">{{ $item['description'] }}</p>
                         </div>
                     </div>
                     @endforeach
                 </div>
             </div>
        </section>

        {{-- 4. Vision & Mission Section --}}
        <section data-observe>
             <div class="text-center mb-12 md:mb-16 animate-fadeInUp delay-100">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-3 relative inline-block">
                    Visi & Misi Kami
                     <span class="absolute bottom-[-8px] left-1/2 transform -translate-x-1/2 w-16 h-1 bg-[#99765c] rounded-full"></span>
                </h2>
                <p class="text-base sm:text-lg text-slate-600 max-w-3xl mx-auto mt-8">
                     Landasan dan arah tujuan Modern Sentra.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
                {{-- Vision Card --}}
                <div class="bg-white p-8 rounded-xl shadow-lg border border-slate-100 hover:shadow-xl transition-all duration-300 animate-fadeInUp delay-200">
                    <div class="flex flex-col sm:flex-row items-center text-center sm:text-left mb-5">
                        <div class="flex-shrink-0 bg-gradient-to-br from-[#99765c] to-[#b59a84] p-4 rounded-full mb-4 sm:mb-0 sm:mr-5 text-white shadow-md">
                            {{-- Heroicon: EyeIcon --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-slate-800">Visi</h3>
                    </div>
                    <p class="text-slate-600 text-base md:text-lg leading-relaxed">
                        {{ $vision ?? 'Menjadi supplier bahan bangunan terdepan dan terpercaya di Indonesia, dikenal karena kualitas produk, inovasi layanan, dan kontribusi positif bagi pembangunan nasional.' }}
                    </p>
                </div>

                {{-- Mission Card --}}
                 <div class="bg-white p-8 rounded-xl shadow-lg border border-slate-100 hover:shadow-xl transition-all duration-300 animate-fadeInUp delay-300">
                    <div class="flex flex-col sm:flex-row items-center text-center sm:text-left mb-5">
                        <div class="flex-shrink-0 bg-gradient-to-br from-[#99765c] to-[#b59a84] p-4 rounded-full mb-4 sm:mb-0 sm:mr-5 text-white shadow-md">
                             {{-- Heroicon: RocketLaunchIcon --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899l4-4a4 4 0 005.656 5.656l-1.1 1.1" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 8.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM6 12a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm.75 4.5a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm6.75-6a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-semibold text-slate-800">Misi</h3>
                    </div>
                     <ul class="text-slate-600 text-base md:text-lg leading-relaxed list-disc list-inside space-y-2">
                         {{-- Assume $mission is plain text with newlines for list items --}}
                         @php
                             $missions = preg_split('/\r\n|\r|\n/', $mission ?? "Menyediakan produk bahan bangunan berkualitas tinggi.\nMemberikan layanan pelanggan yang responsif dan solutif.\nMembangun kemitraan yang kuat dengan pemasok dan pelanggan.\nTerus berinovasi dalam produk dan layanan.\nBerkontribusi pada pembangunan yang berkelanjutan.");
                         @endphp
                         @foreach($missions as $m)
                             <li>{{ trim($m) }}</li>
                         @endforeach
                    </ul>
                </div>
            </div>
        </section>

        {{-- 5. Team Section --}}
        <section data-observe>
            <div class="text-center mb-12 md:mb-16 animate-fadeInUp delay-100">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-3 relative inline-block">
                    Tim Profesional Kami
                    <span class="absolute bottom-[-8px] left-1/2 transform -translate-x-1/2 w-16 h-1 bg-[#99765c] rounded-full"></span>
                </h2>
                <p class="text-base sm:text-lg text-slate-600 max-w-3xl mx-auto mt-8">
                    Kenali individu-individu berdedikasi di balik kesuksesan Modern Sentra.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    // Dummy team data - replace with your actual $team variable
                    $team = $team ?? [
                        ['name' => 'Budi Santoso', 'position' => 'Founder & CEO', 'photo' => 'https://via.placeholder.com/400x450/cccccc/888888?text=Team+1', 'social' => ['linkedin' => '#', 'twitter' => '#']],
                        ['name' => 'Citra Lestari', 'position' => 'Head of Sales', 'photo' => 'https://via.placeholder.com/400x450/cccccc/888888?text=Team+2', 'social' => ['linkedin' => '#']],
                        ['name' => 'Agus Setiawan', 'position' => 'Operations Manager', 'photo' => 'https://via.placeholder.com/400x450/cccccc/888888?text=Team+3', 'social' => ['linkedin' => '#', 'facebook' => '#']],
                    ];
                @endphp
                @foreach($team as $index => $member)
                <div class="group bg-white rounded-xl overflow-hidden shadow-md border border-slate-100 hover:shadow-xl transition-all duration-300 text-center animate-fadeInUp" style="animation-delay: {{ ($index + 2) * 0.1 }}s;">
                    <div class="relative">
                        <img src="{{ $member['photo'] }}" alt="Foto {{ $member['name'] }}" class="w-full h-80 object-cover transition duration-500 group-hover:scale-105">
                         {{-- Subtle overlay on hover --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-slate-800 mb-1">{{ $member['name'] }}</h3>
                        <p class="text-[#99765c] font-medium mb-4">{{ $member['position'] }}</p>
                        {{-- Social Links --}}
                        @if(!empty($member['social']))
                        <div class="flex justify-center space-x-3">
                             @foreach($member['social'] as $platform => $link)
                                <a href="{{ $link }}" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-[#99765c] transition-colors duration-200">
                                    <span class="sr-only">{{ ucfirst($platform) }}</span>
                                     @if($platform == 'linkedin')
                                         {{-- Heroicon: adjusted simple linkedin --}}
                                         <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"> <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/> </svg>
                                     @elseif($platform == 'twitter' || $platform == 'x')
                                         {{-- Heroicon: adjusted simple twitter/x --}}
                                          <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"> <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/> </svg>
                                     @elseif($platform == 'facebook')
                                         {{-- Heroicon: adjusted simple facebook --}}
                                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"> <path d="M22.675 0h-21.35C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.593 1.323-1.325V1.325C24 .593 23.407 0 22.675 0z"/> </svg>
                                     @endif
                                </a>
                             @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        {{-- 6. Stats Section --}}
        <section data-observe>
            <div class="text-center mb-12 md:mb-16 animate-fadeInUp delay-100">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-3 relative inline-block">
                    Modern Sentra Dalam Angka
                    <span class="absolute bottom-[-8px] left-1/2 transform -translate-x-1/2 w-16 h-1 bg-[#99765c] rounded-full"></span>
                </h2>
                <p class="text-base sm:text-lg text-slate-600 max-w-3xl mx-auto mt-8">
                     Pencapaian dan skala operasi kami yang terus berkembang.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                @php
                    $stats = [
                        ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'value' => '5.000+', 'label' => 'Pelanggan Puas'],
                        ['icon' => 'M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'value' => '1.200+', 'label' => 'Proyek Terselesaikan'],
                        ['icon' => 'M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h6M9 11.25h6m-6 4.5h6M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'value' => '50+', 'label' => 'Merek Partner'],
                        ['icon' => 'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z', 'value' => '12+', 'label' => 'Tahun Pengalaman'],
                    ];
                @endphp
                @foreach ($stats as $index => $stat)
                <div class="bg-gradient-to-br from-stone-50 to-stone-100 p-6 rounded-xl border border-stone-200 text-center shadow-sm hover:shadow-lg hover:scale-[1.02] transition-all duration-300 animate-fadeInUp" style="animation-delay: {{ ($index + 2) * 0.1 }}s;">
                    <div class="bg-gradient-to-br from-[#99765c] to-[#b59a84] rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-5 text-white shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}" />
                        </svg>
                    </div>
                    <p class="text-4xl font-bold text-[#876754] mb-1">{{ $stat['value'] }}</p>
                    <p class="text-slate-600 font-medium">{{ $stat['label'] }}</p>
                </div>
                @endforeach
            </div>
        </section>

        {{-- 7. CTA Section (Themed) --}}
        <section data-observe>
            <div class="bg-gradient-to-r from-[#99765c] to-[#7d5e48] rounded-2xl overflow-hidden shadow-xl animate-fadeInUp delay-200">
                <div class="px-8 py-12 md:p-16 lg:flex lg:items-center lg:justify-between">
                    <div class="lg:w-0 lg:flex-1 mb-10 lg:mb-0 text-center lg:text-left">
                        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 leading-tight">Siap Membangun Bersama Kami?</h2>
                        <p class="text-[#f5f2ef] text-lg mb-8 max-w-2xl mx-auto lg:mx-0">
                            Hubungi tim ahli kami hari ini untuk konsultasi, penawaran harga, atau informasi lebih lanjut mengenai produk dan layanan Modern Sentra.
                        </p>
                        <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                            <a href="/contact" {{-- Use route('contact') --}}
                               class="inline-flex items-center justify-center bg-white text-[#876754] hover:bg-gray-100 font-semibold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#99765c] w-full sm:w-auto">
                                {{-- Heroicon: PhoneIcon --}}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                Hubungi Kami
                            </a>
                            <a href="/products" {{-- Use route('products.index') --}}
                               class="inline-flex items-center justify-center bg-transparent border-2 border-[#f5f2ef]/50 hover:border-white text-white hover:bg-white/10 font-semibold py-3 px-6 rounded-lg transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#99765c] w-full sm:w-auto">
                               {{-- Heroicon: BuildingStorefrontIcon --}}
                               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                               </svg>
                                Lihat Produk
                            </a>
                        </div>
                    </div>
                     <div class="hidden lg:flex lg:w-1/3 flex-shrink-0 mt-10 lg:mt-0 lg:ml-12 justify-center">
                         {{-- Icon representing consultation or partnership --}}
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-48 w-48 text-white/30" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                         </svg>
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
            root: null,
            rootMargin: '0px',
            threshold: 0.15 // Trigger animation slightly earlier/later if needed
        };

        const observerCallback = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = entry.target;
                    // Find animatable children within the observed section
                    const elementsToAnimate = target.querySelectorAll('.animate-fadeInUp');
                    if (elementsToAnimate.length > 0) {
                        elementsToAnimate.forEach(el => {
                            if (el.style.opacity !== '1') { // Check if not already animated
                                el.style.opacity = '1';
                                el.style.animationPlayState = 'running';
                            }
                        });
                    } else if (target.classList.contains('animate-fadeInUp')) {
                         // If the observed element itself should animate
                         if (target.style.opacity !== '1') {
                            target.style.opacity = '1';
                            target.style.animationPlayState = 'running';
                         }
                    }
                    // Optional: Unobserve after first animation
                    // observer.unobserve(target);
                }
            });
        };

        const intersectionObserver = new IntersectionObserver(observerCallback, observerOptions);

        // Target sections or elements that trigger animations
        document.querySelectorAll('[data-observe], .animate-fadeInUp').forEach(el => {
            // Initially hide elements and pause animation
             const elementsToAnimate = el.querySelectorAll('.animate-fadeInUp');
             if (elementsToAnimate.length > 0) {
                 elementsToAnimate.forEach(animEl => {
                    animEl.style.opacity = '0';
                    animEl.style.animationPlayState = 'paused';
                 });
             } else if (el.classList.contains('animate-fadeInUp')) {
                 el.style.opacity = '0';
                 el.style.animationPlayState = 'paused';
             }
            intersectionObserver.observe(el);
        });

         // Force hero animation on load without observing
         document.querySelectorAll('section.relative .animate-fadeInUp').forEach(el => {
            el.style.opacity = '1';
            el.style.animationPlayState = 'running';
         });

    });
</script>
@endpush