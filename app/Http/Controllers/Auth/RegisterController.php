<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
  public function create()
  {
    return view('auth.register'); // your Blade file
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'email' => 'required|email|unique:user,email',
      'password' => 'required|string|min:6|confirmed',
      'account_role' => 'in:admin,staff,customer',
    ]);

    User::create([
      'email' => $validated['email'],
      'password' => Hash::make($validated['password']),
      'account_role' => $validated['account_role'] ?? 'customer',
      'created_at' => now(),
      'updated_at' => now(),
    ]);

    return redirect('/login')->with('success', 'Account created! Please login.');
  }
}
