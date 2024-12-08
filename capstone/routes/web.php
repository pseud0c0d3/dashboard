<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateNewUser;




Route::get('/', function () {

    return view('loggedIn.chat');
})->name('index');

Route::post('register', [CreateNewUser::class, 'store'])->name('registration.post');

Route::get('/loggedOut/seemore', function () {
    return view('seemore');
})->name('seemore');

Route::get('/loggedOut/seemore', function () {
    return view('loggedOut/seemore');
})->name('seemore');

