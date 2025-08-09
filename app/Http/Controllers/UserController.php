<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::with('role', 'preference')->get());
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if (Auth::user()->role->name !== 'super_admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $request->validate(['role' => 'required|in:user,admin']);
        $role = \App\Models\Role::where('name', $request->role)->firstOrFail();
        $user->role_id = $role->id;
        $user->save();
        return response()->json($user);
    }
}