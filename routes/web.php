<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\TestimonialController;
use App\Http\Middleware\AdminOnly;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Public Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/testimoni', [TestimonialController::class, 'publicStore'])->name('testimonials.submit');
Route::post('/pesan', [HomeController::class, 'storeMessage'])->name('messages.submit');
Route::get('/artikel/{blog:slug}', [HomeController::class, 'showBlog'])->name('blogs.show');
Route::get('/cv-digital', [HomeController::class, 'showCv'])->name('cv.digital');

Route::get('/language/{locale}', function (Request $request, string $locale): RedirectResponse {
    abort_unless(in_array($locale, ['id', 'en'], true), 404);

    $request->session()->put('locale', $locale);

    return redirect()->route('home');
})->name('locale.switch');

// Admin Authentication
Route::redirect('/admin', '/admin/dashboard')->name('admin');
Route::get('/admin/masuk', [ProjectController::class, 'login'])->name('admin.login');
Route::post('/admin/masuk', [ProjectController::class, 'authenticate'])->name('admin.authenticate');
Route::post('/admin/keluar', [ProjectController::class, 'logout'])->name('admin.logout');

// Protected Admin Dashboard
Route::middleware(AdminOnly::class)
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // CRUD Proyek
        Route::get('/projects', [ProjectController::class, 'adminIndex'])->name('projects.index');
        Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
        Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');

        // CRUD Testimoni
        Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
        Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
        Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
        Route::get('/testimonials/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit');
        Route::put('/testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('testimonials.update');
        Route::patch('/testimonials/{testimonial}/approve', [TestimonialController::class, 'approve'])->name('testimonials.approve');
        Route::patch('/testimonials/{testimonial}/unapprove', [TestimonialController::class, 'unapprove'])->name('testimonials.unapprove');
        Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');

        // CRUD Sertifikat dan Prestasi
        Route::resource('certificates', CertificateController::class);

        // CRUD Pengalaman (PLK, Organisasi, Lomba)
        Route::resource('experiences', ExperienceController::class);

        // Mengelola Pesan Yang Masuk (Formulir Kesan dan Pesan)
        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
        Route::patch('/messages/{message}/read', [MessageController::class, 'markAsRead'])->name('messages.read');
        Route::patch('/messages/{message}/unread', [MessageController::class, 'markAsUnread'])->name('messages.unread');
        Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

        // CRUD Blog / Catatan Ngoding / Tutorial
        Route::resource('blogs', BlogController::class);

        // CRUD Keahlian / Skills
        Route::resource('skills', SkillController::class);

        // Mengelola Informasi Profil / Mengubah Konten Tanpa Menghapus Kode
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    });
