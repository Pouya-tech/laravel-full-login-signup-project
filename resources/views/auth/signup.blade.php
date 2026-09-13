@extends('layouts.master')

@section('title', 'Sign Up')

@vite('resources/css/auth/signup.css')

@push('styles')
    @vite('resources/css/auth/signup.css')
@endpush

@section('content')
    <div class="auth-wrapper">

        <!-- Glass Card -->
        <div class="auth-card">

            <!-- Avatar Icon -->
            <div class="auth-avatar">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 text-white/70" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                </svg>
            </div>
            @if ($errors->any())
                <div
                    style="background-color: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 12px; border-radius: 8px; margin-bottom: 16px;">
                    <ul style="list-style-type: disc; margin-right: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('signup.store') }}" method="POST" class="w-full space-y-5">
                @csrf

                <!-- First Name -->
                <div class="auth-input-group">
                    <svg class="auth-input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First Name"
                        class="auth-input">
                </div>
                @error('first_name')
                    <p class="auth-error-msg">{{ $message }}</p>
                @enderror

                <!-- Last Name -->
                <div class="auth-input-group">
                    <svg class="auth-input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name"
                        class="auth-input">
                </div>
                @error('last_name')
                    <p class="auth-error-msg">{{ $message }}</p>
                @enderror

                <!-- Username -->
                <div class="auth-input-group">
                    <svg class="auth-input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                    <input type="text" name="username" value="{{ old('username') }}" placeholder="Username"
                        class="auth-input">
                </div>
                @error('username')
                    <p class="auth-error-msg">{{ $message }}</p>
                @enderror

                <!-- Email -->
                <div class="auth-input-group">
                    <svg class="auth-input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="auth-input">
                </div>
                @error('email')
                    <p class="auth-error-msg">{{ $message }}</p>
                @enderror
                <!-- Phone_Number -->
                <div class="auth-input-group">
                    <svg class="auth-input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <input type="text" name="phone_number" placeholder="Phone Number " class="auth-input">
                </div>
                @error('phone_number')
                    <p class="auth-error-msg">{{ $message }}</p>
                @enderror
                <!-- Password -->
                <div class="auth-input-group">
                    <svg class="auth-input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <input type="password" id="password" name="password" placeholder="Password" class="auth-input">

                    <button type="button" id="toggle-password" class="auth-toggle-btn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="auth-error-msg">{{ $message }}</p>
                @enderror
                <!-- Confirm Password -->
                <div class="auth-input-group">
                    <svg class="auth-input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Repeat Password" class="auth-input">

                    <button type="button" id="toggle-password-confirm" class="auth-toggle-btn">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" class="auth-submit-btn">
                        Sign Up
                    </button>
                </div>

                <!-- Back to Login Link -->
                <div class="text-center pt-2">
                    <p class="text-xs text-white/80">
                        Already have an account?
                        <a href="{{ route('login') }}"
                            class="underline font-semibold hover:text-white transition-colors">Log In</a>
                    </p>
                </div>
            </form>

        </div>
    </div>
@endsection
