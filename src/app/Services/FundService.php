<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Models\Fund;
use App\Models\User;

class FundService
{
    public function create($data)
    {
        $user = auth()->user();
        $existedName = $user->funds->where('name', $data['name'])->first();
        if ($existedName) {
            throw CustomException::reqError("Fund name already registered in your funds!");
        }

        $fund = Fund::create($data->toArray());
        $fund->users()->attach($user->id, ['is_owner' => true]);

        return resJson(Fund::find($fund->id));
    }

    /**
     * Add user to the fund with validation
     */
    public function addUser($fundId, $userId)
    {
        $fund = Fund::findOrFail($fundId);
        if (!User::whereId($userId)->exists()) {
            throw CustomException::reqError("User not exists!");
        }

        if ($fund->users->where('id', $userId)->first()) {
            throw CustomException::reqError("User already added.");
        }

        $fund->users()->attach($userId, ['is_owner' => false]);

        return resJson("User successfully added.");
    }
}
