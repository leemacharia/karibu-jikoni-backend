<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'meal_id' => 'required|exists:meals,id',
            'quantity' => 'required|integer|min:1',
            'user_id' => 'required|exists:users,id',
        ]);

        try {
            $order = Order::create([
                'meal_id' => $request->meal_id,
                'quantity' => $request->quantity,
                'user_id' => $request->user_id,
                'status' => 'pending',
            ]);

            return response()->json(['message' => 'Order placed successfully', 'order' => $order], 201);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Order placement failed', 'details' => $exception->getMessage()], 500);
        }
    }

    public function index(Request $request)
    {
        try {
            $orders = Order::where('user_id', $request->user()->id)->get();
            return response()->json(['orders' => $orders], 200);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Failed to fetch orders', 'details' => $exception->getMessage()], 500);
        }
    }
}