<?php

use App\Http\Controllers\ProjectController;
use App\Http\Middleware\AdminOnly;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProjectController::class, 'index'])->name('home');
Route::get('/language/{locale}', function (Request $request, string $locale): RedirectResponse {
    abort_unless(in_array($locale, ['id', 'en'], true), 404);

    $request->session()->put('locale', $locale);

    return redirect()->route('home');
})->name('locale.switch');

Route::redirect('/admin', '/admin/masuk')->name('admin');
Route::get('/admin/masuk', [ProjectController::class, 'login'])->name('admin.login');
Route::post('/admin/masuk', [ProjectController::class, 'authenticate'])->name('admin.authenticate');
Route::post('/admin/keluar', [ProjectController::class, 'logout'])->name('admin.logout');

Route::middleware(AdminOnly::class)
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/projects', [ProjectController::class, 'adminIndex'])->name('projects.index');
        Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
        Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
        Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
        Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
        Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    });
