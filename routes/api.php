<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//投稿
Route::post('/post', [PostController::class,'post']);

//投稿表示
Route::post('/index', [PostController::class,'index']);
//新規登録
Route::post('/register', [UserController::class,'register']);

//いいね
Route::post('/like',[LikeController::class,'like']);

//コメント用取得
Route::get('/comment/{id}',[CommentController::class,'index']);
Route::post('/comment/store',[CommentCOntroller::class,'store']);
Route::get('/post/get/{id}',[CommentCOntroller::class,'get']);
Route::get('/comment/get/{id}',[CommentCOntroller::class,'getComment']);

//削除
Route::post('/delete', [PostController::class,'delete']);
