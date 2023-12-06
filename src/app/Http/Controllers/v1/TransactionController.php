<?php

namespace App\Http\Controllers\v1;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaction\CreateRequest;
use App\Models\Fund;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        return $user->transactions()->paginate();
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
        if (!Fund::whereId($request['fund_id'])->exists()) {
            throw CustomException::reqError("Fund does not exist! Transaction was not save.");
        }

        return resJson(Transaction::create($request->toArray()));
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
        $tranx = Transaction::findOrFail($id);
        $tranx->update($request->toArray());

        return resJson([
            'data' => $tranx,
            'message' => 'Transaction successfully updated.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tranx = Transaction::findOrFail($id);
        $tranx->delete();

        return resJson("Transaction successfully deleted.");
    }
}
