<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Models\Inventory;
use App\Models\InventoryField;
use App\Models\User;

class InventoryService
{
    
    public function create($data)
    {
        $user = User::findOrFail($data['user_id']);
        
        if ($user->inventories()->where('name', $data['name'])->exists()) {
            throw CustomException::reqError("Inventory name already registered in your data!");
        }

        $inventory = Inventory::create($data->toArray());
        $inventory->users()->attach($user, ['owner' => true]);

        foreach ($data['fields'] as $field) {
            InventoryField::create([
                'inventory_id' => $inventory->id,
                'label' => $field['label'],
                // 'description' => $field['description'],
                'type' => $field['type'],
                // 'order' => $field['order'],
            ]);
        }

        return $inventory;
    }

    public function update($data, $id)
    {
        
    }

}
