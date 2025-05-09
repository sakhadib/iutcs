<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FestsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeamController;

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


Route::get('/teams', [TeamController::class, 'showTeamPage']);
Route::get('/team/create', [TeamController::class, 'showCreateTeamPage']);
Route::post('/teams/store', [TeamController::class, 'storeTeam']);
Route::post('team/edit', [TeamController::class, 'editTeam']);
Route::get('/team/show/{team_id}', [TeamController::class, 'showTeamDetails']);
Route::post('team/add/member', [TeamController::class, 'addMember']);
Route::post('team/remove/member', [TeamController::class, 'removeMember']);











//! Admin

Route::get('/admin/fests/create', [AdminController::class, 'showCreateFestPage']);
Route::post('/admin/fests/create', [AdminController::class, 'createFest']);


Route::get('admin/fest/{fest}/event/create', [AdminController::class, 'showCreateEventPage']);
Route::post('/admin/fest/{fest}/event/create', [AdminController::class, 'createEvent']);

Route::get('/admin/fest/{fest}/event/{event}/form', [AdminController::class, 'showFormBuilderPage']);

Route::post('admin/questions/add', [AdminController::class, 'addQuestion']);
Route::get('admin/questions/delete/{questionId}', [AdminController::class, 'deleteQuestion']);