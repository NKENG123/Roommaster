<?php

use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ReservationController::class, 'index'])->name('dashboard');
    Route::get('/rooms/create', [RoomController::class, 'create'])->name('rooms.create');
    Route::post('/rooms/store', [RoomController::class, 'store'])->name('rooms.store');
    Route::post('/reserve', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/history', [ReservationController::class, 'history'])->name('reservations.history');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
    Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
    Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');
});
require __DIR__.'/auth.php';