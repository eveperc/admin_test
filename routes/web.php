<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\FolderController;
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
Route::group(['middleware' => 'auth:'.'admins','verified'],function (){
  /**
   * フォルダ作成
   * @method GET
   * @method POST
   */
    Route::get('/admin/folders/create', [FolderController::class, 'showCreateForm'])->name('folders.create');
    Route::post('/admin/folders/create', [FolderController::class, 'create']);
  /**
   * タスク作成機能
   * @method GET
   * @method POST
   */
    Route::get('/admin/folders/{id}/tasks/create',[TaskController::class,'showCreateForm'])->name('tasks.create');
    Route::post('/admin/folders/{id}/tasks/create',[TaskController::class,'create']);
    /**
   * タスク編集機能
   * @method GET
   * @method POST
   */
    Route::get('/admin/folders/{id}/tasks/{tasks_id}/edit', [TaskController::class, 'showEditForm'])->name('tasks.edit');
    Route::post('/admin/folders/{id}/tasks/{tasks_id}/edit',[TaskController::class,'edit']);
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
    /**
     * index
     * @method GET
     */
    Route::group(['middleware' => 'auth:'.\Str::plural($user),'verified'],function ()use($user){
      Route::get('folders/{id}/tasks', [TaskController::class, $user.'_index'])->name('tasks.index');
    });
  });
}