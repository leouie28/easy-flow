<?php

namespace App\Services;

use App\Models\InventoryData;
use App\Models\InventoryDataValue;
use Illuminate\Support\Facades\DB;

class InventoryDataService
{
    public function create($data)
    {
        return DB::transaction(function() use($data) {
            $inventoryData = InventoryData::create([
                'inventory_id' => $data['inventory_id'],
                'user_id' => $data['user_id']
            ]);
    
            $values = [];
            foreach($data['fields'] as $val)
            {
                $values[$val['field_label']] = $val['value'];
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
    
            $inventoryData->raw_values = $values;
            $inventoryData->save();
    
            return $inventoryData;
        });
    }

    public function remove($id)
    {
        $inventoryData = InventoryData::findOrFail($id);

        $inventoryData->inventoryDataValues()->delete();
        $inventoryData->delete();

        return $inventoryData;
    }
}