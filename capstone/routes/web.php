<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateNewUser;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\Adminmiddleware;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\LogInController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
<<<<<<< HEAD
=======
use App\Http\Controllers\EmployeeController;
>>>>>>> 50b82802c6ad77379f914eba9d899dd58b8220ff
use Spatie\GoogleCalendar\Event;



// Test route
Route::get('/', function () {
<<<<<<< HEAD
    return view('loggedOut.index');
=======
    return view('loggedOut.index');
>>>>>>> 50b82802c6ad77379f914eba9d899dd58b8220ff
 })->name('index');
// ->middleware(Adminmiddleware::class);

// Admin Calendar route
Route::post('/admin/calendar', [AdminController::class, 'store'])->name('calendar.store');

// Registration route
Route::post('register', [CreateNewUser::class, 'store'])->name('registration.post');


Route::get('/loggedOut/seemore', function () {
    return view('loggedOut.seemore');
})->name('seemore');

// Log in and Log out routes
Route::post('/loggedIn/user', [LogInController::class, 'login'])->name('login');
Route::post('/', [LogInController::class, 'logout'])->name('logout');

// User routes
Route::get('/loggedIn/user', [UserController::class, 'user'])->name('loggedIn.user');
Route::get('/admin/adminforum', [AdminController::class, 'adminforum'])->name('admin.adminforum');
Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

// Employee routes
Route::get('/employee/EmployeeChat', [EmployeeController::class, 'EmployeeChat'])->name('employee.EmployeeChat');
Route::get('/employee/EmployeeCalendar', [EmployeeController::class, 'EmployeeCalendar'])->name('employee.EmployeeCalendar');
Route::get('/employee/EmployeeForum', [EmployeeController::class, 'EmployeeForum'])->name('employee.EmployeeForum');

// Activities routes
Route::get('/workspace/colormatch', [UserController::class, 'colormatch'])->name('workspace.colormatch');
Route::get('/workspace/game', [UserController::class, 'game'])->name('workspace.game');

// User profile routes
Route::get('/loggedIn/userprofile', [UserController::class, 'userprofile'])->name('loggedIn.userprofile');
Route::get('/loggedIn/faq', [UserController::class, 'faq'])->name('loggedIn.faq');

// Chat routes
Route::get('/loggedIn/chat', [MessageController::class, 'chat'])->name('loggedIn.chat');
Route::get('/loggedIn/adminchat', [MessageController::class, 'adminchat'])->name('loggedIn.adminchat');


//calendar routes
Route::get('/admin/calendar_admin', [AdminController::class, 'calendar'])->name('admin.calendar_admin');
Route::get('/loggedIn/calendar_user', [UserController::class, 'calendar_user'])->name('loggedIn.calendar_user');


Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Avoid reusing 'posts/{post}' for the index route
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// Use resource routes for remaining CRUD actions, excluding index and show
Route::resource('/posts', PostController::class)->except(['index', 'show']);

// Route::get('/forum', [PostController::class, 'index'])->name('posts.index');

// para mag reflect sa fullcalendar yung ginawa sa gcalendar
Route::get('/admin/get-google-calendar-events', [AdminController::class, 'getGoogleCalendarEvents']);



// Calendar routes
Route::get('/admin/calendar_admin', [AdminController::class, 'calendar'])->name('admin.calendar_admin');
Route::get('/loggedIn/calendar_user', [userController::class, 'calendar_user'])->name('loggedIn.calendar_user');
Route::get('/admin/get-google-calendar-events', [AdminController::class, 'getGoogleCalendarEvents']);

// Posts routes
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::resource('/posts', PostController::class)->except(['index', 'show']);

