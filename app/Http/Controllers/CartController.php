<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{
    public function index()
    {
        // Assuming you're using the authenticated user's cart
        $userId = auth()->id();
        $cart = Cart::with('items.product')->where('user_id', $userId)->first();

        return view('cart.index', compact('cart'));
    }

    public function removeItem($id)
    {
        $item = CartItem::findOrFail($id);
        $item->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart');
    }

}
