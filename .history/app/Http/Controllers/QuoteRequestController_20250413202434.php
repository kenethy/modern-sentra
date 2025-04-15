<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuoteRequestController extends Controller
{
    /**
     * Show the form for creating a new quote request with multiple products.
     */
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

        return view('quote-request.create-modern', compact('selectedProduct', 'categories', 'featuredProducts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'message' => 'required|string',
            // Adjust validation: 'products' is now an associative array [id => quantity]
            'products' => 'required|array|min:1',
            'products.*' => 'integer|min:1', // Validate quantities are integers >= 1
            // We validate product IDs implicitly by checking keys if needed, or rely on DB constraints
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
        $productsInput = $request->input('products', []); // Input is now ['product_id' => 'quantity', ...]

        $productData = [];
        foreach ($productsInput as $productId => $quantity) {
            // Basic validation: ensure quantity is numeric and positive
            // Also ensure product ID exists (optional, attach might fail anyway)
            if (is_numeric($quantity) && $quantity > 0 && Product::find($productId)) {
                // Ensure productId is treated as integer if needed by attach
                $productData[intval($productId)] = ['quantity' => intval($quantity)];
            }
        }

        // If we have valid product data to attach
        if (!empty($productData)) {
            $quoteRequest->products()->attach($productData);
        }

        return redirect()->route('home')->with('success', 'Permintaan penawaran Anda telah berhasil dikirim. Tim kami akan menghubungi Anda segera.');
    }
}
