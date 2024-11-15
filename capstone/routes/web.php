<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('workspace/colormatch');
});

Route::get('/loggedOut/seemore', function () {
    return view('loggedOut/seemore');
})->name('loggedOut/seemore');

Route::get('/loggedOut/seemore', function () {
    return view('loggedOut/seemore');
})->name('loggedOut/seemore');
