<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function placeOrder(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $order = Order::create([
            'user_id' => $user->id,
            'total' => $request->input('total', 0),
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Order placed successfully', 'order_id' => $order->id]);
    }
}