@extends('layouts.master')

@section('title', 'Login')

@vite('resources/css/auth/login.css')

@push('styles')
    @vite('resources/css/auth/login.css')
@endpush

@section('content')
    <div class="auth-page">
        <!-- Glass Card -->
        <div class="auth-card">

            <!-- Avatar Icon -->
            <div class="auth-avatar-box">
                <svg xmlns="http://www.w3.org/2000/svg" class="auth-avatar-icon" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                </svg>
            </div>
            @if (session('success'))
                <div class="p-3 mb-4 text-sm text-green-800 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('login') }}" method="POST" class="auth-form">
                @csrf

                <!-- Email / Login Input -->
                <div class="auth-input-group">
                    <svg class="auth-input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <input type="text" name="login" value="{{ old('login') }}" placeholder="Email ID / Username"
                        class="auth-input">
                </div>
                @error('login')
                    <p class="auth-error-message">{{ $message }}</p>
                @enderror

                <!-- Password Input -->
                <div class="auth-input-group">
                    <svg class="auth-input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <input type="password" id="password" name="password" placeholder="Password" class="auth-input">

                    <button type="button" id="toggle-password" class="auth-password-toggle">
                        <svg id="eye-icon" class="auth-password-icon" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="auth-error-message">{{ $message }}</p>
                @enderror

                <!-- Remember & Signup Link -->
                <div class="auth-options">
                    <label class="auth-checkbox-label">
                        <input type="checkbox" name="remember" value="1" @checked(old('remember'))
                            class="auth-checkbox">
                        <span>Remember me</span>
                    </label>

                    <a href="{{ route('signup') }}" class="btn btn-link">Sign up</a>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" class="auth-btn-submit">
                        LOGIN
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
