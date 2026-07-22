<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ABOULCODE public routes
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Aboulcode\PublicController;

Route::get('/', [PublicController::class, 'home'])->name('aboulcode.home');
Route::get('/projets', [PublicController::class, 'projects'])->name('aboulcode.projects.index');
Route::get('/services', [PublicController::class, 'services'])->name('aboulcode.services.index');
Route::get('/blog', [PublicController::class, 'blog'])->name('aboulcode.blog.index');
Route::get('/a-propos', [PublicController::class, 'about'])->name('aboulcode.about');
Route::get('/contact', [PublicController::class, 'contactForm'])->name('aboulcode.contact');
Route::post('/contact', [PublicController::class, 'submitContact'])->name('aboulcode.contact.submit');

// Admin auth
Route::get('/abouadmin', [\App\Http\Controllers\Aboulcode\AdminAuthController::class, 'showLogin']);
Route::post('/abouadmin/login', [\App\Http\Controllers\Aboulcode\AdminAuthController::class, 'login']);
Route::post('/abouadmin/logout', [\App\Http\Controllers\Aboulcode\AdminAuthController::class, 'logout']);
