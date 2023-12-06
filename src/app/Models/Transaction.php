<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'fund_id',
        'user_id',
        'amount',
        'type',
        'form',
        'note',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fund()
    {
        return $this->belongsTo(Fund::class);
    }
}
