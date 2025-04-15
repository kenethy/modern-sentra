@extends('layouts.app')

@section('title', 'Minta Penawaran - ' . $product->name)

@push('styles')
<style>
    /* Product card styling */
    .product-card {
        transition: all 0.3s ease;
        border: 2px solid #99765c;
        background-color: rgba(153, 118, 92, 0.05);
    }
    
    /* Form control styling */
    .form-control:focus {
        border-color: #99765c;
        box-shadow: 0 0 0 0.2rem rgba(153, 118, 92, 0.25);
    }
    
    /* Quantity input styling */
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        opacity: 1;
    }
</style>
@endpush

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-gray-900 mb-3">Minta Penawaran Harga</h1>
            <p class="text-gray-600 max-w-3xl mx-auto">Isi formulir di bawah untuk mendapatkan penawaran harga terbaik untuk produk yang Anda pilih.</p>
        </div>
        
        <!-- Main Content -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <form id="quoteForm" action="{{ route('quote-request.store') }}" method="POST">
                @csrf
                
                <!-- Selected Product -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Produk yang Dipilih</h2>
                    
                    <div class="product-card rounded-lg overflow-hidden mb-4">
                        <div class="flex p-4">
                            <div class="flex-shrink-0 w-24 h-24 bg-gray-100 rounded-md overflow-hidden mr-4">
                                @if(method_exists($product, 'hasMedia') && $product->hasMedia('product_images'))
                                    <img src="{{ $product->getFirstMediaUrl('product_images') }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900">{{ $product->name }}</h3>
                                <p class="text-sm text-gray-500 mb-3">{{ $product->category->name }}</p>
                                
                                <div class="flex items-center">
                                    <label for="quantity" class="block text-sm font-medium text-gray-700 mr-3">Jumlah:</label>
                                    <div class="flex items-center">
                                        <button type="button" id="decreaseBtn" class="w-8 h-8 flex items-center justify-center bg-gray-100 rounded-l-lg border border-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                            </svg>
                                        </button>
                                        <input type="number" id="quantity" name="products[{{ $product->id }}]" value="1" min="1" class="w-16 h-8 text-center border-y border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300">
                                        <button type="button" id="increaseBtn" class="w-8 h-8 flex items-center justify-center bg-gray-100 rounded-r-lg border border-gray-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('quote-request.create') }}" class="text-[#99765c] hover:text-[#876754] font-medium inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m6 0H6" />
                            </svg>
                            Tambahkan Produk Lainnya
                        </a>
                    </div>
                </div>
                
                <!-- Contact Information -->
                <div class="mt-10">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Informasi Kontak</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99765c] form-control">
                        </div>
                        
                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99765c] form-control">
                        </div>
                        
                        <!-- Phone Field -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon <span class="text-red-500">*</span></label>
                            <input type="tel" id="phone" name="phone" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99765c] form-control">
                        </div>
                        
                        <!-- Company Field -->
                        <div>
                            <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Perusahaan</label>
                            <input type="text" id="company_name" name="company_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99765c] form-control">
                        </div>
                        
                        <!-- Message Field -->
                        <div class="md:col-span-2">
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Pesan <span class="text-red-500">*</span></label>
                            <textarea id="message" name="message" rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#99765c] form-control" placeholder="Jelaskan kebutuhan Anda secara detail, termasuk spesifikasi khusus atau pertanyaan lainnya."></textarea>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="mt-8 pt-4 border-t border-gray-200">
                        <button type="submit" class="px-6 py-3 bg-[#99765c] text-white rounded-lg hover:bg-[#876754] transition duration-300 shadow-md">
                            Kirim Permintaan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInput = document.getElementById('quantity');
        const decreaseBtn = document.getElementById('decreaseBtn');
        const increaseBtn = document.getElementById('increaseBtn');
        
        decreaseBtn.addEventListener('click', function() {
            const currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });
        
        increaseBtn.addEventListener('click', function() {
            const currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
        });
    });
</script>
@endpush
