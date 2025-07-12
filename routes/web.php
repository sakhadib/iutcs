<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FestsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ParticipantRegisterController;
use App\Http\Controllers\EventReportController;

use App\Http\Controllers\RoughEventController;
use App\Http\Controllers\CodeSprintRegistrationController;

use App\Http\Controllers\AdminController;
use App\Models\Event;

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

Route::get('/fest/{fest}/event/{event}', [EventController::class, 'showEventPage']);

Route::get('/fest/{fest}/event/{event}/register', [EventController::class, 'eventRegistration']);
Route::post('/fest/{fest}/event/{event}/register', [ParticipantRegisterController::class, 'registerParticipant']);


Route::get('/profile/{user_id}', [ProfileController::class, 'viewProfile']);


Route::get('/teams', [TeamController::class, 'showTeamPage']);
Route::get('/team/create', [TeamController::class, 'showCreateTeamPage']);
Route::post('/teams/store', [TeamController::class, 'storeTeam']);
Route::post('/team/edit', [TeamController::class, 'editTeam']);
Route::get('/team/show/{team_id}', [TeamController::class, 'showTeamDetails']);
Route::post('team/add/member', [TeamController::class, 'addMember']);
Route::post('team/remove/member', [TeamController::class, 'removeMember']);


Route::get('/about', [HomeController::class, 'showAboutPage']);


// CodeSprint Routes
Route::get('/codesprint', function () {
    return view('rough.codesprint.home');
})->name('codesprint.home');
Route::get('/codesprint/rulebook', [RoughEventController::class, 'codeSprint2025Rulebook'])->name('codesprint.rulebook');

// CodeSprint Registration Routes (Public)
Route::get('/codesprint/register', [CodeSprintRegistrationController::class, 'showRegistrationForm'])->name('codesprint.register');
Route::post('/codesprint/register', [CodeSprintRegistrationController::class, 'submitRegistration'])->name('codesprint.register.submit');
Route::get('/codesprint/registration-success/{token}', [CodeSprintRegistrationController::class, 'showRegistrationSuccess'])->name('codesprint.registration.success');
Route::get('/codesprint/status/{token}', [CodeSprintRegistrationController::class, 'showStatus'])->name('codesprint.status');
Route::get('/codesprint/check-status', [CodeSprintRegistrationController::class, 'showStatusLookup'])->name('codesprint.status.lookup');
Route::post('/codesprint/check-status', [CodeSprintRegistrationController::class, 'lookupStatus'])->name('codesprint.status.lookup');
Route::get('/codesprint/stats', [CodeSprintRegistrationController::class, 'getPublicStats'])->name('codesprint.stats');
Route::get('/codesprint/api/stats', [CodeSprintRegistrationController::class, 'getPublicStatsJson'])->name('codesprint.api.stats');

// CodeSprint Submission Routes
Route::post('/codesprint/github/submit', [CodeSprintRegistrationController::class, 'submitGitHub'])->name('codesprint.github.submit');
Route::post('/codesprint/project/submit', [CodeSprintRegistrationController::class, 'submitProject'])->name('codesprint.project.submit');

// Legacy routes from RoughEventController (keeping for backward compatibility)
Route::post('/codesprint/registration/submit', [RoughEventController::class, 'codeSprint2025RegistrationSubmission'])->name('codesprint.legacy.register');
Route::post('/codesprint/github/legacy/submit', [RoughEventController::class, 'codeSprint2025GitHubSubmission'])->name('codesprint.legacy.github');
Route::post('/codesprint/project/legacy/submit', [RoughEventController::class, 'codeSprint2025ProjectSubmission'])->name('codesprint.legacy.project');








//! Admin

// CodeSprint Admin Routes
Route::get('/admin/codesprint/registrations', [RoughEventController::class, 'AdminViewCodeSprint2025Registrations'])->name('admin.codesprint.registrations');
Route::get('/admin/codesprint/registrations/{id}', [RoughEventController::class, 'AdminViewCodeSprint2025RegistrationDetails'])->name('admin.codesprint.registration.details');
Route::put('/admin/codesprint/registrations/{id}/status', [RoughEventController::class, 'AdminUpdateCodeSprint2025RegistrationStatus'])->name('admin.codesprint.registration.status');
Route::delete('/admin/codesprint/registrations/{id}', [RoughEventController::class, 'AdminDeleteCodeSprint2025Registration'])->name('admin.codesprint.registration.delete');
Route::get('/admin/codesprint/export', [RoughEventController::class, 'AdminExportCodeSprint2025Registrations'])->name('admin.codesprint.export');

Route::get('/admin/fests/create', [AdminController::class, 'showCreateFestPage']);
Route::post('/admin/fests/create', [AdminController::class, 'createFest']);


Route::get('/admin/fest/{fest}/event/create', [AdminController::class, 'showCreateEventPage']);
Route::post('/admin/fest/{fest}/event/create', [AdminController::class, 'createEvent']);
Route::get('/admin/fest/{fest}/event/{event}/edit', [EventController::class, 'editEvent']);
Route::post('/admin/fest/{fest}/event/{event}/edit', [EventController::class, 'updateEvent']);

// Event Images Management Routes
Route::get('/admin/fest/{fest}/event/{event}/images', [EventController::class, 'manageEventImages']);
Route::post('/admin/fest/{fest}/event/{event}/images/upload', [EventController::class, 'uploadEventImages']);
Route::delete('/admin/event-image/{imageId}', [EventController::class, 'deleteEventImage']);
Route::put('/admin/event-image/{imageId}/featured', [EventController::class, 'toggleFeaturedImage']);
Route::put('/admin/event-image/{imageId}/order', [EventController::class, 'updateImageOrder']);

Route::get('/admin/fest/{fest}/event/{event}/form', [AdminController::class, 'showFormBuilderPage']);
Route::get('/admin/fest/{fest}/event/{event}/participants', [AdminController::class, 'ShowParticipantsPage']);
Route::get('/admin/fest/{fest}/event/{event}/team/{team}', [AdminController::class, 'individualTeamDetails']);

Route::post('/admin/fest/{fest}/event/{event}/team/{team}/approve', [AdminController::class, 'approveTeam']);
Route::post('/admin/fest/{fest}/event/{event}/team/{team}/reject', [AdminController::class, 'rejectTeam']);


Route::post('/admin/questions/add', [AdminController::class, 'addQuestion']);
Route::get('/admin/questions/delete/{questionId}', [AdminController::class, 'deleteQuestion']);

// web.php
Route::get('/admin/fest/{id}/report', [EventReportController::class, 'generateSummaryReport']);
Route::get('/admin/fest/{id}/report/batch', [EventReportController::class, 'generateBatchCountReport']);
Route::get('/admin/event/{id}/report', [EventReportController::class, 'generate']);
Route::get('/admin/event/{id}/summary', [EventReportController::class, 'generateEventSummaryReport']);
Route::get('/admin/event/{event}/participants', [EventReportController::class, 'generateParticipantListReport']);
Route::get('/admin/event/{id}/csv', [EventReportController::class, 'exportRegistrationQnAAsCSV']);


Route::get('/admin/users', [AdminController::class, 'showAllUserPage']);
Route::get('/admin/user/make/admin/{user}', [AdminController::class, 'AddAdmin']);
Route::get('/admin/user/remove/admin/{user}', [AdminController::class, 'RemoveAdmin']);









//! Route for Registration Close
Route::get('/registration/close', function () {
    return view('frontend.reg_close');
});


//! Fallback route

Route::fallback(function () {
    return view('frontend.404');
});