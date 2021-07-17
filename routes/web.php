<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

/**
 * ルーティング（管理者・法人・利用者）
 */
foreach(config('fortify.users') as $user){
  Route::prefix($user)
  ->namespace('\Laravel\Fortify\Http\Controllers')
  ->name($user.'.')
  ->group(function() use($user){
    /**
     * ログイン画面
     * @method GET
     */
    Route::name('login')->middleware('guest')
    ->get('/login','AuthenticatedSessionController@create');
    /**
     * ログイン認証
     * @method POST
     */
    Route::name('login')->middleware(['guest','throttle:'.config('fortify.limiters.login')])
    ->post('/login', 'AuthenticatedSessionController@store');
    /**
     * ログアウト
     * @method POST
     */
    Route::name('logout')->middleware('guest')
    ->post('/logout','AuthenticatedSessionController@destroy');
    /**
     * ダッシュボード
     * @method GET
     */
    Route::name('dashboard')->middleware(['auth:'.\Str::plural($user), 'verified'])
    ->get('/dashboard', function () use($user) {
        return view($user.'.dashboard');
    });
        /**
     * profile
     * @method GET
     */
    Route::name('profile/show')->middleware(['auth:'.\Str::plural($user), 'verified'])
    ->get('/profile', function () use($user) {
        return view($user.'.profile/show');
    });
  });
}