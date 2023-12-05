<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'currency_symbol',
        'description',
        'show_all_tranx'
    ];

    protected $with = [
        // 'owner'
    ];

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


}
