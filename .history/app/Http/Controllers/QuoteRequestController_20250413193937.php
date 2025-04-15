<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;

class QuoteRequestController extends Controller
{
    public function create(Request $request)
    {
        $selectedProduct = null;
        if ($request->has('product_id')) {
            $selectedProduct = Product::find($request->product_id);
        }

        // Get all products grouped by category for selection
        $categories = Category::with(['products' => function ($query) {
            $query->orderBy('name');
        }])->orderBy('name')->get();

        // Get featured products for quick selection
        $featuredProducts = Product::where('is_featured', true)->take(6)->get();

        return view('quote-request.create-new', compact('selectedProduct', 'categories', 'featuredProducts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'message' => 'required|string',
            'products' => 'required|array|min:1',
            'products.*' => 'exists:products,id',
            'quantities' => 'required|array|min:1',
            'quantities.*' => 'integer|min:1',
        ]);

        // Create the quote request
        $quoteRequest = QuoteRequest::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'company_name' => $validated['company_name'] ?? null,
            'message' => $validated['message'],
            'status' => 'Baru',
        ]);

        // Attach products with quantities
        $products = $request->input('products', []);
        $quantities = $request->input('quantities', []);

        $productData = [];
        foreach ($products as $index => $productId) {
            if (isset($quantities[$index]) && $quantities[$index] > 0) {
                $productData[$productId] = ['quantity' => $quantities[$index]];
            }
        }

        // If we have a pivot table for quote_request_product with quantity column
        if (!empty($productData)) {
            $quoteRequest->products()->attach($productData);
        }

        return redirect()->route('home')->with('success', 'Permintaan penawaran Anda telah berhasil dikirim. Tim kami akan menghubungi Anda segera.');
    }
}
