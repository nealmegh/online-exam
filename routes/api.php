<?php

use App\Models\SiteSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('activate', function (Request $request){

    if($request->apiKey == 'abrarTheGreat')
    {
        SiteSettings::UpdateOrcreate( ['id' =>  1],[
            'attribute' => 'App_Activation',
            'value' =>   $request->till,
        ]);
    }

});
Route::get('deactivate', function (Request $request){
    if($request->apiKey == 'abrarTheGreat')
    {
        SiteSettings::UpdateOrcreate( ['id' =>  1],[
            'attribute' => 'App_Activation',
            'value' =>   '01-01-2000'
        ]);
    }
});
