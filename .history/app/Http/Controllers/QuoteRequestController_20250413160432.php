<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;

class QuoteRequestController extends Controller
{
    public function create(Request $request)
    {
        $product = null;
        if ($request->has('product_id')) {
            $product = Product::find($request->product_id);
        }

        return view('quote-request.create', compact('product'));
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
