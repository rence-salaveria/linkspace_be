<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatus;
use App\Http\Requests\StoreUserRequest;
use App\Http\Traits\HttpResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponse;

    // for admins only
    public function register(StoreUserRequest $request)
    {
        $validatedData = $request->validated();

        $newUser = User::create([
            'full_name' => $validatedData['full_name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'username' => $validatedData['username'],
        ]);

        return $this->success([
            'user' => $newUser,
            'token' => $newUser->createToken('register token for ' . $newUser->username)->plainTextToken
        ], 'Create new user successfully');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            return $this->error('Invalid login credentials', HttpStatus::UNAUTHORIZED);
        }

        $user = Auth::user();

        $token = $user->createToken('login token for ' . $user->username)->plainTextToken;

        return $this->success([
            'user' => $user,
            'token' => $token,
        ], 'Login successfully');
    }
}
