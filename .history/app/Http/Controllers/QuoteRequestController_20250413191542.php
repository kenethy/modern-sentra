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

        return view('quote-request.create', compact('selectedProduct', 'categories', 'featuredProducts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'company' => 'nullable|string|max:255',
            'product_id' => 'nullable|exists:products,id',
            'message' => 'required|string',
            'quantity' => 'nullable|integer|min:1',
        ]);

        QuoteRequest::create($validated);

        return redirect()->back()->with('success', 'Permintaan penawaran Anda telah berhasil dikirim. Tim kami akan menghubungi Anda segera.');
    }
}
