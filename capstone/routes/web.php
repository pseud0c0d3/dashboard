<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return view('loggedOut.index');

Route::get('/loggedOut/seemore', function () {
    return view('loggedOut/seemore');
})->name('seemore');

Route::get('/loggedOut/seemore', function () {
    return view('loggedOut/seemore');
})->name('loggedOut/seemore');

