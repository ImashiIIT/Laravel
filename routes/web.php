<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home and Dashboard Routes
Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// User Routes
Route::resource('users', UserController::class);
Route::get('users/{userId}/delete', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('users', [UserController::class, 'index'])->name('users.index');

// Role Routes
Route::resource('roles', RoleController::class);
Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy'])->name('roles.destroy');
Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole'])->name('roles.addPermission');
Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole'])->name('roles.givePermission');
Route::get('/roles', [RoleController::class, 'index'])->name('role.index');

// Permission Routes
Route::resource('permission', PermissionController::class);
Route::get('permission/{permissionId}/delete', [PermissionController::class, 'destroy'])->name('permission.destroy');
Route::get('/permission', [PermissionController::class, 'index'])->name('permission.index');

// Category Routes
Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('categories/create', [CategoryController::class, 'store'])->name('categories.store');
Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('categories/{id}/edit', [CategoryController::class, 'update'])->name('categories.update');
Route::get('categories/{id}/delete', [CategoryController::class, 'destroy'])->name('categories.destroy');

// Authentication Routes
Auth::routes();

require __DIR__ . '/auth.php';
