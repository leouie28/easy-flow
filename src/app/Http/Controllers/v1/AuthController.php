<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Exceptions\CustomException;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * signup
     */
    public function register(UserRequest $request)
    {
        return $this->authService->register($request);
    }

    public function login(LoginRequest $request)
    {
        return $this->authService->authorize($request);
    }

    public function refresh()
    {
        return $this->authService->refreshToken(Auth::refresh());
    }

    /**
     * authenticated user profile
     */
    public function profile()
    {
        return resJson(auth()->user());
        // throw CustomException::authError('Unauthorize request!');
    }
}
