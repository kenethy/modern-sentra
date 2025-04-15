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
            <!-- Content will be added in steps -->
        </div>
    </div>
</div>
@endsection