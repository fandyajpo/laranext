<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
// PAGES
Route::get('/', [ArticleController::class, 'index']);
Route::get('/article', [ArticleController::class, 'article']);

// BACKEND
Route::post('/article', [ArticleController::class, 'createArticle']);
Route::patch('/article/{key}', [ArticleController::class, 'updateArticle']);
Route::delete('/article/{key}', [ArticleController::class, 'deleteArticle']);
