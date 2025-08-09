<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Password;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $superAdminEmail = env('SUPER_ADMIN_EMAIL', 'superadmin@karibujikoni.com');
        $isSuperAdmin = $request->email === $superAdminEmail && !Cache::has('super_admin_created');

        if ($isSuperAdmin) {
            Cache::forever('super_admin_created', true);
        }

        $role = Role::where('name', $isSuperAdmin ? 'super_admin' : 'user')->firstOrFail();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->id,
        ]);

        $code = rand(100000, 999999);
        $user->email_verification_code = $code;
        $user->save();

        $user->preference()->create([
            'dietary_preference' => 'none',
            'delivery_frequency' => 'weekly',
        ]);

        Mail::to($user->email)->send(new VerifyEmail($user));
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['user' => $user, 'token' => $token]);
    }

    public function login(Request $request)
    {
        $request->validate(['email' => 'required|email', 'password' => 'required']);
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json(['user' => $user, 'token' => $token]);
        }
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response()->json(['message' => 'Logged out']);
    }

    public function verifyEmail(Request $request)
    {
        $request->validate(['code' => 'required|string']);
        $user = Auth::user();
        if ($user && $user->email_verification_code === $request->code) {
            $user->email_verified_at = now();
            $user->email_verification_code = null;
            $user->save();
            return response()->json(['message' => 'Email verified']);
        }
        return response()->json(['message' => 'Invalid code'], 400);
    }

    public function sendResetCode(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $code = rand(100000, 999999);
            $user->email_verification_code = $code;
            $user->save();
            Mail::to($user->email)->send(new ResetPassword($user));
        }
        return response()->json(['message' => 'Reset code sent']);
    }

    public function resetPassword(Request $request)
    {
        $request->validate(['email' => 'required|email', 'code' => 'required|string', 'password' => 'required|string|min:6']);
        $user = User::where('email', $request->email)->first();
        if ($user && $user->email_verification_code === $request->code) {
            $user->password = Hash::make($request->password);
            $user->email_verification_code = null;
            $user->save();
            return response()->json(['message' => 'Password reset']);
        }
        return response()->json(['message' => 'Invalid code'], 400);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }
}