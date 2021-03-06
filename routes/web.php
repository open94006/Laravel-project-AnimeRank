<?php

use App\Http\Middleware\authadmin;
use App\Http\Controllers\animeListController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\RankController;
use App\Http\Controllers\TellusController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::group(['prefix' => 'animeList', 'middleware' => authadmin::class], function () {
    # 動畫CRUD
    Route::get('/', [animeListController::class, 'index'])->name('animeList.index');
    Route::get('/show/{id}', [animeListController::class, 'show'])->name('animeList.show');
    Route::get('/create', [animeListController::class, 'create'])->name('animeList.create');
    Route::post('/store', [animeListController::class, 'store'])->name('animeList.store');
    Route::put('/show/{id}', [animeListController::class, 'update'])->name('animeList.update');
    Route::delete('/delete/{id}', [animeListController::class, 'destroy'])->name('animeList.destroy');

    # api
    Route::get('/jidu/{jidu}', [animeListController::class, 'Animejidu'])->name('animeList.jidu');
    Route::get('/search/{word?}', [animeListController::class, 'AnimeSearch'])->name('animeList.Search');
});

Route::group(['prefix' => 'auth'], function () {
    # 會員登入&註冊
    Route::get('/login', [UserAuthController::class, 'login'])->name('auth.login');
    Route::get('/register', [UserAuthController::class, 'register'])->name('auth.register');
    Route::post('/create', [UserAuthController::class, 'create'])->name('auth.create');
    Route::post('/check', [UserAuthController::class, 'check'])->name('auth.check');
    Route::get('/logout', [UserAuthController::class, 'logout'])->name('auth.logout');
});

Route::group(['prefix' => 'rank', 'middleware' => authadmin::class], function () {
    # 排行榜頁面
    Route::get('/', [RankController::class, 'index'])->name('rank.index');

    # 取得年份api
    Route::get('/{year}', [RankController::class, 'getanimeYear'])->name('rank.year');
});

Route::group(['prefix' => 'tellus'], function () {
    #意見箱頁面
    Route::get('/', [TellusController::class, 'index'])->name('tellus.index');
    Route::post('/store', [TellusController::class, 'store'])->name('tellus.store');
});