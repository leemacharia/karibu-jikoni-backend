<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreferenceController extends Controller
{
    public function show($userId)
    {
        $preference = Preference::where('user_id', $userId)->first();
        return response()->json($preference ?: ['dietary_preference' => 'none', 'delivery_frequency' => 'weekly']);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'dietary_preference' => 'required|in:none,vegetarian,vegan,gluten-free',
            'delivery_frequency' => 'required|in:daily,weekly,monthly',
        ]);
        $preference = $user->preference ?: $user->preference()->create([]);
        $preference->update($request->only(['dietary_preference', 'delivery_frequency']));
        return response()->json($preference);
    }
}