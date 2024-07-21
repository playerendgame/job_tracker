<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\Controller;


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
//     return view('login');
// });


Route::get('/', [Controller::class, 'index'])->name('login');
Route::get('/dashboard', [Controller::class, 'dashboard'])->middleware('auth');

Route::post('/login', [UsersController::class, 'login']);
Route::post('/logout', [UsersController::class, 'logout']);
Route::post('/register', [UsersController::class, 'store']);
Route::post('/api/jobs', [JobsController::class, 'store']);
Route::get('/fetch/user/jobs', [JobsController::class, 'getUserJobs']);
Route::get('/fetch/loggedin/user', [UsersController::class, 'fetchLoggedInUser']);
Route::post('/update/jobs/{id}', [JobsController::class, 'update']);
Route::delete('/delete/jobs/{id}', [JobsController::class, 'delete']);


