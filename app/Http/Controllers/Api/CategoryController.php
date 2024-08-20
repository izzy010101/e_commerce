<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    // Fetch all categories
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }
}
