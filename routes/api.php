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
//Teams Functionality
Route::post('/updateTeam',['uses'=>'TeamsController@updateTeam']);
Route::post('/addTeam',['uses'=>'TeamsController@addTeam']);
Route::get('/showTeam',['uses'=>'TeamsController@showTeam']);
Route::get('/deleteTeam',['uses'=>'TeamsController@deleteTeam']);
Route::get('/getTeams',['uses'=>'TeamsController@getTeams']);
Route::get('/getTeamUsers',['uses'=>'TeamsController@getTeamUsers']);


//User Functionality
Route::post('/addUser',['uses'=>'UsersController@addUser']);
Route::post('/assignUserToTeam',['uses'=>'UsersController@assignUserToTeam']);
Route::post('/setTeamOwner',['uses'=>'UsersController@setTeamOwner']);
Route::post('/setUserRole',['uses'=>'UsersController@setUserRole']);
Route::post('/updateUser',['uses'=>'UsersController@updateUser']);
Route::get('/showUser',['uses'=>'UsersController@showUser']);
Route::get('/deleteUser',['uses'=>'UsersController@deleteUser']);
Route::get('/getUserTeams',['uses'=>'UsersController@getUserTeams']);

