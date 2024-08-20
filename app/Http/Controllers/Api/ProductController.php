<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Fetch all products
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    // Fetch products by category ID
    public function getByCategory($id)
    {
        $products = Product::where('category_id', $id)->get();
        return response()->json($products);
    }
}
