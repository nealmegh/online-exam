<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\Course;
use App\Models\Role;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('role_id', 2)->get();
        return view('Backend.Dashboard.Student.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
//        $roles = Role::all();
        $courses = Course::where('status', 1)->get();
        return view('Backend.Dashboard.Student.create', compact( 'courses'));
    }
    public function register()
    {
        $courses = Course::where('status', 1)->get();
        return view('Backend.Dashboard.Student.register', compact( 'courses'));
    }
    public function register_store(Request $request)
    {
        try{
            $createUser = New CreateNewUser();

            $user = $createUser->create($request->all());
            $student = new Student([
                'user_id' => $user->id,
                'address' => $request->post('address'),
                'post_code' => $request->post('post_code'),
                'passport_number' => $request->post('passport_number'),
                'dob' => $request->post('dob'),
            ]);
            $student->save();
            if($request->post('course_id') != null){
                $user->courses()->attach($request->post('course_id'));
            }


        }
        catch (Exception $exception)
        {

        }

        return redirect()->route('login')->with('message', 'Registration Successful');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        try{
            $createUser = New CreateNewUser();

            $user = $createUser->create($request->all());
            $user->trial_ends_at = now()->addDays(60);
            $user->paid_by = 'Cash';
            $user->save();
            DB::table('subscriptions')->insert([
                'user_id' => $user->id,
                'name' => 'SERU',
                'stripe_id' => 'CASH_TAKEN'.$user->id.now(),
                'stripe_status' => 'Inactive',
                'stripe_price' => 'price_1Lnkk9C7DhbbV76TdV6cS5eS',
                'quantity' => '1',
                'ends_at' => now()->addDays(60),
            ]);
            $student = new Student([
                'user_id' => $user->id,
                'address' => $request->post('address'),
                'post_code' => $request->post('post_code'),
                'passport_number' => $request->post('passport_number'),
                'dob' => $request->post('dob'),
            ]);
            $student->save();
            if($request->post('course_id') != null){
                $user->courses()->attach($request->post('course_id'));
            }

        }
        catch (Exception $exception)
        {

        }
        return redirect()->route('students.index')->with('message', 'Student Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */

    public function show(Student $student)
    {
        //
    }

    public function extendAccess(User $user, Request $request)
    {

        $affected = DB::table('subscriptions')
            ->where('user_id', $user->id)
            ->update(['ends_at' => now()->addDays($request->add_days)]);

        return response()->json(array('msg'=> 'Days Added'), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(User $user)
    {
//        dd($user);
        $courses = Course::where('status', 1)->get();
        return view('Backend.Dashboard.Student.edit', compact('user','courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, $oldUser)
    {

        $oldUser = User::find($oldUser);
//        dd($request->all());
        $updateUser = New UpdateUserProfileInformation();
        $updateUser->update($oldUser, $request->all());

        $studentData = [
            'user_id' => $oldUser->id,
            'address' => $request->post('address'),
            'post_code' => $request->post('post_code'),
            'passport_number' => $request->post('passport_number'),
            'dob' => $request->post('dob'),
        ];
//        $student = $oldUser->student;

        $student = Student::updateOrCreate($studentData);
        DB::table('subscriptions')->updateOrInsert(
            [   'user_id' => $oldUser->id,
                'name' => 'SERU',
            ],
            [
                'user_id' => $oldUser->id,
                'name' => 'SERU',
                'stripe_id' => 'CASH_TAKEN'.$oldUser->id.now(),
                'stripe_status' => 'Inactive',
                'stripe_price' => 'price_1Lnkk9C7DhbbV76TdV6cS5eS',
                'quantity' => '1',
                'ends_at' => now()->addDays(60),
        ]);
//        $student->update($studentData);
//        $student->save();
//        dd($student);
        if($request->post('course_id') != null){
            $oldUser->courses()->attach($request->post('course_id'));
        }
        return redirect()->route('students.index')->with('message', 'Student Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
//        echo 'hi'.$student->id;

        User::destroy($student->user_id);
        $student->delete();

//        return 200;
        return redirect()->route('questions.index')->with('message', 'Student Deleted');
    }
}
