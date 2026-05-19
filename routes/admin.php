<?php

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ContactController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/dashboard', function () {
    return Inertia::render('Admin/DashboardAdmin');
});

Route::resource('projects', ProjectController::class);
Route::resource('skills', SkillController::class);
Route::resource('contacts', ContactController::class)->only(['index', 'destroy']);