<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'currency',
        'description',
        'color',
    ];

    protected $with = [
        'transactionTypes'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('owner');
    }

    public function transactionTypes()
    {
        return $this->hasMany(TransactionType::class);
    }

    public function budgetTransactions()
    {
        return $this->hasMany(BudgetTransaction::class);
    }
}
