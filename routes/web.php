<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\BranchController;

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
    Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.perform');
});

// Authenticated routes
Route::middleware(['auth', 'tenant'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard/chart-data', [DashboardController::class, 'chartData'])->name('dashboard.chart-data');
    Route::post('/logout', [LogoutController::class, 'perform'])->name('logout');
    
    // Super Admin Routes
    Route::middleware('role:super_admin')->prefix('super-admin')->name('super-admin.')->group(function () {
        Route::resource('tenants', TenantController::class);
        Route::post('tenants/{tenant}/toggle-status', [TenantController::class, 'toggleStatus'])->name('tenants.toggle-status');
    });
    
    // Admin Routes - Branch Management
    Route::middleware('role:super_admin,admin')->group(function () {
        Route::resource('branches', BranchController::class);
        Route::post('branches/{branch}/toggle-status', [BranchController::class, 'toggleStatus'])->name('branches.toggle-status');
    });
    
    // Manager & Admin Routes
    Route::middleware('role:super_admin,admin,manager')->group(function () {
        Route::resource('products', ProductController::class);
        Route::post('products/{product}/deactivate', [ProductController::class, 'deactivate'])->name('products.deactivate');
        
        Route::resource('users', UserController::class)->except(['create', 'store', 'destroy']);
        Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
        Route::post('users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
        
        Route::get('/reports/sales', [ReportsController::class, 'salesReport'])->name('reports.sales');
        Route::get('/reports/item-sales', [ReportsController::class, 'itemSalesReport'])->name('reports.item-sales');
        Route::get('/reports/inventory', [ReportsController::class, 'inventoryReport'])->name('reports.inventory');
    });
    
    // All Users - POS
    Route::prefix('pos')->name('pos.')->group(function () {
        Route::get('/', [POSController::class, 'index'])->name('index');
        Route::get('/search', [POSController::class, 'searchProducts'])->name('search');
        Route::post('/checkout', [POSController::class, 'checkout'])->name('checkout');
    });
    
    // Audit Trail - Super Admin & Admin
    Route::middleware('role:super_admin,admin')->group(function () {
        Route::get('/audit', [AuditController::class, 'index'])->name('audit.index');
    });
});
