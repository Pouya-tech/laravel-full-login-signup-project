<?php

namespace App\Http\Requests;

use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function credentials(): array
    {
        return [
            $this->loginType() => $this->input('login'),
            'password'         => $this->input('password'),
        ];
    }

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        throw ValidationException::withMessages([
            'login' => 'Too many login attempts. Try again in '
                .  RateLimiter::availableIn($this->throttleKey()) . ' seconds.',
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('login')) . '|' . $this->ip());
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }
    public function loginType(): string
    {
        return filter_var($this->input('login'), FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';
    }
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! User::attemptLogin(
            $this->credentials(),
            $this->boolean('remember')
        )) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'login' => 'The Credentials Are Incorrect.',
            ]);
        }
        RateLimiter::clear($this->throttleKey());
    }
}
