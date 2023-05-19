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


Route::get('/', [AttendanceController::class, 'index'])->middleware(['auth'])->name('index');
Route::post('/work/start', [AttendanceController::class, 'start'])->middleware(['auth']);
Route::post('/work/end', [AttendanceController::class, 'end'])->middleware(['auth']);
Route::post('/rest/start', [RestController::class, 'start'])->middleware(['auth']);
Route::post('/rest/end', [RestController::class, 'end'])->middleware(['auth']);
Route::get('/list/{yyyy_mm_dd}', [AttendanceController::class, 'list'])->middleware(['auth'])->name('list');
Route::post('/list/{yyyy_mm_dd}', [AttendanceController::class, 'list'])->middleware(['auth'])->name('list');
Route::post('/list/page{num}', [AttendanceController::class, 'page'])->middleware(['auth']);
Route::get('/auth', [AuthController::class, 'login'])->name('auth');
Route::post('/auth', [AuthController::class, 'checkUser']);
Route::get('/registration', [AuthController::class, 'register']);
Route::post('/registration', [AuthController::class, 'registration'])->name('registration');
Route::get('/users', [UsersController::class, 'users'])->middleware(['auth'])->name('users');
Route::post('/users/page{num}', [UsersController::class, 'page'])->middleware(['auth']);
Route::get('/eachList/{user_id}', [UsersController::class, 'eachList'])->middleware(['auth'])->name('eachList');
Route::post('/eachList/{user_id}', [UsersController::class, 'eachList'])->middleware(['auth'])->name('eachList');



require __DIR__.'/auth.php';
