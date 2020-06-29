<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $categories = Category::whereRaw('up_id is null')->take(8)->get();
        return view('homepage', compact('categories'));
    }
}
