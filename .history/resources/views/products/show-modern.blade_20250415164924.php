                        Request a Quote for this Product
                    </a>
                     <a href="{{ route('products.index') }}" class="mt-4 w-full block text-center bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out">
                        Back to Products
                    </a>
    {{-- Add any specific styles for this page if needed --}}
    <link rel="stylesheet" href="{{ asset('css/products-modern.css') }}">
    <style>
        /* Additional custom styles can go here */
        .product-gallery img {
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .product-gallery img:hover {
            transform: scale(1.05);
        }
        .main-image-container {
            border: 1px solid #e2e8f0; /* Light gray border */
            border-radius: 0.5rem; /* Rounded corners */
            overflow: hidden; /* Ensure image stays within bounds */
        }
        .attribute-list dt {
            font-weight: 600; /* Semibold */
            color: #4a5568; /* Gray-700 */
        }
        .attribute-list dd {
            color: #718096; /* Gray-600 */
        }
    </style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="bg-white shadow-xl rounded-lg overflow-hidden">
        <div class="md:flex">
            <!-- Product Images -->
            <div class="md:w-1/2 p-6">
                <div class="main-image-container mb-4">
                    @if($product->getFirstMediaUrl('product_images'))
                        <img id="mainProductImage" src="{{ $product->getFirstMediaUrl('product_images') }}" alt="{{ $product->name }}" class="w-full h-auto object-cover rounded-lg">
                    @else
                        <img id="mainProductImage" src="{{ asset('images/placeholder.png') }}" alt="No image available" class="w-full h-auto object-cover rounded-lg">
                    @endif
                </div>
                <!-- Optional: Thumbnail Gallery -->
                {{-- <div class="product-gallery grid grid-cols-4 gap-2">
                    @foreach($product->getMedia('product_images') as $media)
                        <img src="{{ $media->getUrl('thumbnail') }}" alt="Thumbnail" class="w-full h-auto object-cover rounded border hover:border-blue-500" onclick="document.getElementById('mainProductImage').src='{{ $media->getUrl() }}'">
                    @endforeach
                </div> --}}
            </div>

            <!-- Product Details -->
            <div class="md:w-1/2 p-6 flex flex-col justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $product->name }}</h1>
                    @if($product->category)
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-4">
                            Category: {{ $product->category->name }}
                        </span>
                    @endif

                    <p class="text-gray-600 text-base mb-6">
                        {!! nl2br(e($product->description)) !!}
                    </p>

                    @if($product->attributes && $product->attributes->count() > 0)
                        <h2 class="text-xl font-semibold text-gray-700 mb-3">Specifications</h2>
                        <dl class="attribute-list grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3 mb-6">
                            @foreach($product->attributes as $attribute)
                                <div class="border-b border-gray-200 pb-2">
                                    <dt>{{ $attribute->name }}</dt>
                                    <dd>{{ $attribute->value }}</dd>
                                </div>
                            @endforeach
                        </dl>
                    @endif
                </div>

                <!-- Action Button -->
                <div class="mt-auto">
                    <a href="{{ route('quote-request.product', ['id' => $product->id]) }}"
                       class="w-full block text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out">
                        Request a Quote for this Product
                    </a>
                     <a href="{{ route('products.index.modern') }}" class="mt-4 w-full block text-center bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded-lg transition duration-300 ease-in-out">
                        Back to Products
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Optional: Related Products Section --}}
    {{-- <div class="mt-16">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Related Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Loop through related products here -->
        </div>
    </div> --}}

</div>
@endsection

@push('scripts')
    {{-- Add any specific scripts for this page if needed --}}
    <script>
        // Simple script for image gallery if implemented
        function changeMainImage(element) {
            document.getElementById('mainProductImage').src = element.src.replace('thumbnail', ''); // Adjust if using different conversion names
        }
    </script>
@endpush
