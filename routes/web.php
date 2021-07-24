<?php

use App\Http\Controllers\{DashboardController, NewsCategoryController, NewsPostController, NewsTagController, UserController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('two-factor-recovery', function () {
    return view('auth.two-factor-recovery');
})->name('two-factor-recovery');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::prefix('news')->name('news.')->group(function () {
        Route::middleware(['auth.isAdministrator'])->group(function () {
            Route::prefix('categories')->name('categories.')->group(function () {
                Route::get('', [NewsCategoryController::class, 'index'])->name('index');
                Route::get('create', [NewsCategoryController::class, 'create'])->name('create');
                Route::post('', [NewsCategoryController::class, 'store'])->name('store');
                Route::get('edit/{news_category:slug}', [NewsCategoryController::class, 'edit'])->name('edit');
                Route::put('{news_category:slug}', [NewsCategoryController::class, 'update'])->name('update');
                Route::delete('{news_category:slug}', [NewsCategoryController::class, 'destroy'])->name('destroy');
            });
            Route::prefix('tags')->name('tags.')->group(function () {
                Route::get('', [NewsTagController::class, 'index'])->name('index');
                Route::get('create', [NewsTagController::class, 'create'])->name('create');
                Route::post('', [NewsTagController::class, 'store'])->name('store');
                Route::get('edit/{news_tag:slug}', [NewsTagController::class, 'edit'])->name('edit');
                Route::put('{news_tag:slug}', [NewsTagController::class, 'update'])->name('update');
                Route::delete('{news_tag:slug}', [NewsTagController::class, 'destroy'])->name('destroy');
            });
        });
        Route::prefix('posts')->name('posts.')->group(function () {
            Route::get('', [NewsPostController::class, 'index'])->name('index');
            Route::middleware(['auth.isAuthor'])->group(function () {
                Route::get('create', [NewsPostController::class, 'create'])->name('create');
                Route::post('', [NewsPostController::class, 'store'])->name('store');
            });
            Route::get('edit/{news_post:slug}', [NewsPostController::class, 'edit'])->name('edit');
            Route::put('{news_post:slug}', [NewsPostController::class, 'update'])->name('update');
            Route::delete('{news_post:slug}', [NewsPostController::class, 'destroy'])->name('destroy');
        });
    });

    Route::prefix('users')->middleware(['auth.isAdministrator'])->name('users.')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('index');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('', [UserController::class, 'store'])->name('store');
        Route::get('edit/{user}', [UserController::class, 'edit'])->name('edit');
        Route::put('{user}', [UserController::class, 'update'])->name('update');
        Route::delete('{user}', [UserController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('user')->name('user-')->group(function () {
        Route::get('profile-information', function () {
            return view('app.user.profile-information');
        })->name('profile-information');
        Route::get('password', function () {
            return view('app.user.password');
        })->name('password');
        Route::get('two-factor-authentication', function () {
            return view('app.user.two-factor-authentication');
        })->name('two-factor-authentication');
    });
});
