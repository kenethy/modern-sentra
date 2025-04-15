<!-- resources/views/partials/quote_product_item.blade.php -->
@php
    // Determine if the product is selected (assuming $selectedProducts is available or passed)
    // We might need to adjust how selection state is passed or determined later in JS
    $isSelected = false; // Default, JS will handle the initial state based on $selectedProduct
@endphp

<div class="product-item group rounded-lg border border-slate-200 hover:border-[#99765c] hover:bg-amber-50/30 transition-all duration-200 cursor-pointer {{ $isSelected ? 'selected border-[#99765c] bg-amber-50/50' : '' }}"
    data-id="{{ $product->id }}"
    data-name="{{ $product->name }}"
    data-category="{{ $category_id ?? $product->category_id }}"> {{-- Use category_id if passed, else from product relation --}}
    <div class="flex items-center p-3 space-x-3">
        <div class="flex-shrink-0 w-16 h-16 bg-slate-100 rounded-md overflow-hidden border border-slate-200">
            @if(method_exists($product, 'hasMedia') && $product->hasMedia('product_images'))
                {{-- Try getting a thumbnail conversion first, fallback to original --}}
                <img src="{{ $product->getFirstMediaUrl('product_images', 'thumbnail') ?: $product->getFirstMediaUrl('product_images') }}"
                    alt="{{ $product->name }}" class="w-full h-full object-cover">
            @else
                <!-- Placeholder SVG for missing image -->
                <div class="w-full h-full flex items-center justify-center bg-slate-200 text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            @endif
        </div>
        <div class="flex-1 min-w-0">
            <h4 class="text-sm font-medium text-slate-900 truncate group-hover:text-[#876754]">{{ $product->name }}</h4>
            <p class="text-xs text-slate-500">{{ $product->category->name ?? 'Uncategorized' }}</p> {{-- Added null check for category --}}
            <p class="text-xs text-slate-600 mt-1 line-clamp-1">{{ Str::limit(strip_tags($product->description ?? ''), 50) }}</p> {{-- Strip tags from description --}}
        </div>
        <div
            class="check-indicator flex items-center justify-center w-6 h-6 rounded-full border-2 border-slate-300 group-hover:border-[#99765c] transition-colors duration-200 {{ $isSelected ? 'bg-[#99765c] border-[#99765c]' : 'bg-white' }}">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4 text-white {{ $isSelected ? '' : 'hidden' }}" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>
    </div>
</div>
