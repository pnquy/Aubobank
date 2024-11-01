<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\IntegratedController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\UpgradeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GateController;
use App\Http\Controllers\MomoAccountController;

Route::get('/momo-accounts', [MomoAccountController::class, 'index'])->middleware('auth')->name('accounts-momo');
Route::middleware('auth')->group(function () {
    Route::get('/momo-accounts/add', function () {
        return view('gate.add-accounts.momo'); // Trang hiển thị form thêm tài khoản MoMo
    })->name('gate.add-accounts.momo'); // Thêm tên cho route
});

Route::post('/momo-accounts/add', [MomoAccountController::class, 'store'])->middleware('auth');


// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/menu-bank', function () {
    return view('overview.menu-bank');
})->name('menu-bank');

// Authentication Routes
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Document Routes
Route::prefix('document')->name('document.')->group(function () {
    Route::get('/apidata', [DocumentController::class, 'apiv2'])->name('apidata');
    Route::get('/webhook', [DocumentController::class, 'qr'])->name('webhook');
});

// Tool Routes
Route::prefix('tool')->name('tool.')->group(function () {
    Route::get('/momo', [ToolController::class, 'momo'])->name('momo');
    Route::get('/wallet', [ToolController::class, 'wallet'])->name('wallet');
    Route::get('/bank', [ToolController::class, 'bank'])->name('bank');
    Route::get('/qr', [ToolController::class, 'qr'])->name('qr');
});

// Header Routes
Route::get('/header', [HeaderController::class, 'index'])->name('header.index');

// Integrated Routes
Route::prefix('integrated')->name('integrated.')->group(function () {
    Route::get('/wordpress', [IntegratedController::class, 'showCard'])->name('wordpress');
    Route::get('/whm', [IntegratedController::class, 'whm'])->name('whm');
});

// Upgrade Routes
Route::get('/upgrade', [UpgradeController::class, 'upgrade'])->name('upgrade');

// Purchase Routes
// routes/web.php

use App\Http\Controllers\TransactionHistoryController;

Route::middleware('auth')->group(function () {
    Route::get('/transaction-history', [TransactionHistoryController::class, 'index'])->name('transaction.history');
});

// Route::middleware(['auth'])->group(function () {
//     Route::get('/purchase', [PurchaseController::class, 'showPurchaseForm'])->name('purchase.form');
//     Route::post('/purchase', [PurchaseController::class, 'processPurchase'])->name('purchase.process');
//     // Các route profile và dashboard khác...
// });

// Dashboard Routes (Protected)
Route::middleware(['auth', 'verified'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [UserController::class, 'showProfile'])->name('index');

    // Logs Routes
    Route::prefix('logs')->name('logs.')->group(function () {
        Route::get('/', [LogController::class, 'index'])->name('index');
        Route::get('/search', [LogController::class, 'search'])->name('search');
        Route::get('/sort', [LogController::class, 'sort'])->name('sort');
    });
});

Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

// Profile Routes (Protected)
Route::middleware(['auth'])->prefix('profile')->name('profile.')->group(function () {
    // Hiển thị trang thông tin hồ sơ người dùng
    Route::get('/', [ProfileController::class, 'showProfile'])->name('show');

    // Hiển thị trang chỉnh sửa thông tin hồ sơ
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');

    // Cập nhật thông tin hồ sơ người dùng
    Route::post('/', [ProfileController::class, 'updateProfile'])->name('update');

    // Cập nhật ảnh đại diện
    Route::post('/update-avatar', [ProfileController::class, 'updateAvatar'])->name('update-avatar');

    // Cập nhật cài đặt Telegram
    Route::post('/update-telegram-settings', [ProfileController::class, 'updateTelegramSettings'])->name('update-telegram-settings');

    // Hủy kích hoạt tài khoản người dùng
    Route::post('/deactivate-account', [ProfileController::class, 'deactivateAccount'])->name('deactivate-account');

    // Thay đổi mật khẩu người dùng
    Route::post('/change-password', [ProfileController::class, 'updatePassword'])->name('change-password');

    // Hiển thị nhật ký hoạt động của người dùng
    Route::get('/activity-logs', [ProfileController::class, 'showActivityLogs'])->name('activity-logs');

    // Xóa tài khoản người dùng
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});
// Include Authentication Routes
require __DIR__ . '/auth.php';
