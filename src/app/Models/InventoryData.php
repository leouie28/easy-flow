<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryData extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_id',
        'user_id'
    ];

    protected $with = [
        'inventoryDataValues'
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inventoryDataValues()
    {
        return $this->hasMany(InventoryDataValue::class);
    }
}
