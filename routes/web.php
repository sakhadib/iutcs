<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FestsController;
use App\Http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/signup', [SignupController::class, 'showPage']);
Route::get('/login', [LoginController::class, 'showLoginPage']);

Route::get('/home', [HomeController::class, 'showHomePage']);

Route::get('/fests', [FestsController::class, 'showFestsPage']);
Route::get('/fest/{fest}', [FestsController::class, 'festDetails']);

Route::get('fest/{fest}/event/{event}', [EventController::class, 'showEventPage']);

Route::get('fest/{fest}/event/{event}/register', [EventController::class, 'eventRegistration']);
