<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RestController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AttendanceController::class, 'index'])->middleware(['auth'])->name('index');
Route::post('/work/start', [AttendanceController::class, 'start'])->middleware(['auth']);
Route::post('/work/end', [AttendanceController::class, 'end'])->middleware(['auth']);
Route::post('/rest/start', [RestController::class, 'start'])->middleware(['auth']);
Route::post('/rest/end', [RestController::class, 'end'])->middleware(['auth']);
Route::get('/list/{yyyymmdd}', [AttendanceController::class, 'list'])->middleware(['auth'])->name('list');
Route::get('/list/page{num}', [AttendanceController::class, 'page'])->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
