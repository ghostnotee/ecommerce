<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $categories = Category::all()->take(8);
        return view('homepage', compact('categories'));
    }
}
