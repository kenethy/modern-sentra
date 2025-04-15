@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('header')
    <h1 class="text-3xl font-bold text-gray-800">Katalog Produk</h1>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <!-- Filter Section -->
                <div class="mb-8">
                    <form action="{{ route('products.index') }}" method="GET" class="flex flex-col md:flex-row md:items-end space-y-4 md:space-y-0 md:space-x-4">
                        <div class="flex-1">
                            <label for="category" class="block text-gray-700 font-medium mb-2">Kategori</label>
                            <select name="category" id="category" class="w-full border-gray-300 rounded-md shadow-sm focus:border-[#99765c] focus:ring focus:ring-[#99765c] focus:ring-opacity-50">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="flex-1">
                            <label for="search" class="block text-gray-700 font-medium mb-2">Cari Produk</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Nama produk..." class="w-full border-gray-300 rounded-md shadow-sm focus:border-[#99765c] focus:ring focus:ring-[#99765c] focus:ring-opacity-50">
                        </div>
                        
                        <div>
                            <button type="submit" class="bg-[#99765c] hover:bg-[#876754] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">
                                Filter
                            </button>
                            @if(request('category') || request('search'))
                                <a href="{{ route('products.index') }}" class="ml-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
                
                <!-- Products Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse($products as $product)
                        <div class="bg-gray-50 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition duration-300">
                            @if($product->hasMedia('product_images'))
                                <img src="{{ $product->getFirstMediaUrl('product_images') }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                            @else
                                <img src="https://via.placeholder.com/300x200" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                            @endif
                            <div class="p-4">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                                    <span class="bg-[#99765c] bg-opacity-90 text-white text-xs font-semibold px-2.5 py-0.5 rounded">
                                        {{ $product->category->name }}
                                    </span>
                                </div>
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ Str::limit($product->description, 100) }}</p>
                                <div class="flex justify-between items-center">
                                    <a href="{{ route('products.show', $product->slug) }}" class="text-[#99765c] hover:text-[#876754] font-medium">
                                        Lihat Detail →
                                    </a>
                                    <a href="{{ route('quote-request.create', ['product_id' => $product->id]) }}" class="bg-[#99765c] hover:bg-[#876754] text-white text-sm font-bold py-1 px-3 rounded focus:outline-none focus:shadow-outline transition duration-300">
                                        Minta Penawaran
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 py-8 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Tidak ada produk ditemukan</h3>
                            <p class="text-gray-600">Coba ubah filter pencarian Anda atau lihat semua produk.</p>
                        </div>
                    @endforelse
                </div>
                
                <!-- Pagination -->
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
