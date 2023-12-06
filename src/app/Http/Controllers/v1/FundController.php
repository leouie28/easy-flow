<?php

namespace App\Http\Controllers\v1;

use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Fund\CreateRequest;
use App\Http\Resources\Fund as ResourcesFund;
use App\Models\Fund;
use App\Models\User;
use App\Services\FundService;
use Illuminate\Http\Request;

class FundController extends Controller
{
    private FundService $fundService;

    public function __construct(FundService $fundService)
    {
        $this->fundService = $fundService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        return ResourcesFund::collection($user->funds()->paginate());
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
        return $this->fundService->create($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fund = Fund::findOrFail($id);

        return resJson($fund);
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
        $fund = Fund::findOrFail($id)->update($request->toArray());

        return resJson([
            'data' => $fund,
            'message' => "Fund successfully udpated."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // ==========================
    // =   Custom Controllers   =
    // ==========================

    /**
     * Add user to the fund
     */
    public function addUser(Request $request, $fundId)
    {
        $data = $request->validate(['user_id' => 'required']);
        return $this->fundService->addUser($fundId, $data['user_id']);
    }


    public function removeUser(Request $request, $fundId)
    {
        $data = $request->validate(['user_id' => 'required']);
        $fund = Fund::findOrFail($data['user_id']);

        $fund->users()->detach($data['user_id']);

        return resJson("User successfully remove on this fund.");
    }
}
