<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        return view('Backend.Course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCourseRequest  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
        $request->validate([
            'title' => 'required',
            'stripe_plan' => 'required',
            'amount' => 'required|between:0,999.99',
        ]);

        $course = new Course([
            'title' => $request->post('title'),
            'amount' => $request->post('amount'),
            'stripe_plan' => $request->post('stripe_plan'),
        ]);

        $course->save();
        return redirect()->route('courses.index')->with('message', 'Course Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('Backend.Course.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCourseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $request->validate([
            'title' => 'required',
            'stripe_plan' => 'required',
            'amount' => 'required|between:0,999.99',
        ]);

        $course->title = $request->post('title');
        $course->amount = $request->post('amount');
        $course->status = $request->post('status');
        $course->stripe_plan = $request->post('stripe_plan');

        $course->save();


        $request->session()->flash('alert-class', 'alert-success');

        return redirect()->route('courses.index')->with('message', 'Course Details Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();

//        return 200;
        return redirect()->route('courses.index')->with('message', 'Course Deleted');
    }
}
