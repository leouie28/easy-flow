<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Budget\Transaction\CreateRequest;
use App\Services\BudgetTransactionService;
use Illuminate\Http\Request;

class BudgetTransactionController extends Controller
{
    private BudgetTransactionService $budgetTransactionService;

    public function __construct(BudgetTransactionService $budgetTransactionService)
    {
        $this->budgetTransactionService = $budgetTransactionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request['user_id'] = auth()->id();

        return resJson($this->budgetTransactionService->create($request));
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
