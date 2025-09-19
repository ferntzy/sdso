<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\Auth\LoginController;

// Main Page Route
Route::get('/', [LoginBasic::class, 'index'])->name('auth-login-basic');

//admin dashboard
Route::middleware(['auth'])->group(function () {
  Route::get('/admin/dashboard', function () {
    if (auth()->user()->account_role !== 'admin') {
      abort(403, 'Unauthorized');
    }
    return view('admin.dashboard');
  })->name('admin.dashboard');
});


//authentication
Route::get('/auth/register-account-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');
Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/login', [LoginController::class, 'create'])->name('login.create');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');








//dashboard routes

// Admin dashboard
Route::get('/admin/dashboard', function () {
  return view('admin.dashboard');
})->middleware('auth')->name('admin.dashboard');
Route::middleware(['admin'])->group(function () {
  // Organization Accounts
  Route::get('/admin/users/organization', function () {
    return view('admin.users.orgs.index');
  })->name('admin.users.organization');

  // Faculty Accounts
  Route::get('/admin/users/faculty', function () {
    return view('admin.users.faculty.index');
  })->name('admin.users.faculty');
});
// Admin Accounts
Route::get('/admin/users/admins', function () {
  return view('admin.users.admins.index');
})->name('admin.users.admins');








// Staff dashboard
Route::get('/staff/dashboard', function () {
  return view('staff.dashboard');
})->middleware('auth')->name('staff.dashboard');

// User dashboard
Route::get('/user/dashboard', function () {
  return view('user.dashboard');
})->middleware('auth')->name('user.dashboard');
