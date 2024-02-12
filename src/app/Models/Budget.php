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

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
