<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'currency',
        'description',
        'color'
    ];

    protected $with = [
        // 'owner'
    ];

    protected $appends = [
        'income_total',
        'expense_total',
        'transfer_total',
        'all_total'
    ];

    // =====================
    // =   Relationships   =
    // =====================
    
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot('is_owner');
    }

    public function owner()
    {
        return $this->users()->wherePivot('is_owner', true);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // ==================
    // =   Attributes   =
    // ==================

    public function getIncomeTotalAttribute()
    {
        return $this->transactions()->where('type', 'income')->sum('amount');
    }

    public function getExpenseTotalAttribute()
    {
        return $this->transactions()->where('type', 'expense')->sum('amount');
    }

    public function getTransferTotalAttribute()
    {
        return $this->transactions()->where('type', 'transfer')->sum('amount');
    }

    public function getFundTotalAttribute()
    {
        return $this->transactions()->where('type', 'transfer')->sum('amount');
    }

    public function getAllTotalAttribute()
    {
        return $this->transactions()->sum('amount');
    }

}
