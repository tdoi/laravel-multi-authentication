<?php
use App\Http\Controllers\Member\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::prefix('member')->name('member.')->group(function () {
    Route::middleware(['auth:member'])->group(function() {
        Route::get('/dashboard', function () {
            return Inertia::render('Member/Dashboard');
        })->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    require __DIR__ . '/auth.php';
});
