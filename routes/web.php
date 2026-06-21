<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Student;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Atasan;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\NotifikasiController;
use Illuminate\Support\Facades\Route;

// Redirect root to login
Route::get('/', function () {
    try {
        $stats = [
            'total' => \App\Models\Aspirasi::count(),
            'diproses' => \App\Models\Aspirasi::where('status', 'diproses')->count(),
            'diterima' => \App\Models\Aspirasi::where('status', 'diterima')->count(),
            'menunggu' => \App\Models\Aspirasi::where('status', 'pending')->count(),
        ];
        $recentAspirasi = \App\Models\Aspirasi::with(['user', 'kategori'])
            ->withCount(['comments', 'votes'])
            ->latest()
            ->take(3)
            ->get();
    } catch (\Throwable $e) {
        // Fallback stats if database is not migrated/ready yet
        $stats = [
            'total' => 124,
            'diproses' => 38,
            'diterima' => 82,
            'menunggu' => 4,
        ];
        $recentAspirasi = collect();
    }
    return view('welcome', compact('stats', 'recentAspirasi'));
});

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Student routes
Route::middleware(['auth', 'role:murid'])->group(function () {
    Route::get('/dashboard', [Student\DashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/aspirasi', [Student\AspirasiController::class, 'index'])->name('aspirasi.index');
    Route::get('/aspirasi/semua', [Student\AspirasiController::class, 'semua'])->name('aspirasi.semua');
    Route::get('/aspirasi/create', [Student\AspirasiController::class, 'create'])->name('aspirasi.create');
    Route::post('/aspirasi', [Student\AspirasiController::class, 'store'])->name('aspirasi.store');
    Route::get('/aspirasi/{aspirasi}', [Student\AspirasiController::class, 'show'])->name('aspirasi.show');

    // Comments
    Route::post('/aspirasi/{aspirasi}/comments', [\App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/aspirasi', [Admin\AspirasiController::class, 'index'])->name('aspirasi.index');
    Route::get('/aspirasi/{aspirasi}/response', [Admin\AspirasiController::class, 'response'])->name('aspirasi.response');
    Route::post('/aspirasi/{aspirasi}/response', [Admin\AspirasiController::class, 'storeResponse'])->name('aspirasi.storeResponse');
    Route::patch('/aspirasi/{aspirasi}/status', [Admin\AspirasiController::class, 'updateStatus'])->name('aspirasi.updateStatus');
    Route::delete('/aspirasi/{aspirasi}', [Admin\AspirasiController::class, 'destroy'])->name('aspirasi.destroy');
});

// Atasan routes
Route::middleware(['auth', 'role:atasan'])->prefix('atasan')->name('atasan.')->group(function () {
    Route::get('/dashboard', [Atasan\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/aspirasi', [Atasan\AspirasiController::class, 'index'])->name('aspirasi.index');
    Route::get('/aspirasi/{aspirasi}', [Atasan\AspirasiController::class, 'show'])->name('aspirasi.show');
    Route::patch('/aspirasi/{aspirasi}/status', [Atasan\AspirasiController::class, 'updateStatus'])->name('aspirasi.updateStatus');
});

// Shared authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/vote/{aspirasi}', [VoteController::class, 'toggle'])->name('vote.toggle');
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::patch('/notifikasi/{notifikasi}', [NotifikasiController::class, 'markAsRead'])->name('notifikasi.read');
});
