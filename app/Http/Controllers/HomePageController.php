<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetail;

class HomePageController extends Controller
{
    public function index()
    {
        $categories = Category::whereRaw('up_id is null')->take(8)->get();

        $productSlider = Product::select('products.*')
            ->join('product_details', 'product_details.product_id', 'products.id')
            ->where('product_details.show_opportunity_of_the_day', 1)
            ->orderBy('updated_at', 'desc')
            ->take(5)->get();

        $productOpportunityOfTheDay = Product::select('products.*')
            ->join('product_details', 'product_details.product_id', 'products.id')
            ->where('product_details.show_opportunity_of_the_day', 1)
            ->orderBy('updated_at', 'desc')
            ->first();

        $productFeatured = Product::select('products.*')
            ->join('product_details', 'product_details.product_id', 'products.id')
            ->where('product_details.show_featured', 1)
            ->orderBy('updated_at', 'desc')
            ->take(4)->get();

        $productMostSelling = Product::select('products.*')
            ->join('product_details', 'product_details.product_id', 'products.id')
            ->where('product_details.show_most_selling', 1)
            ->orderBy('updated_at', 'desc')
            ->take(4)->get();

        $productDamp = Product::select('products.*')
            ->join('product_details', 'product_details.product_id', 'products.id')
            ->where('product_details.show_damp', 1)
            ->orderBy('updated_at', 'desc')
            ->take(4)->get();

        return view('homepage', compact('categories', 'productSlider', 'productOpportunityOfTheDay',
            'productFeatured', 'productMostSelling', 'productDamp'));
    }
}
