<?php

namespace App\Http\Middleware;

use App\Models\SiteSettings;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class BeforeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|string
     */
    public function handle(Request $request, Closure $next)
    {
        $siteSettings = SiteSettings::all();
        $validTill = Carbon::parse($siteSettings[0]->value)->format('d-m-Y , H:m:s');
        $validTillObj = Carbon::createFromFormat('d-m-Y , H:m:s' , $validTill)->timestamp;

        $today = Carbon::now()->timestamp;
//        dd($validTillObj->timestamp, $today->timestamp);
//        dd($validTillObj < $today);
        if($validTillObj < $today)
        {
//            dd('working');
            return redirect()->route('activate');
//            return 'Contact your Developer!!!';
        }
//dd('not');
        return $next($request);
    }
}
