@extends('layouts.master')

@section('title', 'Login')

@section('content')
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#1d152a] via-[#3a1d35] to-[#253b5c] p-4 font-sans">

        <!-- Glass Card -->
        <div
            class="w-full max-w-md bg-white/10 backdrop-blur-md rounded-[3rem] p-8 md:p-10 shadow-2xl border border-white/20 text-white flex flex-col items-center">

            <!-- Avatar Icon -->
            <div
                class="w-24 h-24 rounded-full bg-white/10 flex items-center justify-center mb-8 border border-white/15 shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 text-white/70" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                </svg>
            </div>

            <form action="{{ route('login') }}" method="POST" class="w-full space-y-6">
                @csrf

                <!-- Email Input -->
                <div
                    class="relative flex items-center border-b border-white/60 focus-within:border-white transition-colors py-2">
                    <svg class="w-5 h-5 text-white/80 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <input type="text" name="login" value="{{ old('login') }}" placeholder="Email ID / Username"
                        class="w-full bg-transparent text-white placeholder-white/70 focus:outline-none text-sm tracking-wide">
                </div>

                <!-- Password Input -->
                <div
                    class="relative flex items-center border-b border-white/60 focus-within:border-white transition-colors py-2">
                    <svg class="w-5 h-5 text-white/80 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <input type="password" name="password" placeholder="Password"
                        class="w-full bg-transparent text-white placeholder-white/70 focus:outline-none text-sm tracking-wide">
                </div>
                @error('login')
                    <p class="mt-2 text-red-400 text-xs">{{ $message }}</p>
                @enderror

                @error('password')
                    <p class="mt-2 text-red-400 text-xs">{{ $message }}</p>
                @enderror
                <!-- Remember & Forgot Password -->
                <div class="flex items-center justify-between text-xs text-white/80 pt-2">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="remember" value="1" @checked(old('remember'))
                            class="accent-indigo-500 rounded focus:ring-0">
                        <span>Remember me</span>
                    </label>

                    {{-- <a href="#" class="italic hover:underline hover:text-white transition-colors">Forgot Password?</a> --}}
                </div>
                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit"
                        class="w-full py-3 rounded-xl bg-gradient-to-r from-[#2c0529] via-[#472f77] to-[#5984ea] text-white font-semibold tracking-wider hover:opacity-95 transition-opacity shadow-lg">
                        LOGIN
                    </button>
                </div>
            </form>

        </div>
    </div>

@endsection
