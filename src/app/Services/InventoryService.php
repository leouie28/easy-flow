<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Models\Inventory;
use App\Models\InventoryField;
use App\Models\User;
use App\Models\Workspace;

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
        $workspace = Workspace::findOrFail($data['workspace_id']);
        
        if ($workspace->inventories()->where('name', $data['name'])->exists()) {
            throw CustomException::reqError("Inventory name already registered in workspace!");
        }

        $inventory = Inventory::create($data->toArray());

        $count = 0;
        foreach ($data['fields'] as $field) {
            if ($field['action'] == 'create') {
                $count++;
                InventoryField::create([
                    'inventory_id' => $inventory->id,
                    'label' => $field['label'],
                    // 'description' => $field['description'],
                    'type' => $field['type'],
                    'order' => $count,
                    'items' => !empty($field['collections']) ? json_encode($this->formatItems($field['collections'])) : null,
                    'options' => !empty((array) $field['options']) ? json_encode($field['options']) : null
                ]);
            }
        }

        return $inventory;
    }

    public function update($data, $id)
    {
        
    }

}
