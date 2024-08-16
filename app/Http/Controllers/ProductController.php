<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'colors' => 'required|json',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::create($validated);

        // After product creation, associate images
        for ($i = 0; $i < 4; $i++) {
            $product->images()->create([
                'url' => \Faker\Factory::create()->imageUrl(640, 480, 'babies', true),
            ]);
        }

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'colors' => 'required|json',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validated);

        // Optionally replace images
        $product->images()->delete();

        for ($i = 0; $i < 4; $i++) {
            $product->images()->create([
                'url' => \Faker\Factory::create()->imageUrl(640, 480, 'babies', true),
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return redirect()->route('products.index')->with('success', 'Product deleted successfully.');

        } catch (\Exception $e) {

            return redirect()->route('products.index')->with('error', 'Failed to delete the product.');
        }
    }

    public function search(Request $request)
    {
        $query = $request->input('q');

        // Sanitize and validate input
        $query = trim($query); // Remove extra spaces
        $query = htmlspecialchars($query, ENT_QUOTES, 'UTF-8'); // Escape special characters

        // Fetch products based on the query
        $products = Product::where('name', 'like', "%{$query}%")->get();

        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found'], 404);
        }

        return response()->json($products);
    }


//    add to cart logic
    public function addToCart(Request $request, $id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);
        //get the selected color
        $selectedColor = $request->input('selected_color');

        // Get the current user's cart or create a new one
        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id(),
        ]);

        // Check if the product is already in the cart
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            // If the product is already in the cart, increase the quantity
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // If the product is not in the cart, add it
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'color' => $selectedColor, // Store the selected color
            ]);
        }

        // Redirect to the cart with a success message
        return redirect()->route('cart.index')->with('success', 'Product added to cart');
    }

    public function viewCart()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->with('cartItems.product')->first();

        return view('cart.view', compact('cart'));
    }



}
