<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->filled('search_value')) {
            $request->flash();
            $searchValue = $request->search_value;
            $categoriesList = Category::where('category_name', 'like', "%$searchValue%")
                ->orderByDesc('created_at')
                ->paginate(8)
                ->appends('search_value', $searchValue); // save the search value in serach result.
        } else {
            $categoriesList = Category::orderByDesc('created_at')->paginate(8);
        }

        return view('admin.category.index', compact('categoriesList'));
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
        User::destroy($id);

        return redirect()
            ->route('admin.user')
            ->with('message_type', 'success')
            ->with('message', 'Kullanıcı Silindi');
    }
}
