<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;


class SubscriptionController extends Controller
{
    public function subscribe()
    {
        $intent = Auth::user()->createSetupIntent();
        $courses = Course::where('stripe_plan', '!=', Null)->get();
        return view('Backend.Subscription.index', compact('intent',  'courses'));
    }
    public function subscribePost(Request $request)
    {
        $user = Auth::user();
        Auth::user()->newSubscription(
            'SERU', $request->plan
        )->create($request->paymentMethod, [
            'email' => $user->email,
        ]);
        $user->paid_by = 'Stripe';
        $user->save();
        Auth::user()->subscription('SERU')->cancel();

        return redirect()->route('student.dashboard');
    }
}
