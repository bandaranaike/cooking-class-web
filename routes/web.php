<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'homePage'])->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('contact-us', [ContactController::class, 'create'])->name('contact.form');
Route::post('contact-us', [ContactController::class, 'store'])->name('contact.create');

Route::get('review', [ReviewController::class, 'create'])->name('review.form');
Route::post('review', [ReviewController::class, 'store'])->name('review.create');

Route::get('gallery', [GalleryController::class, 'index'])->name('gallery.show');
Route::get('gallery/create', [GalleryController::class, 'create'])->name('gallery.form');
Route::post('gallery/create', [GalleryController::class, 'store'])->name('gallery.create');
Route::get('gallery/show/{gallery:slug}', [GalleryController::class, 'show'])->name('gallery.item');
Route::post('gallery/check-available-slug', [GalleryController::class, 'checkAvailableSlug'])->name('gallery.slug-availability');
