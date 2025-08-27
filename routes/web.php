<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Route;

Route::get('/',function () {
    return view('index');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [SignupController::class, 'showSignupForm'])->name('signup');
Route::post('/register', [SignupController::class, 'signup'])->name('signup.post');

Route::get('/blog', [BlogController::class, 'index'])->name('blogs');

Route::get('/blog/create', [BlogController::class, 'showCreateForm'])->name('blog.create.show');
Route::post('/blog/create', [BlogController::class, 'create'])->name('blog.create');

Route::get('/blog/edit', [BlogController::class, 'showEditForm'])->name('blog.edit.show');
Route::post('/blog/edit', [BlogController::class, 'edit'])->name('blog.edit');

Route::delete('/blog/delete', [BlogController::class, 'destroy'])->name('blog.destroy');