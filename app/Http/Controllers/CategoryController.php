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

        $order = request('order');

        switch ($order) {
            case 'mostselling':
                $products = $category->products()
                    ->distinct()
                    ->join('product_details', 'product_details.product_id', 'products.id')
                    ->latest('updated_at')
                    ->paginate(2);

            case 'newproduct':
                $products = $category->products()->distinct()->orderByDesc('updated_at')->paginate(2);

            default :
                $products = $category->products()->distinct()->paginate(3);
        }

        return view('category', compact('category', 'subCategories', 'products'));
    }
}
