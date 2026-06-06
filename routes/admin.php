<?php

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ContactController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\DashboardController;


Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::resource('projects', ProjectController::class);
Route::resource('skills', SkillController::class);
Route::resource('contacts', ContactController::class)->only(['index', 'destroy']);
Route::get('/about', [AboutController::class, 'edit'])->name('admin.about.edit');
Route::put('/about', [AboutController::class, 'update'])->name('admin.about.update');