<?php

namespace App\Services;

class InventoryDataService
{
    public function create($data)
    {
        $items = [];

        foreach($data['fields'] as $val)
        {
            $items[] = $val;
        }

        return $items;
    }
}