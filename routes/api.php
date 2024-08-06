<?php

use Illuminate\Support\Facades\Route;

// =============================================================================
//                            AUTHENTICATED API
// =============================================================================
Route::prefix('auth')->middleware(['api'])->group(function () {
    Route::post('register', [App\Http\Controllers\Api\AuthController::class, 'register']);
    Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);
    Route::post('logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::get('me', [App\Http\Controllers\Api\AuthController::class, 'getUser']);
});

Route::prefix('comments')->middleware(['api.auth'])->group(function () {
    Route::post('/create/{article_id}', [App\Http\Controllers\Api\CommentController::class, 'create_comment']);
    Route::put('/update/{comment_id}', [App\Http\Controllers\Api\CommentController::class, 'update_comment']);
    Route::delete('/delete/{comment_id}', [App\Http\Controllers\Api\CommentController::class, 'delete_comment']);
});

Route::delete('/remove-file/{fileId}', [App\Http\Controllers\Api\MediaController::class, 'delete']);


// =============================================================================
//                            PUBLIC API
// =============================================================================
Route::get('/categories', [App\Http\Controllers\Api\CategoryController::class, 'all_categories']);
Route::get('/categories/subcategories', [App\Http\Controllers\Api\CategoryController::class, 'all_categories_with_subcategories']);
Route::get('/categories/articles', [App\Http\Controllers\Api\CategoryController::class, 'all_articles_by_all_categories']);
Route::get('/category/{category}', [App\Http\Controllers\Api\CategoryController::class, 'articles_by_category']);

Route::get('/sub-categories', [App\Http\Controllers\Api\SubCategoryController::class, 'get_all']);
Route::get('/sub-categories/{count}/articles', [App\Http\Controllers\Api\SubCategoryController::class, 'get_by_no_of_articles']);
Route::get('/sub-category/articles/count', [App\Http\Controllers\Api\SubCategoryController::class, 'get_by_article_count']);


Route::get('/search', [App\Http\Controllers\Api\ArticleController::class, 'article_by_title']);
Route::get('/article/{slug}', [App\Http\Controllers\Api\ArticleController::class, 'article_by_slug']);
Route::get('/category/{category_slug}/articles', [App\Http\Controllers\Api\ArticleController::class, 'articles_by_category']);


Route::get('/comments/{article_id}', [App\Http\Controllers\Api\CommentController::class, 'get_comments']);

Route::get('/navbar', [App\Http\Controllers\Api\NavbarController::class, 'index']);

Route::get('/visitor/increment', [App\Http\Controllers\Api\VisitorController::class, 'index']);
Route::get('/visitor/count', [App\Http\Controllers\Api\VisitorController::class, 'get_visitor_count']);
Route::get('/article/{id}/count', [App\Http\Controllers\Api\ArticleController::class, 'update_read_count']);



