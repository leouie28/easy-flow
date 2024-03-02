<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Models\Inventory;
use App\Models\InventoryField;
use App\Models\User;

class InventoryService
{

    public function formatItems($items)
    {
        if (count($items) >= 0) {
            $filtered = array_filter($items, fn($val) => $val['action'] == 'create');
    
            return array_map(fn($val) => $val['value'], $filtered);
        }
        return '';
    }
    
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
                'items' => !empty($field['collections']) ? json_encode($this->formatItems($field['collections'])) : null,
                'options' => !empty((array) $field['options']) ? json_encode($field['options']) : null
            ]);
        }

        return $inventory;
    }

    public function update($data, $id)
    {
        
    }

}
