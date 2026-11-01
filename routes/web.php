<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\SeoController;
use Illuminate\Support\Facades\Route;

// English (default)
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/events/{project}', [PageController::class, 'show'])->name('events.show');

// Bahasa Indonesia
Route::get('/id', [PageController::class, 'homeId'])->name('home.id');
Route::get('/id/events/{project}', [PageController::class, 'showId'])->name('events.show.id');

Route::get('/sitemap.xml', [SeoController::class, 'sitemap']);
Route::get('/robots.txt', [SeoController::class, 'robots']);
