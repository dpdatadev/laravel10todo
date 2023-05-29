<?php

use App\Http\Controllers\JournalEntryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;


Route::controller(TodoController::class)->group(function () {
    Route::get('/', 'index')->middleware(['auth', 'verified'])->name('todos.index');
    Route::post('/todos', 'create')->middleware(['auth', 'verified'])->name('todos.create');
    Route::delete('/todos/{id}', 'destroy')->middleware(['auth', 'verified'])->name('todos.destroy');
});


# Journal Entries
Route::controller(JournalEntryController::class)->group(function () {
    Route::get('/entries', 'index');
    Route::get('/entries/{id}', 'show');
});

Route::get('/admin', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
