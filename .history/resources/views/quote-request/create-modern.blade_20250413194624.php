@extends('layouts.app')

@section('title', 'Minta Penawaran Harga')

@push('styles')
<style>
    /* Product item styling */
    .product-item {
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .product-item:hover {
        transform: translateY(-2px);
    }

    .product-item.selected {
        border-color: #99765c;
        background-color: rgba(153, 118, 92, 0.05);
    }

    /* Form control styling */
    .form-control:focus {
        border-color: #99765c;
        box-shadow: 0 0 0 0.2rem rgba(153, 118, 92, 0.25);
    }
</style>
@endpush

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-gray-900 mb-3">Minta Penawaran Harga</h1>
            <p class="text-gray-600 max-w-3xl mx-auto">Pilih produk yang Anda minati dan isi formulir untuk mendapatkan
                penawaran harga terbaik.</p>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <form id="quoteForm" action="{{ route('quote-request.store') }}" method="POST">
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
                            <div class="h-full bg-[#99765c] w-0" id="progressBar"></div>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold text-lg"
                                id="step2Circle">2</div>
                            <span class="mt-2 text-sm font-medium text-gray-500" id="step2Text">Informasi Kontak</span>
                        </div>
                    </div>
                </div>

                <!-- Step 1: Product Selection -->
                <div id="step1" class="space-y-6">
                    <!-- Will be added in the next step -->
                </div>

                <!-- Step 2: Contact Information (hidden initially) -->
                <div id="step2" class="space-y-6 hidden">
                    <!-- Will be added in a later step -->
                </div>

                <!-- Hidden inputs for selected products -->
                <div id="selectedProductsInputs"></div>
            </form>
        </div>
    </div>
</div>
@endsection