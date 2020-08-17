<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filled('search_value')) {
            $request->flash();
            $searchValue = $request->search_value;
            $productsList = Product::where('product_name', 'like', "%$searchValue%")
                ->orWhere('description', 'like', "%$searchValue%")
                ->orderByDesc('created_at')
                ->paginate(8)
                ->appends('search_value', $searchValue);
        } else {
            $productsList = Product::orderByDesc('created_at')->paginate(8);
        }

        return view('admin.product.index', compact('productsList'));
    }

    public function form($id = 0)
    {
        $product = new Product();
        if ($id > 0) {
            $product = Product::find($id);
        }
        return view('admin.product.form', compact('product'));
    }

    public function save(Request $request)
    {
        $data = $request->only('product_name', 'slug', 'description', 'price');

        $data['slug'] = $request->slug ?? Str::slug($request->product_name);

        $request->merge(['slug' => $data['slug']]);

        $request->validate([
            'product_name' => 'required',
            'price' => 'required',
            'slug' => $request['original_slug'] != $request['slug'] ? 'unique:categories,slug' : ''
        ]);

        $productDetail = $request->only('show_slider', 'show_opportunity_of_the_day',
            'show_featured', 'show_most_selling', 'show_damp');

        if ($request->id > 0) {
            $product = Product::where('id', $request->id)->firstOrFail();
            $product->update($data);
            $product->details()->update($productDetail);
        } else {
            $product = Product::create($data);
            $product->details()->create($productDetail);
        }

        return redirect()->route('admin.product.edit', $product->id)
            ->with('message', ($request->id > 0 ? 'Güncellendi' : 'Kaydedildi'))
            ->with('message_type', 'success');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->categories()->detach();   //deleting function for manyToMany relationship. detach=ayırma.
        //$product->details()->delete();      //oneToOne. üründe soft delete kullandım.detayı silmiyorum.
        $product->delete();

        return redirect()
            ->route('admin.product')
            ->with('message_type', 'success')
            ->with('message', 'Ürün Silindi');
    }
}
