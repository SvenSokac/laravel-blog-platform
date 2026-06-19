<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\VisitorController;

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

Route::get('/', [BlogController::class, 'index'])->name('home');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe.store');

Route::post('/blog/{id}/react', [BlogController::class, 'addReaction'])->name('blog.react');

Route::post('/blog/{blogId}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::post('/blog/{blogId}/comments/{commentId}/reply', [CommentController::class, 'storeReply'])->name('comments.reply');
Route::post('/comments/{commentId}/like', [CommentController::class, 'likeComment'])->name('comments.like');

// Track user each time they visit this URL
Route::get('/track', [LocationController::class, 'track'])->name('track-visitor');

// Show the location map
Route::get('/location', [LocationController::class, 'showMap'])->name('location-map');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
