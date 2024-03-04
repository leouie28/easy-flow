<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\CreateRequest;
use App\Models\Inventory;
use App\Services\InventoryService;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    private InventoryService $inventoryService;

    public function __construct(InventoryService $inventoryService)
    {
        $this->inventoryService = $inventoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activeWorkspace = auth()->user()->activeWorkspace;
        return resJson($activeWorkspace->inventories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        $user = auth()->user();
        $request['user_id'] = $user->id;
        $request['workspace_id'] = $user->activeWorkspace->id;

        return resJson($this->inventoryService->create($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $inventory = Inventory::with('inventoryFields')->findOrFail($id);

        return resJson($inventory);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
