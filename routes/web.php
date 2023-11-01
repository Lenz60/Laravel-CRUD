<?php

use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });
Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'isAdmin' => Route::has('admin'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});




Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    return Inertia::render('AdminDashboard');
})->middleware(['auth:admin'])->name('admin.dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'updateAvatar'])->name('profile.update.avatar');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth:admin'])->group(function () {
    // Admin Manage Routes
    Route::get('/admin/manage', [ManageController::class, 'edit'])->name('manage.edit');
    Route::patch('/admin/manage', [ManageController::class, 'update'])->name('manage.update');
    Route::post('/admin/manage', [ManageController::class, 'updateAvatar'])->name('manage.add.member');
    Route::delete('/admin/manage', [ManageController::class, 'destroy'])->name('manage.destroy.member');

    // Admin Profile Routes
    Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/admin/profile', [AdminProfileController::class, 'destroy'])->name('admin.profile.destroy');

    // Add Admin Routes
    Route::get('/admin/add', [ManageController::class, 'addAdminView'])->name('admin.add.admin.view');
    Route::post('/admin/add', [ManageController::class, 'addAdmin'])->name('admin.add.admin.create');
});
require __DIR__.'/auth.php';
