<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        return view('layouts.guests.home', compact('categories'));
    }

    public function showCategory($id)
    {
        $category = Category::findOrFail($id);

        $products = $category->products()->with('images')->get();

        return view('layouts.guests.category', compact('category', 'products'));
    }


    public function personalization() {
        return view('layouts.guests.personalization');
    }

    public function customorder() {
        return view('layouts.guests.customorder');
    }

    public function moderndesign() {
        return view('layouts.guests.moderndesign');
    }


}
