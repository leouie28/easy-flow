<?php

namespace App\Services;

use App\Models\InventoryData;
use App\Models\InventoryDataValue;

class InventoryDataService
{
    public function create($data)
    {
        $inventoryData = InventoryData::create([
            'inventory_id' => $data['inventory_id'],
            'user_id' => $data['user_id']
        ]);

        foreach($data['fields'] as $val)
        {
            InventoryDataValue::create([
                'inventory_data_id' => $inventoryData->id,
                'inventory_field_id' => $val['field_id'],
                'number_value' => $val['type'] == 'number' ? $val['value'] : null,
                'boolean_value' => $val['type'] == 'boolean' ? $val['value'] : null,
                'date_value' => $val['type'] == 'date' ? $val['value'] : null,
                'text_value' => $val['type'] == 'text' ? $val['value'] : null,
                // 'json_value',
                // 'relation_value',
            ]);
        }

        return $inventoryData;
    }
}