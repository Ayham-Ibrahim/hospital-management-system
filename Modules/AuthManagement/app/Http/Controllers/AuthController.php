<?php

namespace Modules\AuthManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\AuthManagement\Http\Requests\Auth\LoginUserRequest;
use Modules\AuthManagement\Http\Requests\Auth\StoreUserRequest;
use  Modules\AuthManagement\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());
        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return $this->error(['error' => 'Invalid credentials'], 401);
        }

        $user = User::where('email', $request->email)->first();

        $token = $user->createToken('Api Token Of ' . $user->name)->plainTextToken;
        return $this->success([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function register(StoreUserRequest $request)
    {

        try {
            $request->validated($request->all());
            $user = new User();
            $user->email = $request->input('email');
            $user->name = $request->input('name');
            $user->password = Hash::make($request->input('password'));
            $user->save();
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
