<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PayingCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

//        dd($request->user()->onTrial());
        if ($request->user() && ! $request->user()->subscribed('SERU')) {
            // This user is not a paying customer...
            return redirect('subscribe');
        }

        return $next($request);
    }
}
