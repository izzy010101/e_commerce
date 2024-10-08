<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
        public function checkout_laravel()
    {
        $userId = auth()->id();
        $cart = Cart::with('items.product')->where('user_id', $userId)->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        return view('orders.checkout', compact('cart'));
    }

    public function store_laravel(Request $request)
    {
//        dd('Store method hit');
        try {
            DB::beginTransaction();

            $userId = auth()->id();
            $cart = Cart::with('items.product')->where('user_id', $userId)->first();

//            dd($cart);
            if (!$cart || $cart->items->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
            }

            // Create Order
            $order = Order::create([
                'user_id' => $userId,
                'total_price' => $cart->items->sum(fn($item) => $item->product->price * $item->quantity),
                'discount' => 0, // Add discount logic if applicable
                'status' => 'Pending',
            ]);

            // Create Order Items
            foreach ($cart->items as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                    ''
                ]);
            }

            // Clear the cart
            $cart->items()->delete();

            DB::commit();


            // Redirect to the order confirmation page
            return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Order placement failed: ' . $e->getMessage());
            return redirect()->route('orders.checkout')->with('error', 'Failed to place order. Please try again.');
        }
    }






    //react project
    public function checkout()
    {
        $userId = auth()->id();
        return view('orders.checkout', compact('cart'));
    }


    public function store(Request $request)
    {
        $userId = auth()->id();

        if (!$userId) {
            return response()->json(['error' => 'User not found'], 404);
        }

        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => $userId,
                'total_price' => $request->input('total_price'),
                'status' => 'Pending',
                'discount' => 0,
            ]);

            DB::commit();
            return response()->json(['message' => 'Order placed successfully!', 'orderId' => $order->id], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Order placement failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to place order. Please try again.'], 500);
        }
    }


    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->get();
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('orders.show', compact('order'));
    }
}
