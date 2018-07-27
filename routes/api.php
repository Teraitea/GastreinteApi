<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');

Route::group(['middleware' => 'auth:api'], function(){

    /**
     * Route pour le manager
     */
    // Récupération des astreintes du service pour le manager
    Route::get('agentsAstreintes', 'AstreinteController@getAstreinteForManager');
    // Récupération des astreintes d'un agent
    Route::get('astreintesOf/{agentId}', 'AstreinteController@getAstreinteByAgentId');
    // Validation ou refus d'une astreinte
    Route::post('validateAstreinte/{astreinteId}/ofAgent/{agentId}', 'AstreinteController@validateAstreinte');
    
});
