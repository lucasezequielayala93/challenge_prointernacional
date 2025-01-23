<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginAuthRequest;
use Illuminate\Validation\UnauthorizedException;

final class AuthService implements Contracts\AuthServiceInterface
{
    public function login(LoginAuthRequest $request): string
    {
        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw new UnauthorizedException();
        }
        return $user->createToken('api-token')->plainTextToken;
    }

    public function logout(Request $request): void
    {
        $request->user()->currentAccessToken()->delete();
    }
}
