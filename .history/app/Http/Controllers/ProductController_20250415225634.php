<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        // Search by name
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by brand
        if ($request->has('brand') && $request->brand) {
            // Get all products
            $allProducts = Product::all();

            // Filter products with matching brand
            $filteredProductIds = $allProducts->filter(function ($product) use ($request) {
                return $product->brand === $request->brand;
            })->pluck('id')->toArray();

            // Apply the filter to the query
            $query->whereIn('id', $filteredProductIds);
        }

        $products = $query->with('category')->paginate(12); // Menampilkan 12 produk (kelipatan 4)
        $categories = Category::all();
        $brands = Product::getAllBrands();

        return view('products.index-modern', compact('products', 'categories', 'brands'));
    }

    public function show(Product $product)
    {
        // Get related products from the same category
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(3)
            ->get();

        return view('products.show-modern', compact('product', 'relatedProducts'));
    }
}
