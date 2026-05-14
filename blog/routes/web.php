<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/test', function () {
//     // return view('welcome');
//     return 'Hello text';
// });

// Route::get('/posts', function ($id) {
//     // return view('welcome');
//     return 'Hello text with ID: ' . $id;
// });

// Route::get('/test/{id?}', function ($id = null) {
//     // return view('welcome');
//     return $id ? 'Hello text with ID: ' . $id : 'Hello text without ID';
// });

///posts/create
Route::get('/posts' , [PostController::class , 'index'])->name('posts.index');
Route::get('/posts/{id}' , [PostController::class , 'show'])->name('posts.show')->where('id', '[0-9]+');
Route::get('/posts/create' , [PostController::class , 'create'])->name('posts.create');
Route::post('/posts' , [PostController::class , 'store'])->name('posts.store');
// Route::post('/posts' , [PostController::class , 'store']);

// Route::prefix('posts')->group(function () {
//     Route::get('/' , [PostController::class , 'index'])->name('admin.posts.index');
//     Route::get('/{id}' , [PostController::class , 'show'])->name('admin.posts.show')->where('id', '[0-9]+');
//     Route::get('/create' , [PostController::class , 'create'])->name('admin.posts.create');
//     Route::post('' , [PostController::class , 'store'])->name('admin.posts.store');
// });

Route::resource('users', UserController::class);

// Route::resource('posts', PostController::class);