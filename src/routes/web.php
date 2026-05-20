<?php

use Illuminate\Support\Facades\Route;
use AhmadIshtiaq\ComfykureAlerts\Http\Controllers\AlertEmailController;

Route::middleware(['web'])->group(function () {
    // 1. Listing Page (Sirf Registered Emails Dekhne Ke Liya)
    Route::get('comfykure-alerts/emails', [AlertEmailController::class, 'index']);
    
    // 2. Add Form Page (Jahan Nayi Email Ka Form Hoga)
    Route::get('comfykure-alerts/emails/create', [AlertEmailController::class, 'create']);
    Route::post('comfykure-alerts/emails', [AlertEmailController::class, 'store']);
    
    // 3. Edit & Update Pages (Email Change Karne Ke Liya)
    Route::get('comfykure-alerts/emails/{id}/edit', [AlertEmailController::class, 'edit']);
    Route::put('comfykure-alerts/emails/{id}', [AlertEmailController::class, 'update']);
    
    // 4. Delete Route
    Route::delete('comfykure-alerts/emails/{id}', [AlertEmailController::class, 'destroy']);
});