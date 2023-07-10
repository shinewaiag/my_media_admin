<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrendPostController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    //admin
    Route::get('/dashboard', [ProfileController::class,'index'])->name('dashboard');
    Route::post('admin/update', [ProfileController::class,'updateAdmin'])->name('admin#updateAdmin');
    Route::get('admin/password', [ProfileController::class,'password'])->name('admin#password');
    Route::post('admin/changePassword', [ProfileController::class,'changePassword'])->name('admin#changePassword');

    //admin list
    Route::get('admin/list', [ListController::class, 'index'])->name('admin#list');
    Route::get('admin/list/delete/{id}', [listController::class, 'delete'])->name('admin#delete');
    Route::post('admin/list/search', [listController::class, 'search'])->name('admin#search');

    //admin category
    Route::get('admin/category', [CategoryController::class, 'index'])->name('admin#category');
    Route::post('admin/category/create', [CategoryController::class, 'createCategory'])->name('admin#createCategory');
    Route::get('admin/category/delete/{id}', [CategoryController::class,'deleteCategory'])->name('admin#deleteCategory');
    Route::post('admin/category/search', [CategoryController::class, 'searchCategory'])->name('admin#searchCategory');
    Route::get('admin/category/editPage/{id}', [CategoryController::class, 'categoryEditPage'])->name('admin#categoryEditPage');
    Route::post('admin/category/update/{id}', [CategoryController::class, 'updateCategory'])->name('admin#updateCategory');

    //admin posts
    Route::get('admin/post', [PostController::class, 'index'])->name('admin#post');
    Route::post('admin/post/create', [PostController::class, 'createPost'])->name('admin#createPost');
    Route::get('admin/post/delete/{id}', [PostController::class, 'deletePost'])->name('admin#deletePost');
    Route::get('admin/post/edit/{id}', [PostController::class, 'editPost'])->name('admin#editPost');
    Route::post('admin/post/update/{id}', [PostController::class, 'updatePost'])->name('admin#updatePost');

    //admin trending post
    Route::get('admin/trendPost', [TrendPostController::class, 'index'])->name('admin#trendPost');
    Route::get('trendPost/details/{id}', [TrendPostController::class, 'details'])->name('admin#details');
});
