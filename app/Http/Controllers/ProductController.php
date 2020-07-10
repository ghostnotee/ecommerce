<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($slugProductName)
    {
        $product = Product::whereSlug($slugProductName)->firstOrFail();
        $categories = $product->categories()->distinct()->get();
        return view('product', compact('product', 'categories'));
    }

    public function search(Request $request)
    {
        $lookFor = request()->input('search');
        $products = Product::where('product_name', 'like', "%$lookFor%")
            ->orWhere('description', 'like', "%$lookFor%")
            ->get();

        $request->flash();
        return view('searchresult', compact('products'));
    }
}
