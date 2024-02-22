<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'budget_id',
        'user_id',
        'transaction_type_id',
        'amount',
        'note',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Budget()
    {
        return $this->belongsTo(Budget::class);
    }

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class);
    }
}
