<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateNewUser;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\faqController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\Adminmiddleware;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\LogInController;
use App\Http\Controllers\PostController;




//test
Route::get('/', function () {

     return view('workspace.colormatch');
 })->name('index');
// ->middleware(Adminmiddleware::class);

Route::post('register', [CreateNewUser::class, 'store'])->name('registration.post');


Route::get('/loggedOut/seemore', function () {
    return view('seemore');
})->name('seemore');

Route::get('/loggedOut/seemore', function () {
    return view('loggedOut/seemore');
})->name('seemore');


// Log in
Route::post('/loggedIn/user', [LogInController::class, 'login'])->name('login');

// Log out
Route::post('/', [LogInController::class, 'logout'])->name('logout');

//user routes
Route::get('/loggedIn/user', [HomeController::class,'user'])->name('loggedIn.user');

// Route::get('/loggedIn/user', [HomeController::class, 'user'])->middleware('auth')->name('loggedIn.user');


//activities route
Route::get('/workspace/colormatch', [ActivityController::class, 'colormatch'])->name('workspace.colormatch');
Route::get('/workspace/sonar', [ActivityController::class, 'sonar'])->name('workspace.sonar');

//userprofile routes
Route::get('/loggedIn/userprofile', [UserController::class, 'userprofile'])->name('loggedIn.userprofile');

//userprofile routes
Route::get('/loggedIn/faq', [faqController::class, 'faq'])->name('loggedIn.faq');

//chat routes
Route::get('/loggedIn/chat', [MessageController::class, 'chat'])->name('loggedIn.chat');

//calendar routes
Route::get('/admin/calendar_admin', [CalendarController::class, 'calendar'])->name('admin.calendar_admin');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Avoid reusing 'posts/{post}' for the index route
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// Use resource routes for remaining CRUD actions, excluding index and show
Route::resource('posts', PostController::class)->except(['index', 'show']);

Route::get('/forum', [PostController::class, 'index'])->name('posts.index');

