<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\PageContentController;
use App\Http\Controllers\Admin\ResearchController as AdminResearchController;
use App\Http\Controllers\Admin\PatentController as AdminPatentController;
use App\Http\Controllers\Admin\PublicNoticeController as AdminPublicNoticeController;
use App\Http\Controllers\Admin\ProductionCostController as AdminProductionCostController;
use App\Http\Controllers\Admin\MarketDataController as AdminMarketDataController;
use App\Http\Controllers\Admin\CourseEventController as AdminCourseEventController;
use App\Http\Controllers\Admin\InterviewController as AdminInterviewController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ResearchController;
use App\Http\Controllers\PatentController;
use App\Http\Controllers\PublicNoticeController;
use App\Http\Controllers\ProductionCostController;
use App\Http\Controllers\MarketDataController;
use App\Http\Controllers\CourseEventController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

// API Routes com Rate Limiting
Route::get('/api/search', [SearchController::class, 'search'])
    ->middleware('throttle:60,1')
    ->name('api.search');

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sobre', [HomeController::class, 'sobre'])->name('sobre');
Route::get('/cookies', [HomeController::class, 'cookies'])->name('cookies');
Route::get('/politica-privacidade', [HomeController::class, 'privacidade'])->name('privacidade');
Route::get('/termos-uso', [HomeController::class, 'termos'])->name('termos');

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

// Production Costs Routes (Custos de Produção)
Route::get('/custos', [ProductionCostController::class, 'index'])->name('custos.index');
Route::get('/custos/{slug}', [ProductionCostController::class, 'show'])->name('custos.show');
Route::get('/custos/{slug}/export/{type?}', [ProductionCostController::class, 'export'])->name('custos.export');

// Market Data Routes (Mercado Nacional e Internacional)
Route::get('/mercado', [MarketDataController::class, 'index'])->name('mercado.index');
Route::get('/mercado/{slug}', [MarketDataController::class, 'show'])->name('mercado.show');
Route::get('/mercado/{slug}/export', [MarketDataController::class, 'export'])->name('mercado.export');

// Courses and Events Routes (Cursos e Eventos)
Route::get('/cursos-eventos', [CourseEventController::class, 'index'])->name('cursos-eventos.index');
Route::get('/cursos-eventos/{slug}', [CourseEventController::class, 'show'])->name('cursos-eventos.show');

// Interviews Routes (Entrevistas)
Route::get('/entrevistas', [InterviewController::class, 'index'])->name('entrevistas.index');
Route::get('/entrevistas/{slug}', [InterviewController::class, 'show'])->name('entrevistas.show');

// Contact Routes (Contato)
Route::get('/contato', [ContactController::class, 'index'])->name('contato');
Route::post('/contato', [ContactController::class, 'send'])->name('contato.send');

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes (Protected)
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // User Management (Only superadmin)
    Route::middleware(['role:superadmin'])->group(function () {
        Route::resource('users', AdminUserController::class)->except(['show']);
        Route::get('/users/{user}/change-password', [AdminUserController::class, 'changePassword'])->name('users.change-password');
        Route::put('/users/{user}/update-password', [AdminUserController::class, 'updatePassword'])->name('users.update-password');
    });
    
    // Page Content Management (Admin and Superadmin only)
    Route::middleware(['role:admin,superadmin'])->group(function () {
        Route::get('/pages', [AdminController::class, 'pages'])->name('pages.index');
        Route::get('/pages/{page}/edit', [PageContentController::class, 'edit'])->name('pages.edit');
        Route::put('/pages/{page}', [PageContentController::class, 'update'])->name('pages.update');
    });
    
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
    
    // Production Costs Management (Custos de Produção)
    Route::resource('production-costs', AdminProductionCostController::class);
    Route::patch('/production-costs/{production_cost}/toggle-publish', [AdminProductionCostController::class, 'togglePublish'])->name('production-costs.toggle-publish');
    Route::get('/production-costs/{production_cost}/export/{type?}', [AdminProductionCostController::class, 'export'])->name('production-costs.export');
    
    // Market Data Management (Mercado Nacional e Internacional)
    Route::resource('market-data', AdminMarketDataController::class);
    Route::patch('/market-data/{market_datum}/toggle-publish', [AdminMarketDataController::class, 'togglePublish'])->name('market-data.toggle-publish');
    Route::get('/market-data/{market_datum}/export', [AdminMarketDataController::class, 'export'])->name('market-data.export');
    
    // Courses and Events Management (Cursos e Eventos)
    Route::resource('courses-events', AdminCourseEventController::class);
    Route::patch('/courses-events/{courses_event}/toggle-publish', [AdminCourseEventController::class, 'togglePublish'])->name('courses-events.toggle-publish');
    
    // Interviews Management (Entrevistas)
    Route::resource('interviews', AdminInterviewController::class);
    Route::patch('/interviews/{interview}/toggle-publish', [AdminInterviewController::class, 'togglePublish'])->name('interviews.toggle-publish');
});
