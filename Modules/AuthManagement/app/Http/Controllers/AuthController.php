<?php

namespace Modules\AuthManagement\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use  Modules\AuthManagement\Models\User;
use Modules\AuthManagement\Http\Requests\Auth\LoginUserRequest;
use Modules\AuthManagement\Http\Requests\Auth\StoreUserRequest;

class AuthController extends Controller
{
    /**
     * Login a user.
     * @param \Modules\AuthManagement\Http\Requests\Auth\LoginUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginUserRequest $request)
    {

        $credentials = $request->only(['email', 'password']);
        // check credentials
        if (!Auth::attempt($credentials)) {
            return $this->error(['error' => 'Invalid credentials'], 401);
        }
        $user = Auth::user();
        // create token
        $token = $user->createToken('Api Token Of ' . $user->name)->plainTextToken;
        return $this->success([
            'user' => $user,
            'token' => $token,
        ],'User loged in successfully',200);
    }

    /**
     * Register a new user.
     * @param \Modules\AuthManagement\Http\Requests\Auth\StoreUserRequest $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function register(StoreUserRequest $request)
    {

        try {
            $user = User::create($request->validated());
            // create token
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
        $request->user()->tokens()->delete();
        return $this->success(['message' => 'Logged out successfully']);
    }
}
