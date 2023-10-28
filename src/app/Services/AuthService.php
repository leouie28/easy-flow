<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Jobs\SendVerificationJob;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthService 
{
    public function register($data)
    {
        $user = User::create($data->toArray());

        dispatch(new SendVerificationJob($user));
        return resJson([
            'status' => 'success',
            'message' => 'Verification link sent!'
        ]);
    }

    public function verifyEmail($userId, $data)
    {
        $expire = Carbon::createFromTimestamp($data->expire)->toDateTimeString();
        if ($expire <= Carbon::now()->toDateTimeString()) {
            throw CustomException::authError('Verification link already expired!');
        }

        if ($data->code == md5($userId . env('JWT_ALGO'))) {
            $user = User::findOrFail($userId);
            $user['token'] = Auth::login($user);

            return resJson($user);
        }
    }

    /**
     * login
     */
    public function authorize($data) 
    {
        $token = Auth::attempt($data->toArray());

        if (!$token) throw CustomException::authError();
        $user = Auth::user();

        if (!$user->email_verified_at) {
            $this->revoke();
            return resJson([
                'status' => 'verify-email',
                'message' => 'Please verify your email to continue.'
            ], 308);
        }

        $user['token'] = $token;
        return resJson($user);
    }

    /**
     * logout
     */
    public function revoke()
    {
        Auth::logout();
        return resJson();
    }

    /**
     * refresh token
     */
    public function refreshToken($token)
    {
        return resJson([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}