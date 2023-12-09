<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
// PAGES
Route::get('/', [PageController::class, 'index']);
Route::get('/auth', [AuthController::class, 'index']);

Route::get("/item", [PageController::class, 'item']);
Route::get("/item/create", function () {
  return view('item.create');
});

Route::get("/category", [PageController::class, 'category']);
Route::get("/category/create", function () {
  return view('category.create');
});

Route::get("/user", [PageController::class, 'user']);

// BACKEND AUTH
Route::post('/auth', [AuthController::class, 'auth']);

// BACKEND ITEM
Route::get("/api/item", [ItemController::class, 'index']);
Route::post("/api/item", [ItemController::class, 'createItem']);
Route::patch("/api/item/{id}", [ItemController::class, 'updateItem']);
Route::delete("/api/item/{id}", [ItemController::class, 'deleteItem']);

// BACKEND CATEGORY
Route::get("/api/category", [CategoryController::class, 'index']);
Route::post("/api/category", [CategoryController::class, 'createCategory']);
Route::patch("/api/category/{id}", [CategoryController::class, 'updateCategory']);
Route::delete("/api/category/{id}", [CategoryController::class, 'deleteCategory']);

Route::get('/article', [ArticleController::class, 'article']);
Route::post('/article', [ArticleController::class, 'createArticle']);
Route::patch('/article/{key}', [ArticleController::class, 'updateArticle']);
Route::delete('/article/{key}', [ArticleController::class, 'deleteArticle']);
