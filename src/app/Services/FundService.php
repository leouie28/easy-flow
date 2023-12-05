<?php

namespace App\Services;

use App\Models\Fund;

class FundService
{
    public function create($data)
    {
        $user = auth()->user();

        $fund = Fund::create($data->toArray());
        $fund->users()->attach($user->id, ['is_owner' => true]);

        return resJson(Fund::find($fund->id));
    }

    public function update($data)
    {
        // $
    }
}
