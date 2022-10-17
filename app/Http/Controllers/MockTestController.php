<?php

namespace App\Http\Controllers;

use App\Models\MockTest;
use App\Http\Requests\StoreMockTestRequest;
use App\Http\Requests\UpdateMockTestRequest;

class MockTestController extends Controller
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
     * @param  \App\Http\Requests\StoreMockTestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMockTestRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MockTest  $mockTest
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function review($mockTest)
    {
        $mockTest = MockTest::where('id', $mockTest)->first();
        $items = $mockTest->mockTestItems;
//        dd($items);
        return view('Backend.Student.mockTestReview', compact('mockTest'));

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MockTest  $mockTest
     * @return \Illuminate\Http\Response
     */
    public function show(MockTest $mockTest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MockTest  $mockTest
     * @return \Illuminate\Http\Response
     */
    public function edit(MockTest $mockTest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMockTestRequest  $request
     * @param  \App\Models\MockTest  $mockTest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMockTestRequest $request, MockTest $mockTest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MockTest  $mockTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(MockTest $mockTest)
    {
        //
    }
}
