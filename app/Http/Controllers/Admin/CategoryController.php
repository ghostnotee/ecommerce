<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filled('search_value') || $request->filled('up_id')) {
            $request->flash();

            $searchValue = $request->search_value;
            $upId = $request->up_id;

            $categoriesList = Category::with('upCategory')
                ->where('category_name', 'like', "%$searchValue%")
                ->where('up_id', $upId)
                ->orderByDesc('id')
                ->paginate(8)
                // save the search value in search result.
                ->appends(['search_value' => $searchValue, 'up_id' => $upId]);
        } else {
            $request->flush();

            $categoriesList = Category::with('upCategory')
                ->orderByDesc('id')->paginate(8);
        }

        $mainCategories = Category::whereRaw('up_id is null')->get();

        return view('admin.category.index', compact('categoriesList', 'mainCategories'));
    }

    public function form($id = 0)
    {
        $category = new Category;
        if ($id > 0) {
            $category = Category::find($id);
        }

        $categories = Category::all();

        return view('admin.category.form', compact('category', 'categories'));
    }

    public function save(Request $request)
    {
        $data = $request->only('category_name', 'slug', 'up_id');

        /*if (Category::whereSlug($data['slug'])->count() > 0)
            return back()
                ->withInput()
                ->withErrors(['slug' => 'Slug değeri daha önceden kaydedilmiş.']);*/

        /*if (!$request->filled('slug')) {
            $data['slug'] = Str::slug($request->category_name);
            $request->merge(['slug' => $data['slug']]);
        }*/

        $data['slug'] = $request->slug ?? Str::slug($request->category_name);

        $request->merge(['slug' => $data['slug']]);

        $request->validate([
            'category_name' => 'required',
            'slug' => $request['original_slug'] != $request['slug'] ? 'unique:categories,slug' : ''
        ]);

        if ($request->id > 0) {
            $category = Category::where('id', $request->id)->firstOrFail();
            $category->update($data);
        } else {
            $category = Category::create($data);
        }

        return redirect()->route('admin.category.edit', $category->id)
            ->with('message', ($request->id > 0 ? 'Güncellendi' : 'Kaydedildi'))
            ->with('message_type', 'success');
    }

    public function delete($id)
    {
        // attach/detach use methods for many to many relationships
        $category = Category::find($id);
        $category->products()->detach();
        $category->delete();

        //Category::destroy($id);

        return redirect()
            ->route('admin.category')
            ->with('message_type', 'success')
            ->with('message', 'Kategori Silindi');
    }
}
