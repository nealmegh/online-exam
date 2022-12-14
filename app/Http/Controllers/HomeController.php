<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Driver;
use App\Models\Role;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Support\Renderable|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        if (Auth::user()->role_id == Role::IS_STUDENT)
        {
            return redirect('customer.dashboard');
        }

        $numberOfCustomers = 10;
        $numberOfTrips = 10;
        $numberOfDrivers = 10;
        return view('Backend.Dashboard.index')->with(compact( 'numberOfCustomers', 'numberOfDrivers', 'numberOfTrips'));
    }
    public function reports()
    {
        $bookings = null;
        $numberOfCustomers = 0;
        $numberOfTrips = 0;
        $numberOfDrivers = 0;
        return view('Backend.Dashboard.reports')->with(compact('bookings', 'numberOfCustomers', 'numberOfDrivers', 'numberOfTrips'));
    }
}
