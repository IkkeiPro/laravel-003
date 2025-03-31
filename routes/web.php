<?php

use App\Http\Controllers\Admin\BasePlanController as AdminBasePlanController;
use App\Http\Controllers\Admin\BasePlanSpecificationController as AdminBasePlanSpecificationController;
use App\Http\Controllers\Admin\ConsultationUserController as AdminConsultationUserController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\SpecificationController as AdminSpecificationController;
use App\Http\Controllers\Admin\SpecificationMeisaiController as AdminSpecificationMeisaiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return Inertia::render('Quotation/Index');
});

// 管理画面ルート (WorkOS AuthKit Authentication 使用を前提)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    // ダッシュボード
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // 問い合わせユーザー管理
    Route::get('/consultation-users', [AdminConsultationUserController::class, 'index'])->name('consultation-users.index');
    Route::get('/consultation-users/{consultationUser}', [AdminConsultationUserController::class, 'show'])->name('consultation-users.show');

    // ベースプラン管理
    Route::resource('base-plans', AdminBasePlanController::class);

    // 仕様管理
    Route::resource('specifications', AdminSpecificationController::class);

    // 仕様明細管理
    Route::post('/specifications/{specification}/meisai', [AdminSpecificationMeisaiController::class, 'store'])->name('specifications.meisai.store');
    Route::put('/specifications/meisai/{meisai}', [AdminSpecificationMeisaiController::class, 'update'])->name('specifications.meisai.update');
    Route::delete('/specifications/meisai/{meisai}', [AdminSpecificationMeisaiController::class, 'destroy'])->name('specifications.meisai.destroy');

    // ベースプランと仕様の関連付け管理
    Route::get('/base-plan-specifications', [AdminBasePlanSpecificationController::class, 'index'])->name('base-plan-specifications.index');
    Route::post('/base-plan-specifications', [AdminBasePlanSpecificationController::class, 'store'])->name('base-plan-specifications.store');
    Route::delete('/base-plan-specifications/{basePlanSpecification}', [AdminBasePlanSpecificationController::class, 'destroy'])->name('base-plan-specifications.destroy');
});

// Breezeデフォルトルート
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
