<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

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
