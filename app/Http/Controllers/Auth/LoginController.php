<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
  public function create()
  {
    return view('auth.login');
  }

  public function store(Request $request)
  {
    // Validate input
    $request->validate([
      'email' => 'required|email',
      'password' => 'required|string',
    ]);

    // Check if email exists
    $user = User::where('email', $request->email)->first();

    if (!$user) {
      return back()->withErrors([
        'email' => 'This email is not registered.',
      ])->onlyInput('email');
    }

    // Check if password matches
    if (!Hash::check($request->password, $user->password)) {
      return back()->withErrors([
        'password' => 'Incorrect password.',
      ])->onlyInput('email');
    }

    // Attempt login
    Auth::login($user, $request->filled('remember'));
    $request->session()->regenerate();

    // Redirect based on role
    if ($user->account_role === 'admin') {
      return redirect()->intended('/admin/dashboard');
    } elseif ($user->account_role === 'bargo') {
      return redirect()->intended('/staff/dashboard');
    } else {
      return redirect()->intended('/customer/dashboard');
    }
  }
  public function destroy(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
  }
}
