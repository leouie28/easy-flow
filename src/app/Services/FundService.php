<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Models\Fund;

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

    public function update($data)
    {
        // $
    }
}
