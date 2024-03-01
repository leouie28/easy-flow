<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'disabled'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function inventoryFields()
    {
        return $this->hasMany(InventoryField::class);
    }

    public function inventoryDatas()
    {
        return $this->hasMany(InventoryData::class);
    }
}
