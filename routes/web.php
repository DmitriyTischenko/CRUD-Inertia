<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return inertia('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return inertia('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
Route::get('/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
Route::get('/posts/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('post.show');
Route::post('/posts', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
Route::get('/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
Route::patch('/posts/{post}', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');
Route::delete('/posts/{post}', [App\Http\Controllers\PostController::class, 'delete'])->name('post.delete');

require __DIR__.'/auth.php';
