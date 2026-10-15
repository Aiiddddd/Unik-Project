<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home', ['c' => config('company')])->name('home');
