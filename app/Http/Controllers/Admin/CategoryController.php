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
        $request->validate([
            'category_name' => 'required'
        ]);

        $data = $request->only('category_name', 'slug', 'up_id');

        $data['slug'] = $data['slug'] ?: Str::slug($data['category_name']);

        if ($request->id > 0) {
            // update
            $category = Category::where('id', $request->id)->firstOrFail();
            $category->update($data);
        } else {
            // new create
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
