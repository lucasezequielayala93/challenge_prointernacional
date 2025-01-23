<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use Illuminate\Http\Request;
use App\Http\Requests\LoginAuthRequest;

interface AuthServiceInterface
{
    public function login(LoginAuthRequest $request): string;
    public function logout(Request $request): void;
}