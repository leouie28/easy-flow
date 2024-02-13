<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Models\Budget;
use App\Models\TransactionType;
use App\Models\User;

class BudgetService
{
    
    public function create($data)
    {
        $user = User::findOrFail($data['user_id']);
        
        if ($user->budgets()->where('title', $data['title'])->exists()) {
            throw CustomException::reqError("Budget title already registered in your data!");
        }

        $budget = Budget::create($data->toArray());
        $budget->users()->attach($user, ['owner' => true]);

        foreach ($data['transaction_types'] as $type) {
            TransactionType::create([
                'budget_id' => $budget->id,
                'name' => $type['name'],
                'created_by' => $user->id
            ]);
        }

        return Budget::find($budget->id);
    }

    public function update($data, $id)
    {
        $budget = Budget::findOrFail($id)->update($data->toArray());

        $types = [];
        foreach ($data['transaction_types'] as $type) {
            $types[] = TransactionType::find($type['id'])->update([
                'name' => $type['name'],
                'color' => $type['color'],
                'icon' => $type['icon']
            ]);
        }

        return ['transaction_types' => $types, ...$budget];
    }

}
