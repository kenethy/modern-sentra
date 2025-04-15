@extends('layouts.app')

@section('title', 'Minta Penawaran Harga')

@push('styles')
<style>
    /* Animasi dan efek visual */
    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }
    
    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Card styling */
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    .card:hover {
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }
    
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
    
    /* Button styling */
    .btn-primary {
        background-color: #99765c;
        border-color: #99765c;
    }
    
    .btn-primary:hover {
        background-color: #876754;
        border-color: #876754;
    }
    
    .btn-outline {
        border: 2px solid #99765c;
        color: #99765c;
    }
    
    .btn-outline:hover {
        background-color: #99765c;
        color: white;
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
        <div class="text-center mb-10 fade-in">
            <h1 class="text-3xl font-bold text-gray-900 mb-3">Minta Penawaran Harga</h1>
            <p class="text-gray-600 max-w-3xl mx-auto">Pilih produk yang Anda minati dan isi formulir untuk mendapatkan penawaran harga terbaik.</p>
        </div>
        
        <!-- Main Content -->
        <div class="card bg-white p-6 mb-8 fade-in">
            <!-- Content will be added in steps -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Will be added later
</script>
@endpush
