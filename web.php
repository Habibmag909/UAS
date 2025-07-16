<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AttendeeController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // TAMBAHKAN RUTE UNTUK ACARA DI SINI
    Route::resource('events', EventController::class);
    Route::post('events/{event}/attendees', [AttendeeController::class, 'store'])->name('events.attendees.store');
    Route::get('attendees/{attendee}/edit', [AttendeeController::class, 'edit'])->name('attendees.edit');
    Route::put('attendees/{attendee}', [AttendeeController::class, 'update'])->name('attendees.update');
    Route::delete('attendees/{attendee}', [AttendeeController::class, 'destroy'])->name('attendees.destroy');
});

require __DIR__.'/auth.php';