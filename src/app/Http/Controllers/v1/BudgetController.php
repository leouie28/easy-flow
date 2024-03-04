<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Budget\CreateRequest;
use App\Http\Requests\Budget\UpdateRequest;
use App\Models\Budget;
use App\Models\User;
use App\Models\Workspace;
use App\Services\BudgetService;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    private BudgetService $budgetService;

    public function __construct(BudgetService $budgetService)
    {
        $this->budgetService = $budgetService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activeWorkspace = auth()->user()->activeWorkspace;

        return resJson($activeWorkspace->budgets()->orderBy('id', 'desc')->get());
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

        return resJson($this->budgetService->create($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(UpdateRequest $request, string $id)
    {
        return resJson($this->budgetService->update($request, $id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
