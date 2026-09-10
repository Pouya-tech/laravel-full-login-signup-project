<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\SignupRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function index()
    {
        return view('auth.signup');
    }

    public function store(SignupRequest $request)
    {
        // دیتای اعتبارسنجی‌شده و کاملاً تمیز:
        $validated = $request->validated();

        // موقتاً برای تست:
        dd($validated);
    }
}
