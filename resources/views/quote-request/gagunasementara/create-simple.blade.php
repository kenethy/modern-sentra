@extends('layouts.app')

@section('title', 'Minta Penawaran Harga')

@section('content')
<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-center mb-6">Minta Penawaran Harga</h1>
        
        <div class="bg-white p-6 rounded-lg shadow-md">
            <form id="quoteForm" action="{{ route('quote-request.store') }}" method="POST">
                @csrf
                
                <!-- Step 1: Product Selection -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Pilih Produk</h2>
                    
                    <!-- Featured Products -->
                    @if($featuredProducts->isNotEmpty())
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-700 mb-3">Produk Unggulan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach($featuredProducts as $product)
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-300">
                                <h4 class="font-medium">{{ $product->name }}</h4>
                                <p class="text-sm text-gray-500">{{ $product->category->name }}</p>
                                <div class="mt-3">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="products[]" value="{{ $product->id }}" class="rounded text-[#99765c] focus:ring-[#99765c]">
                                        <span class="ml-2">Pilih</span>
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <!-- Contact Information -->
                    <div class="mt-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Informasi Kontak</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" id="name" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#99765c] focus:border-[#99765c]">
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                                <input type="email" id="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#99765c] focus:border-[#99765c]">
                            </div>
                            
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon <span class="text-red-500">*</span></label>
                                <input type="tel" id="phone" name="phone" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#99765c] focus:border-[#99765c]">
                            </div>
                            
                            <div>
                                <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Perusahaan</label>
                                <input type="text" id="company_name" name="company_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#99765c] focus:border-[#99765c]">
                            </div>
                            
                            <div class="md:col-span-2">
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Pesan <span class="text-red-500">*</span></label>
                                <textarea id="message" name="message" rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-[#99765c] focus:border-[#99765c]"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8 pt-4 border-t border-gray-200">
                        <button type="submit" class="px-6 py-2 bg-[#99765c] text-white rounded-lg hover:bg-[#876754] transition duration-300">
                            Kirim Permintaan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
