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
                'value' => $val['value'],
                'number_value' => $val['type'] == 'number' ? $val['value'] : null,
                'boolean_value' => $val['type'] == 'boolean' ? $val['value'] : null,
                'date_value' => $val['type'] == 'date' ? $val['value'] : null,
                // 'json_value',
                // 'relation_value',
            ]);
        }

        return $inventoryData;
    }

    public function remove($id)
    {
        $inventoryData = InventoryData::findOrFail($id);

        $inventoryData->inventoryDataValues()->delete();
        $inventoryData->delete();

        return $inventoryData;
    }
}