<?php
// routes/web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\{HomeController, AboutController, ServiceController, DoctorController, ArticleController, EducationController, ContactController};
use App\Http\Controllers\Admin\{DashboardController, ArticleController as AdminArticleController, ServiceController as AdminServiceController, DoctorController as AdminDoctorController, ScheduleController, UserController, ContactController as AdminContactController, EducationController as AdminEducationController};
use App\Http\Controllers\Auth\{UserDashboardController};
use App\Http\Controllers\Admin\HeroSliderController;
use App\Http\Controllers\Admin\SiteSettingController;

// =====================
// PUBLIC ROUTES
// =====================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about');

Route::prefix('layanan')->name('services.')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('index');
    Route::get('/{service:slug}', [ServiceController::class, 'show'])->name('show');
});

Route::prefix('dokter')->name('doctors.')->group(function () {
    Route::get('/', [DoctorController::class, 'index'])->name('index');
    Route::get('/{doctor:slug}', [DoctorController::class, 'show'])->name('show');
});

Route::prefix('berita')->name('articles.')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/{article:slug}', [ArticleController::class, 'show'])->name('show');
});

Route::prefix('edukasi')->name('educations.')->group(function () {
    Route::get('/', [EducationController::class, 'index'])->name('index');
    Route::get('/{education:slug}', [EducationController::class, 'show'])->name('show');
});

Route::prefix('kontak')->name('contact.')->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::post('/', [ContactController::class, 'store'])->name('store');
});

// =====================
// AUTH ROUTES (Breeze)
// =====================
require __DIR__.'/auth.php';

// =====================
// USER DASHBOARD
// =====================
Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [UserDashboardController::class, 'index'])->name('index');
    Route::get('/profil', [UserDashboardController::class, 'profile'])->name('profile');
    Route::put('/profil', [UserDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::put('/password', [UserDashboardController::class, 'updatePassword'])->name('password.update');
});

// =====================
// ADMIN ROUTES
// =====================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Articles
    Route::resource('articles', AdminArticleController::class)->except(['show']);

    // Services
    Route::resource('services', AdminServiceController::class)->except(['show']);

    // Doctors
    Route::resource('doctors', AdminDoctorController::class)->except(['show']);

    // Schedules
    Route::resource('schedules', ScheduleController::class)->except(['show']);

    // Educations
    Route::resource('educations', AdminEducationController::class)->except(['show']);

    // Contacts
    Route::get('contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{contact}', [AdminContactController::class, 'show'])->name('contacts.show');
    Route::post('contacts/{contact}/reply', [AdminContactController::class, 'reply'])->name('contacts.reply');
    Route::delete('contacts/{contact}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');

    // Users
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Hero Sliders
    Route::get   ('hero-sliders',                [HeroSliderController::class, 'index'])  ->name('hero-sliders.index');
    Route::post  ('hero-sliders',                [HeroSliderController::class, 'store'])  ->name('hero-sliders.store');
    Route::put   ('hero-sliders/{heroSlider}',   [HeroSliderController::class, 'update']) ->name('hero-sliders.update');
    Route::delete('hero-sliders/{heroSlider}',   [HeroSliderController::class, 'destroy'])->name('hero-sliders.destroy');

    // Toggle aktif / nonaktif
    Route::patch('hero-sliders/{heroSlider}/toggle',  [HeroSliderController::class, 'toggle']) ->name('hero-sliders.toggle');

    // Naik / turun urutan
    Route::patch('hero-sliders/{heroSlider}/reorder', [HeroSliderController::class, 'reorder'])->name('hero-sliders.reorder');

    // Site Settings (logo, footer, kontak, sosmed)
    Route::get   ('site-settings',          [SiteSettingController::class, 'index'])       ->name('site-settings.index');
    Route::put   ('site-settings',          [SiteSettingController::class, 'update'])       ->name('site-settings.update');
    Route::delete('site-settings/logo',     [SiteSettingController::class, 'deleteLogo'])   ->name('site-settings.delete-logo');
    Route::delete('site-settings/favicon',  [SiteSettingController::class, 'deleteFavicon'])->name('site-settings.delete-favicon');
});