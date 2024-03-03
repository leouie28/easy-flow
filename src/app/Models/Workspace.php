<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'disabled'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps()->withPivot(['role', 'active', 'disabled']);
    }

    public function budgets()
    {
        return $this->hasMany(Budget::class);
    }
}
