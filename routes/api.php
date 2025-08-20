<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PodCastController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\SpeakingRequestController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route to display testimonials
Route::get('/testimonials', [TestimonialController::class, 'getTestimonials']);

// handle contact form submission 
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/contact', [ContactController::class, 'submit'])->name('contact.show');
Route::delete('/contact', [ContactController::class, 'submit'])->name('contact.destroy');

Route::post('/speaking-engagement', [SpeakingRequestController::class, 'submit'])->name('speaking.submit');

Route::get('/blogs', [ResourceController::class, 'getBlogs'])->name('blog.get');
Route::get('/blogs/{id}',[ResourceController::class, 'getBlog'])->name('blog.getById');

Route::get('/podcasts', [PodCastController::class, 'getAllPodCast'])->name('podcasts.getAll');
Route::get('/podcast/latest', [PodCastController::class, 'latest'])->name('podcasts.latest');
Route::get('/podcast/{id}', [PodCastController::class, 'getPodCastById'])->name('podcasts.byId');
