<?php
use Illuminate\Support\Facades\Route;
use AhmadIshtiaq\ComfykureAlerts\Http\Controllers\AlertEmailController;

Route::middleware(['web'])->group(function () {
    Route::get('comfykure-alerts/emails', [AlertEmailController::class, 'index']);
    Route::post('comfykure-alerts/emails', [AlertEmailController::class, 'store']);
    Route::delete('comfykure-alerts/emails/{id}', [AlertEmailController::class, 'destroy']);
});
