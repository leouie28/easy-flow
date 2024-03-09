<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'workspace_id',
        'user_id',
        'name',
        'description',
        'disabled',
        'raw_fields',
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
