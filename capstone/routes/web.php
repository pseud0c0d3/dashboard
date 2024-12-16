<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateNewUser;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\UserController;




//test
Route::get('/', function () {

    return view('loggedIn.user');
})->name('index');

Route::post('register', [CreateNewUser::class, 'store'])->name('registration.post');

Route::get('/loggedOut/seemore', function () {
    return view('seemore');
})->name('seemore');

Route::get('/loggedOut/seemore', function () {
    return view('loggedOut/seemore');
})->name('seemore');


//activities route
Route::get('/workspace/colormatch', [ActivityController::class, 'colormatch'])->name('workspace.colormatch');
Route::get('/workspace/sonar', [ActivityController::class, 'sonar'])->name('workspace.sonar');

//userprofile routes
Route::get('/loggedIn/userprofile', [UserController::class, 'userprofile'])->name('loggedIn.userprofile');


