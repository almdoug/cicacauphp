<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\PageContentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NewsController;
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

// News Routes
Route::get('/noticias', [NewsController::class, 'index'])->name('noticias.index');
Route::get('/noticias/{slug}', [NewsController::class, 'show'])->name('noticias.show');

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes (Protected)
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Page Content Management
    Route::get('/pages', [AdminController::class, 'pages'])->name('pages.index');
    Route::get('/pages/{page}/edit', [PageContentController::class, 'edit'])->name('pages.edit');
    Route::put('/pages/{page}', [PageContentController::class, 'update'])->name('pages.update');
    
    // News Management
    Route::resource('news', AdminNewsController::class);
    Route::patch('/news/{news}/toggle-publish', [AdminNewsController::class, 'togglePublish'])->name('news.toggle-publish');
});
