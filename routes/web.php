<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;

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


Route::group(['middleware' => 'auth'],function(){
  Route::get('/', [AttendanceController::class, 'index'])->name('index');
  Route::post('/work/start', [AttendanceController::class, 'start']);
  Route::post('/work/end', [AttendanceController::class, 'end']);
  Route::post('/rest/start', [RestController::class, 'start']);
  Route::post('/rest/end', [RestController::class, 'end']);
  Route::get('/list/{yyyy_mm_dd}', [AttendanceController::class, 'list'])->name('list');
  Route::post('/list/{yyyy_mm_dd}', [AttendanceController::class, 'list'])->name('list');
  Route::post('/list/page{num}', [AttendanceController::class, 'page']);
  Route::get('/users', [UsersController::class, 'users'])->name('users');
  Route::post('/users/page{num}', [UsersController::class, 'page']);
  Route::get('/eachList/{user_id}', [UsersController::class, 'eachList'])->name('eachList');
  Route::post('/eachList/{user_id}', [UsersController::class, 'eachList'])->name('eachList');
});

Route::get('/auth', [AuthController::class, 'login'])->name('auth');
Route::post('/auth', [AuthController::class, 'checkUser']);
Route::get('/registration', [AuthController::class, 'register']);
Route::post('/registration', [AuthController::class, 'registration'])->name('registration');

require __DIR__.'/auth.php';
