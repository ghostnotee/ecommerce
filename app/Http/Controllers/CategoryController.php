<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($slugCategoryName)
    {
        $category = Category::where('slug', $slugCategoryName)->firstOrFail();
        $subCategories = Category::where('up_id', $category->id)->get();

        $products = $category->products;
        return view('category', compact('category', 'subCategories', 'products'));
    }
}
