<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FestsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\AdminController;

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


Route::get('/signup', [SignupController::class, 'showPage']);
Route::post('/signup', [SignupController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginPage']);
Route::post('/login', [LoginController::class, 'login']);

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/', [HomeController::class, 'showHomePage']);
Route::get('/home', [HomeController::class, 'showHomePage']);

Route::get('/fests', [FestsController::class, 'showFestsPage']);
Route::get('/fest/{fest}', [FestsController::class, 'festDetails']);

Route::get('fest/{fest}/event/{event}', [EventController::class, 'showEventPage']);

Route::get('fest/{fest}/event/{event}/register', [EventController::class, 'eventRegistration']);


Route::get('/profile/{user_id}', [ProfileController::class, 'viewProfile']);











//! Admin

Route::get('/admin/fests/create', [AdminController::class, 'showCreateFestPage']);
Route::post('/admin/fests/create', [AdminController::class, 'createFest']);