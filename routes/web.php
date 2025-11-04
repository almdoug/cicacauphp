<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PageContentController;
use App\Http\Controllers\Auth\LoginController;
use App\Models\PageContent;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    $contents = PageContent::getPageContents('home');
    return view('welcome', compact('contents'));
})->name('home');

Route::get('/sobre', function () {
    $contents = PageContent::getPageContents('sobre');
    return view('sobre', compact('contents'));
})->name('sobre');

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes (Protected)
Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Page Content Management
    Route::get('/pages', [AdminController::class, 'pages'])->name('admin.pages.index');
    Route::get('/pages/{page}/edit', [PageContentController::class, 'edit'])->name('admin.pages.edit');
    Route::put('/pages/{page}', [PageContentController::class, 'update'])->name('admin.pages.update');
});
