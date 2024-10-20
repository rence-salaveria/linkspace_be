<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'full_name' => ['required'],
            'username' => 'required|string|max:255|unique:users',
            'email' => ['required', 'email', 'max:254'],
            'email_verified_at' => ['nullable', 'date'],
            'password' => ['required'],
            'status' => ['nullable', 'boolean'],
            'remember_token' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
