<?php

namespace App\Http\Controllers;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public function show(Product $product)
{
    $reviews = $product->reviews()->paginate(5); // Change this to paginate reviews
    return view('product_details', compact('product', 'reviews'));
}

    public function store(Request $request, Product $product)
{
    $request->validate([
        'comment' => 'required|string',
        'rating' => 'required|integer|between:1,5',
    ]);

    Review::create([
        'product_id' => $product->id,
        'user_id' => auth()->id(),
        'comment' => $request->comment,
        'rating' => $request->rating,
    ]);

    return redirect()->back()->with('success', 'Review submitted successfully!');
}

}
