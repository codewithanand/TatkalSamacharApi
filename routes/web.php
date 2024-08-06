<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('errors')->group(function () {
    Route::get("/unauthorized", [App\Http\Controllers\Errors\ErrorController::class, 'unauthorized'])->name('unauthorized');
});


Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('live-tv')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\LiveTvController::class, 'index'])->name('admin.live-tv');
        Route::post('/create', [App\Http\Controllers\Admin\LiveTvController::class, 'create'])->name('admin.live-tv.create');
        Route::get('/{id}/remove', [App\Http\Controllers\Admin\LiveTvController::class, 'remove'])->name('admin.live-tv.remove');
    });

    Route::prefix('navbars')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\NavbarController::class, 'index'])->name('admin.navbars');
        Route::post('/create', [App\Http\Controllers\Admin\NavbarController::class, 'create'])->name('admin.navbars.create');
        Route::get('/{id}/remove', [App\Http\Controllers\Admin\NavbarController::class, 'remove'])->name('admin.navbars.remove');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users');
        Route::get('/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.users.create');
        Route::post('/create', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.users.store');
        Route::get('/{id}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/{id}/update', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
        Route::get('/{id}/delete', [App\Http\Controllers\Admin\UserController::class, 'delete'])->name('admin.users.delete');
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.categories');
        Route::get('/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/create', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/{id}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/{id}/update', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.categories.update');
        Route::get('/{id}/delete', [App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name('admin.categories.delete');
    });

    Route::prefix('sub-categories')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\SubCategoryController::class, 'index'])->name('admin.sub-categories');
        Route::get('/create', [App\Http\Controllers\Admin\SubCategoryController::class, 'create'])->name('admin.sub-categories.create');
        Route::post('/create', [App\Http\Controllers\Admin\SubCategoryController::class, 'store'])->name('admin.sub-categories.store');
        Route::get('/{id}/edit', [App\Http\Controllers\Admin\SubCategoryController::class, 'edit'])->name('admin.sub-categories.edit');
        Route::put('/{id}/update', [App\Http\Controllers\Admin\SubCategoryController::class, 'update'])->name('admin.sub-categories.update');
        Route::get('/{id}/delete', [App\Http\Controllers\Admin\SubCategoryController::class, 'delete'])->name('admin.sub-categories.delete');
    });

    Route::prefix('tags')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\TagController::class, 'index'])->name('admin.tags');
        Route::get('/create', [App\Http\Controllers\Admin\TagController::class, 'create'])->name('admin.tags.create');
        Route::post('/create', [App\Http\Controllers\Admin\TagController::class, 'store'])->name('admin.tags.store');
        Route::get('/{id}/edit', [App\Http\Controllers\Admin\TagController::class, 'edit'])->name('admin.tags.edit');
        Route::put('/{id}/update', [App\Http\Controllers\Admin\TagController::class, 'update'])->name('admin.tags.update');
        Route::get('/{id}/delete', [App\Http\Controllers\Admin\TagController::class, 'delete'])->name('admin.tags.delete');
    });

    Route::prefix('articles')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\ArticleController::class, 'index'])->name('admin.articles');
        Route::get('/create', [App\Http\Controllers\Admin\ArticleController::class, 'create'])->name('admin.articles.create');
        Route::post('/create', [App\Http\Controllers\Admin\ArticleController::class, 'store'])->name('admin.articles.store');
        Route::get('/{id}/edit', [App\Http\Controllers\Admin\ArticleController::class, 'edit'])->name('admin.articles.edit');
        Route::put('/{id}/update', [App\Http\Controllers\Admin\ArticleController::class, 'update'])->name('admin.articles.update');
        Route::get('/{id}/delete', [App\Http\Controllers\Admin\ArticleController::class, 'delete'])->name('admin.articles.delete');
        Route::get('/{id}/publish', [App\Http\Controllers\Admin\ArticleController::class, 'publish'])->name('admin.articles.publish');
        Route::get('/{id}/unpublish', [App\Http\Controllers\Admin\ArticleController::class, 'unpublish'])->name('admin.articles.unpublish');
    });

    Route::prefix('comments')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\CommentController::class, 'index'])->name('admin.comments');
        Route::get('/create', [App\Http\Controllers\Admin\CommentController::class, 'create'])->name('admin.comments.create');
        Route::post('/create', [App\Http\Controllers\Admin\CommentController::class, 'store'])->name('admin.comments.store');
        Route::get('/{id}/edit', [App\Http\Controllers\Admin\CommentController::class, 'edit'])->name('admin.comments.edit');
        Route::put('/{id}/update', [App\Http\Controllers\Admin\CommentController::class, 'update'])->name('admin.comments.update');
        Route::get('/{id}/delete', [App\Http\Controllers\Admin\CommentController::class, 'delete'])->name('admin.comments.delete');
    });

    Route::prefix('medias')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\MediaController::class, 'index'])->name('admin.medias');
        Route::get('/create', [App\Http\Controllers\Admin\MediaController::class, 'create'])->name('admin.medias.create');
        Route::post('/create', [App\Http\Controllers\Admin\MediaController::class, 'store'])->name('admin.medias.store');
        Route::get('/{id}/edit', [App\Http\Controllers\Admin\MediaController::class, 'edit'])->name('admin.medias.edit');
        Route::put('/{id}/update', [App\Http\Controllers\Admin\MediaController::class, 'update'])->name('admin.medias.update');
        Route::get('/{id}/delete', [App\Http\Controllers\Admin\MediaController::class, 'delete'])->name('admin.medias.delete');
    });
});

