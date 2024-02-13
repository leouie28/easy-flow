<?php

namespace App\Services;

use App\Models\BudgetTransaction;

class BudgetTransactionService
{
    public function create($data)
    {
        return BudgetTransaction::create($data->toArray());
    }
}