<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ABOULCODE public routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('aboulcode.home');
})->name('aboulcode.home');

Route::get('/projets', function () {
    return view('aboulcode.projects.index');
})->name('aboulcode.projects.index');

Route::get('/services', function () {
    return view('aboulcode.services.index');
})->name('aboulcode.services.index');

Route::get('/blog', function () {
    return view('aboulcode.blog.index');
})->name('aboulcode.blog.index');

Route::get('/a-propos', function () {
    return view('aboulcode.about');
})->name('aboulcode.about');

Route::get('/contact', function () {
    return view('aboulcode.contact');
})->name('aboulcode.contact');

// Admin auth
Route::get('/abouadmin', [\App\Http\Controllers\Aboulcode\AdminAuthController::class, 'showLogin']);
Route::post('/abouadmin/login', [\App\Http\Controllers\Aboulcode\AdminAuthController::class, 'login']);
Route::post('/abouadmin/logout', [\App\Http\Controllers\Aboulcode\AdminAuthController::class, 'logout']);
