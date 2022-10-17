<?php

namespace App\Http\Controllers;

use App\Models\MockTestItems;
use App\Http\Requests\StoreMockTestItemsRequest;
use App\Http\Requests\UpdateMockTestItemsRequest;

class MockTestItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMockTestItemsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMockTestItemsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MockTestItems  $mockTestItems
     * @return \Illuminate\Http\Response
     */
    public function show(MockTestItems $mockTestItems)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MockTestItems  $mockTestItems
     * @return \Illuminate\Http\Response
     */
    public function edit(MockTestItems $mockTestItems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMockTestItemsRequest  $request
     * @param  \App\Models\MockTestItems  $mockTestItems
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMockTestItemsRequest $request, MockTestItems $mockTestItems)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MockTestItems  $mockTestItems
     * @return \Illuminate\Http\Response
     */
    public function destroy(MockTestItems $mockTestItems)
    {
        //
    }
}
