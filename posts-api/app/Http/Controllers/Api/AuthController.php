<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);

        if (! $token = JWTAuth::attempt($credentials)) {
            return $this->errorResponse('Invalid credentials', [], 401);
        }

        return $this->successResponse([
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
        ], 'Login successful');
    }

    public function me(): JsonResponse
    {
        return $this->successResponse(JWTAuth::user(), 'Operation successful');
    }

    public function refresh(): JsonResponse
    {
        $token = JWTAuth::refresh(JWTAuth::getToken());

        return $this->successResponse([
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
        ], 'Token refreshed');
    }

    public function logout(): JsonResponse
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return $this->successResponse((object) [], 'Logged out successfully');
    }
}
