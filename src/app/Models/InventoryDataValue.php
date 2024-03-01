<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryDataValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_data_id',
        'inventory_field_id',
        'number_value',
        'boolean_value',
        'date_value',
        'text_value',
        'json_value',
        'relation_value',
    ];

    protected $with = [
        'inventoryField'
    ];

    public function inventoryData()
    {
        return $this->belongsTo(InventoryData::class);
    }

    public function inventoryField()
    {
        return $this->belongsTo(InventoryField::class);
    }
}
