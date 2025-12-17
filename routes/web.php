<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\PageContentController;
use App\Http\Controllers\Admin\ResearchController as AdminResearchController;
use App\Http\Controllers\Admin\PatentController as AdminPatentController;
use App\Http\Controllers\Admin\PublicNoticeController as AdminPublicNoticeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\PatentController;
use App\Http\Controllers\PublicNoticeController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sobre', [HomeController::class, 'sobre'])->name('sobre');

// News Routes
Route::get('/noticias', [NewsController::class, 'index'])->name('noticias.index');
Route::get('/noticias/{slug}', [NewsController::class, 'show'])->name('noticias.show');

// Research Routes (Pesquisa)
Route::get('/pesquisa', [ResearchController::class, 'index'])->name('pesquisa.index');
Route::get('/pesquisa/{slug}', [ResearchController::class, 'show'])->name('pesquisa.show');

// Patents Routes (Patentes)
Route::get('/patentes', [PatentController::class, 'index'])->name('patentes.index');
Route::get('/patentes/{slug}', [PatentController::class, 'show'])->name('patentes.show');

// Public Notices Routes (Editais)
Route::get('/editais', [PublicNoticeController::class, 'index'])->name('editais.index');
Route::get('/editais/{slug}', [PublicNoticeController::class, 'show'])->name('editais.show');

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
    
    // Research Management (Pesquisa)
    Route::resource('researches', AdminResearchController::class);
    Route::patch('/researches/{research}/toggle-publish', [AdminResearchController::class, 'togglePublish'])->name('researches.toggle-publish');
    
    // Patents Management (Patentes)
    Route::resource('patents', AdminPatentController::class);
    Route::patch('/patents/{patent}/toggle-publish', [AdminPatentController::class, 'togglePublish'])->name('patents.toggle-publish');
    
    // Public Notices Management (Editais)
    Route::resource('public-notices', AdminPublicNoticeController::class);
    Route::patch('/public-notices/{public_notice}/toggle-publish', [AdminPublicNoticeController::class, 'togglePublish'])->name('public-notices.toggle-publish');
});
