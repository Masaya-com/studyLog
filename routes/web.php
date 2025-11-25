<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudyLogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Breeze の認証まわり（/login, /register）は auth.php にまとめてあります。
| ここでは認証後のダッシュボード・学習ログのルートを定義します。
|
*/

// ▼▼ 認証不要のトップページ ▼▼
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin'      => Route::has('login'),
        'canRegister'   => Route::has('register'),
        'laravelVersion'=> Application::VERSION,
        'phpVersion'    => PHP_VERSION,
    ]);
});

// ▼▼ 認証が必要なページ ▼▼
Route::middleware(['auth', 'verified'])->group(function () {

    // ダッシュボード（グラフ・合計時間など「見る専用」）
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // 学習ログ一覧（一覧テーブル）
    Route::get('/study', [StudyLogController::class, 'index'])
        ->name('study.index');

    // 学習ログ登録ページ（フォーム）
    Route::get('/study/create', [StudyLogController::class, 'create'])
        ->name('study.create');

    // 学習ログ登録処理
    Route::post('/study', [StudyLogController::class, 'store'])
        ->name('study.store');
});

// ▼▼ プロフィール（Breeze 標準） ▼▼
Route::middleware('auth')->group(function () {
    Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ▼▼ Breeze デフォルト認証ルート（login / register など） ▼▼
require __DIR__.'/auth.php';
