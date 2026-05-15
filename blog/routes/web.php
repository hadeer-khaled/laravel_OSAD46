<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

///posts/create

// Route::post('/posts' , [PostController::class , 'store']);

// Route::prefix('posts')->group(function () {
//     Route::get('/' , [PostController::class , 'index'])->name('admin.posts.index');
//     Route::get('/{id}' , [PostController::class , 'show'])->name('admin.posts.show')->where('id', '[0-9]+');
//     Route::get('/create' , [PostController::class , 'create'])->name('admin.posts.create');
//     Route::post('' , [PostController::class , 'store'])->name('admin.posts.store');
// });



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/posts' , [PostController::class , 'index'])->name('posts.index');
    Route::get('/posts/{id}' , [PostController::class , 'show'])->name('posts.show')->where('id', '[0-9]+');
    Route::get('/posts/create' , [PostController::class , 'create'])->name('posts.create');
    Route::post('/posts' , [PostController::class , 'store'])->name('posts.store');
    Route::delete('/posts/{post}' , [PostController::class , 'destroy'])->name('posts.destroy');

    Route::post('/posts/{post}/comments' , [PostController::class , 'addComment'])->name('posts.comments.store');

    // Route::resource('users', UserController::class);

    Route::prefix('users')->group(function () {
        Route::get('/' , [UserController::class , 'index'])->name('users.index')->middleware('admin');
        Route::get('/{id}' , [UserController::class , 'show'])->name('users.show')->where('id', '[0-9]+');
        Route::get('/create' , [UserController::class , 'create'])->name('users.create');
        Route::post('' , [UserController::class , 'store'])->name('users.store');
    });

});

require __DIR__.'/auth.php';
