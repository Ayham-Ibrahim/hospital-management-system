<?php

namespace Modules\AuthManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\AuthManagement\Http\Requests\Auth\LoginUserRequest;
use Modules\AuthManagement\Http\Requests\Auth\StoreUserRequest;
use  Modules\AuthManagement\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(LoginUserRequest $request)
    {

        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return $this->error(['error' => 'Invalid credentials'], 401);
        }
        $user = Auth::user();
        $token = $user->createToken('Api Token Of ' . $user->name)->plainTextToken;
        return $this->success([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function register(StoreUserRequest $request)
    {

        try {
            $user = User::create($request->validated());

            $token = $user->createToken('Api Token Of ' . $user->name)->plainTextToken;

            return $this->success([
                'user' => $user,
                'token' => $token
            ], 201);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function refreshToken(Request $request)
    {
        $request->user()->tokens()->delete();
        $token = $request->user()->createToken('api', ['expires_at' => now()->addMinutes(20)]);
        return $this->success([
            'new_token' => $token->plainTextToken,
        ]);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->success(['message' => 'Logged out successfully']);
    }
}
