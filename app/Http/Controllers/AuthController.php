<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginAuthRequest;

class AuthController extends Controller
{
    public function __construct(protected AuthService $service) {}

    public function login(LoginAuthRequest $request)
    {
        /*
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;
        */

        $token = $this->service->login($request);
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $this->service->logout($request);
        return response()->json(status: 204);
    }
}
