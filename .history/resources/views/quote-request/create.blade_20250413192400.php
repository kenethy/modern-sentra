@extends('layouts.app')

@section('title', 'Minta Penawaran Harga')

@push('styles')
<style>
    /* Akan ditambahkan nanti */
</style>
@endpush

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Minta Penawaran Harga</h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Pilih produk yang Anda minati dan isi formulir di bawah
                untuk mendapatkan penawaran harga terbaik dari kami.</p>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
            <form action="{{ route('quote-request.store') }}" method="POST" id="quoteRequestForm">
                @csrf

                <!-- Step Indicator -->
                <div class="mb-8">
                    <div class="flex items-center justify-between">
                        <div class="flex flex-col items-center">
                            <div
                                class="w-10 h-10 rounded-full bg-[#99765c] text-white flex items-center justify-center font-bold text-lg">
                                1</div>
                            <span class="mt-2 text-sm font-medium text-[#99765c]">Pilih Produk</span>
                        </div>
                        <div class="flex-1 h-1 mx-4 bg-gray-200">
                            <div class="h-full bg-[#99765c] w-0" id="progressBar1"></div>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold text-lg"
                                id="step2Circle">2</div>
                            <span class="mt-2 text-sm font-medium text-gray-500" id="step2Text">Informasi Kontak</span>
                        </div>
                    </div>
                </div>

                <!-- Step 1: Product Selection -->
                <div id="step1" class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Pilih Produk</h2>

                    <!-- Product Selection will be added here -->
                </div>

                <!-- Step 2: Contact Information (hidden initially) -->
                <div id="step2" class="hidden">
                    <!-- Contact form will be added here -->
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between mt-8">
                    <button type="button" id="prevButton"
                        class="hidden px-6 py-3 bg-gray-200 text-gray-700 rounded-lg font-medium hover:bg-gray-300 transition duration-300">
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            Kembali
                        </span>
                    </button>
                    <button type="button" id="nextButton"
                        class="px-6 py-3 bg-[#99765c] text-white rounded-lg font-medium hover:bg-[#876754] transition duration-300">
                        <span class="flex items-center">
                            Lanjutkan
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </button>
                    <button type="submit" id="submitButton"
                        class="hidden px-6 py-3 bg-[#99765c] text-white rounded-lg font-medium hover:bg-[#876754] transition duration-300">
                        <span class="flex items-center">
                            Kirim Permintaan
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Akan ditambahkan nanti
</script>
@endpush