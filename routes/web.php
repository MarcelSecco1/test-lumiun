<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\HomePage;
use App\Livewire\Pages\DashboardPage;

Route::get('/', HomePage::class)->name('home');

Route::get('/dashboard', DashboardPage::class)->name('dashboard')
    ->middleware(['auth:sanctum', 'verified']);


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
