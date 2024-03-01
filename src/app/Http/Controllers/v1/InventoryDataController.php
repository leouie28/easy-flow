<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Services\InventoryDataService;
use Illuminate\Http\Request;

class InventoryDataController extends Controller
{
    private InventoryDataService $inventoryDataService;

    public function __construct(InventoryDataService $inventoryDataService)
    {
        $this->inventoryDataService = $inventoryDataService;
    }

    public function store(Request $request, string $id)
    {
        $request['user_id'] = auth()->id();
        $request['inventory_id'] = $id;

        return resJson($this->inventoryDataService->create($request));
    }
}
