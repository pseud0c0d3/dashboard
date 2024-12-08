<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateNewUser;



//test
Route::get('/', function () {

    return view('workspace.sonar');
})->name('index');

Route::post('register', [CreateNewUser::class, 'store'])->name('registration.post');

Route::get('/loggedOut/seemore', function () {
    return view('seemore');
})->name('seemore');

Route::get('/loggedOut/seemore', function () {
    return view('loggedOut/seemore');
})->name('seemore');

