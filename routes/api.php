<?php

use App\Http\Controllers\Api\BasePlanController;
use App\Http\Controllers\Api\BasePlanSpecificationController;
use App\Http\Controllers\Api\ConsultationUserController;
use App\Http\Controllers\Api\SpecificationController;
use App\Http\Controllers\Api\SpecificationMeisaiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// ベースプランAPI
Route::get('base-plans', [BasePlanController::class, 'index']);

// 仕様API
Route::apiResource('specifications', SpecificationController::class);

// 仕様明細API
Route::get('specifications/{specification}/meisai', [SpecificationMeisaiController::class, 'index']);
Route::post('specifications/{specification}/meisai', [SpecificationMeisaiController::class, 'store']);
Route::put('specifications/meisai/{meisai}', [SpecificationMeisaiController::class, 'update']);
Route::delete('specifications/meisai/{meisai}', [SpecificationMeisaiController::class, 'destroy']);

// ベースプランと仕様の関連付けAPI
Route::get('base-plans/{basePlan}/specifications', [BasePlanSpecificationController::class, 'index']);
Route::post('base-plans/{basePlan}/specifications', [BasePlanSpecificationController::class, 'store']);
Route::delete('base-plan-specifications/{basePlanSpecification}', [BasePlanSpecificationController::class, 'destroy']);

// 相談ユーザーAPI
Route::apiResource('consultation-users', ConsultationUserController::class)->except(['update', 'destroy']);
