<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'target_month',
        'target_income',
        'target_expense',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
