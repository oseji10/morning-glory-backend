<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ConsultationController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ProposalController;
use App\Http\Controllers\Api\InsightController;
use App\Http\Controllers\Api\CaseStudyController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\NewsletterController;
use App\Http\Controllers\Api\TrainingApplicationController;

/*
|--------------------------------------------------------------------------
| API Routes — Morning Glory Consulting
|--------------------------------------------------------------------------
| All routes are prefixed with /api by Laravel's RouteServiceProvider.
*/

// Lead-generation forms (mirrors "BOOK A CONSULTATION" / "REQUEST A PROPOSAL")
Route::post('/consultations', [ConsultationController::class, 'store']);
Route::post('/proposals', [ProposalController::class, 'store']);
Route::post('/contact', [ContactController::class, 'store']);
Route::post('/newsletter', [NewsletterController::class, 'store']);
Route::post('/training-applications', [TrainingApplicationController::class, 'store']);

// Public content
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/services/{slug}', [ServiceController::class, 'show']);

Route::get('/case-studies', [CaseStudyController::class, 'index']);
Route::get('/case-studies/{slug}', [CaseStudyController::class, 'show']);

Route::get('/insights', [InsightController::class, 'index']);
Route::get('/insights/{slug}', [InsightController::class, 'show']);

// Admin (protected) — manage submissions & content
Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    Route::get('/consultations', [ConsultationController::class, 'index']);
    Route::patch('/consultations/{consultation}', [ConsultationController::class, 'update']);

    Route::get('/proposals', [ProposalController::class, 'index']);
    Route::get('/contact-messages', [ContactController::class, 'index']);

    Route::get('/training-applications', [TrainingApplicationController::class, 'index']);
    Route::patch('/training-applications/{trainingApplication}', [TrainingApplicationController::class, 'update']);

    Route::apiResource('/insights', InsightController::class)->except(['index', 'show']);
    Route::apiResource('/case-studies', CaseStudyController::class)->except(['index', 'show']);
    Route::apiResource('/services', ServiceController::class)->except(['index', 'show']);
});
