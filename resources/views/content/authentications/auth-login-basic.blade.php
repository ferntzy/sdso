@extends('layouts/blankLayout')

@section('title', 'Login - Pages')

@section('page-style')
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">
@endsection

@section('content')
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <div class="card">
          <div class="card-body">
            <h4 class="mb-2">Welcome back 👋</h4>
            <p class="mb-4">Please login to continue</p>

            <form id="formAuthentication" class="mb-3" action="{{ route('login.store') }}" method="POST">
              @csrf

              <!-- Email -->
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                  value="{{ old('email') }}" placeholder="username" required>
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>


              <!-- Password -->
              <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" placeholder="********" required>
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
                @error('password')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>

              <button class="btn btn-primary d-grid w-100">Login</button>
            </form>

            <p class="text-center">
              <span>Don’t have an account?</span>
              <a href="{{ route('register.create') }}"><span>Sign up</span></a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection