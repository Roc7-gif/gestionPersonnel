<?php

use App\Http\Controllers\UserAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front.home');
})->name('home');

// Route::get('/infos', function () {
//     return view('front.infosEvent');
// })->name('events');

// Route::get('/nomine', function () {
//     return view('front.nomine');
// })->name('nomine');

// Route::get('/achat-ticket', function () {
//     return view('front.acheter');
// })->name('achatticket');

// Route::get('/voter', function () {
//     return view('front.voter');
// })->name('votermtn');

// Route::get('/login', function () {
//     return view('front.login');
// })->name('login');

// Route::get('/register', App\Http\Controllers\UserAuthController->showregister())->name('register');
