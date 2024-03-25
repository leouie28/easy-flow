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
        'setup',
        'workspace_id',
        'user_id'
    ];

    protected $with = [
        'transactionTypes'
    ];

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class)->withTimestamps()->withPivot('owner');
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
