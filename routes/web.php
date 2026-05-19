<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use Illuminate\Support\Facades\Route;
//use Inertia\Inertia;

Route::get('/', [PortfolioController::class, 'index']);

Route::get('/projects/{project:slug}', [\App\Http\Controllers\Portfolio\ProjectController::class, 'show'])
    ->name('portfolio.projects.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth');

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(base_path('routes/admin.php'));

Route::post('/contacto', [AdminContactController::class, 'store'])->name('contact.store');


// Route::get('/roles', fn() => Inertia::render('Admin/Roles/Index'));


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/{any}', function () {
//     return view('welcome');
// })->where('any', ".*");
