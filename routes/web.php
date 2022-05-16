<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
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

Route::get('about-us', [AboutUsController::class, 'aboutUsPage'])->name('about-us');

Route::get('review/form', [ReviewController::class, 'create'])->name('review.form');

Route::group(['middleware' => 'auth'], function () {
    Route::post('review/create', [ReviewController::class, 'store'])->name('review.create');
    Route::get('reviews', [ReviewController::class, 'index'])->name('review.list');
    Route::patch('review', [ReviewController::class, 'updateStatus'])->name('review.change-status');

    Route::post('gallery/check-available-slug', [GalleryController::class, 'checkAvailableSlug'])->name('gallery.slug-availability');
    Route::get('gallery/form', [GalleryController::class, 'create'])->name('gallery.form');
    Route::post('gallery/create', [GalleryController::class, 'store'])->name('gallery.create');

    Route::get('events/list', [EventController::class, 'index'])->name('events.list');
    Route::get('events/get-list', [EventController::class, 'getList'])->name('events.get-list');
    Route::get('events/form', [EventController::class, 'create'])->name('events.form');
    Route::post('events/create', [EventController::class, 'store'])->name('events.create');
    Route::post('events/update/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('events/delete/{id}', [EventController::class, 'destroy'])->name('events.delete');
    Route::get('events/calendar', [EventController::class, 'showEventCalendar'])->name('events.calendar');
    Route::get('events/items', [EventController::class, 'getItemsForCalendar'])->name('events.items');
    Route::get('events/get-item/{id}', [EventController::class, 'getEventData'])->name('event.get-item');
    Route::patch('events', [EventController::class, 'updateStatus'])->name('event.change-status');
});

Route::get('gallery', [GalleryController::class, 'index'])->name('gallery.show');
Route::get('gallery/show/{gallery:slug}', [GalleryController::class, 'show'])->name('gallery.item');
