<?php

namespace App\Services;

use App\Models\User;

class AuthService
{
    public function store($data)
    {
        return User::create($data);
    }
}