<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryField extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_id',
        'label',
        'description',
        'type',
        'order',
        'items',
        'setup'
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
