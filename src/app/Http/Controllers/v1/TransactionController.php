<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return resJson(Transaction::whereUserId(auth()->id())->paginate());
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
    public function store(TransactionRequest $request)
    {
        $request['user_id'] = auth()->id();
        if (!$request['note']) $request['note'] = $request['date'];
        $transact = Transaction::create($request->toArray());

        return resJson([
            'message' => 'success',
            'data' => $transact
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return resJson(Transaction::findOrFail($id));
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
        return resJson(Transaction::whereId($id)->update($request->toArray()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return resJson(Transaction::whereId($id)->delete());
    }
}
