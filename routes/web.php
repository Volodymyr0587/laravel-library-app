<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;

Route::get('/', [BookController::class, 'index']);

Route::get('/dashboard', [BookController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Assign admin role to user
Route::get('/admin', function() {
    User::find(1)->assignRole('admin');
});

Route::middleware('auth')->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
    Route::get('/loans/{book}', [LoanController::class, 'create'])->name('loans.create');
    Route::post('/loans/{book}', [LoanController::class, 'store'])->name('loans.store');
    Route::get('/loans/terminate/{loan}', [LoanController::class, 'terminate'])->name('loans.terminate');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->prefix('book')->group(function () {
    Route::get('/create', [BookController::class, 'create'])->name('book.create');
    Route::post('/store', [BookController::class, 'store'])->name('book.store');
    Route::get('/edit/{book}', [BookController::class, 'edit'])->name('book.edit');
    Route::put('/update/{book}', [BookController::class, 'update'])->name('book.update');
    Route::delete('/delete/{book}', [BookController::class, 'destroy'])->name('book.destroy');
});
require __DIR__.'/auth.php';
