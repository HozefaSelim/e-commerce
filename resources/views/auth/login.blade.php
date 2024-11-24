
@extends('layouts.master')

@section('main-content')

  
<div class="section py-5">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Session Status -->
                <div class="mb-4">
                    <x-auth-session-status :status="session('status')" />
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus autocomplete="username">
                        <x-input-error :messages="$errors->get('email')" class="text-danger mt-1" />
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" name="password" class="form-control" required autocomplete="current-password">
                        <x-input-error :messages="$errors->get('password')" class="text-danger mt-1" />
                    </div>

                    <!-- Remember Me -->
                    <div class="form-check mb-3">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label for="remember_me" class="form-check-label">
                            {{ __('Remember me') }}
                        </label>
                    </div>

                    <!-- Forgot Password and Submit Button -->
                    <div class="d-flex justify-content-between align-items-center">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-decoration-none">{{ __('Forgot your password?') }}</a>
                        @endif

                        <button type="submit" class="btn btn-primary">
                            {{ __('Log in') }}
                        </button>
                    </div>
              
                </form>
                <div>
                    <a href="{{ route('github.rediect') }}">Login with Github</a>
                </div>
            </div>
           
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

@endsection