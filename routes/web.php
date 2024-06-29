<?php

use App\Http\Controllers\HomeInspectionDocumentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeInspectionDocumentController::class, 'index']);
Route::post('/generate-report', [HomeInspectionDocumentController::class, 'generateReport']);
