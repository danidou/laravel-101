<?php

use App\Http\Controllers\AnimalPictureController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AnimalPictureController::class, 'random'])->name('getRandomAnimal');
