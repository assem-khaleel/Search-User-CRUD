<?php
//use Illuminate\Support\Facades\Redis;
//$redis = LaravelRedis::connection();
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/', function () {
//    $users = Redis::incr('users');
//    return $users;
//});

Route::get('/','UserController@index')->name('home');

Route::resource('user', 'UserController')->except('show');
Route::get('search', 'UserController@index');


