<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateNewUser;
use App\Http\Controllers\ActivityController;



//test
Route::get('/', function () {

    return view('loggedIn.calendar');
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

