<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $user = new User;
        if ($id > 0) {
            $user = User::find($id);
        }
        return view('admin.user.form', compact('user'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email'
        ]);

        $data = $request->only('first_name', 'last_name', 'email', 'user_name', 'is_active', 'is_admin');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        /*$data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['is_admin'] = $request->has('is_admin') ? 1 : 0;*/

        if ($request->id > 0) {
            // update
            $user = User::where('id', $request->id)->firstOrFail();
            $user->update($data);
        } else {
            // new create
            $user = User::create($data);
        }

        UserDetail::updateOrCreate(
            ['user_id' => $user->id],
            [
                'address' => $request->address,
                'phone' => $request->phone,
                'other_phone' => $request->other_phone
            ]
        );

        return redirect()->route('admin.user.edit', $user->id)
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
