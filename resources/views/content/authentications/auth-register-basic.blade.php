@extends('layouts/blankLayout')

@section('title', 'Register Basic - Pages')

@section('page-style')
  <!-- Page -->
  <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection


@section('content')
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner">
        <!-- Register Card -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="{{url('/')}}" class="app-brand-link gap-2">
                <span
                  class="app-brand-logo demo">@include('_partials.macros', ["width" => 25, "withbg" => 'var(--bs-primary)'])</span>
                <span class="app-brand-text demo text-body fw-bold">{{config('variables.templateName')}}</span>
              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Adventure starts here 🚀</h4>
            <p class="mb-4">Make your app management easy and fun!</p>

            <form id="formAuthentication" class="mb-3" action="{{ route('register.store') }}" method="POST">
              @csrf

              <!-- Email -->
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
              </div>

              <!-- Password -->
              <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" placeholder="********"
                    required />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>

              <!-- Confirm Password -->
              <div class="mb-3 form-password-toggle">
                <label class="form-label" for="password_confirmation">Confirm Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password_confirmation" class="form-control" name="password_confirmation"
                    placeholder="********" required />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>

              <!-- Account Role (optional) -->
              <div class="mb-3">
                <label for="account_role" class="form-label">Account Role</label>
                <select id="account_role" name="account_role" class="form-select">
                  <option value="bargo" selected>Bargo</option>
                  <option value="staff"></option>
                  <option value="admin"></option>
                </select>
              </div>

              <!-- Terms -->
              <div class="mb-3">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" required>
                  <label class="form-check-label" for="terms-conditions">
                    I agree to <a href="javascript:void(0);">privacy policy & terms</a>
                  </label>
                </div>
              </div>

              <button class="btn btn-primary d-grid w-100">
                Sign up
              </button>
            </form>


            <p class="text-center">
              <span>Already have an account?</span>
              <a href="{{url('/')}}">
                <span>Sign in instead</span>
              </a>
            </p>
          </div>
        </div>
        <!-- Register Card -->
      </div>
    </div>
  </div>
@endsection