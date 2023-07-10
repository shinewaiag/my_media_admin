<?php

use App\Http\Controllers\Api\ActionLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('user/register', [AuthController::class, 'register']);
Route::post('user/login', [AuthController::class, 'login']);

Route::get('category',[AuthController::class, 'categoryList'])->middleware('auth:sanctum');

//get post
Route::get('posts',[PostController::class, 'posts']);
Route::post('/posts/search', [PostController::class, 'search']);
Route::post('/posts/details', [PostController::class, 'details']);

//get category
Route::get('/categories', [CategoryController::class, 'categories']);
Route::post('/categories/search', [CategoryController::class, 'search']);

//action log
Route::post('post/actionLog', [ActionLogController::class, 'setActionLog']);
