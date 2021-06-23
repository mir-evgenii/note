@extends('layout')

@section('title') Note | Home page @endsection

@section('main_layout_content')

<div class="row justify-content-center">
    <div class="col-3">

        <div class="mb-3">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>

                <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
            </div>

                <button class="btn btn-outline-primary">{{ __('Email Password Reset Link') }}</button>
        </form>
    </div>
</div>

@endsection
