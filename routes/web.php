<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PodCastController;
use App\Http\Controllers\CoachingController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\SpeakingRequestController;


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/register',function () {
    return redirect()->route('login');
});
    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index')->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
    Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create')->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
    Route::post('/testimonials/{id}', [TestimonialController::class, 'edit'])->name('testimonials.edit')->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
    Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store')->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
    Route::post('/testimonials/{id}', [TestimonialController::class, 'update'])->name('testimonials.update')->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);
    Route::delete('/testimonials/{id}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy')->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);  
    
    

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    
    // Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
    // Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
    // Route::get('/testimonials/{id}', [TestimonialController::class, 'edit'])->name('testimonials.edit');
    // Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
    // Route::put('/testimonials/{id}', [TestimonialController::class, 'update'])->name('testimonials.update');
    // Route::delete('/testimonials/{id}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');  
    
    
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    
    Route::get('/speaking-engagement', [SpeakingRequestController::class, 'show'])->name('speaking.show');
    
    
    Route::get('/blog', [ResourceController::class, 'index'])->name('blog.index');
    Route::get('/blog/create', [ResourceController::class, 'create'])->name('blog.create');
    Route::post('/blog/create', [ResourceController::class, 'store'])->name('blog.store');
    Route::get('/blog/{id}/edit', [ResourceController::class, 'edit'])->name('blog.edit');
    Route::put('/blog/{id}', [ResourceController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{id}', [ResourceController::class, 'destroy'])->name('blog.destroy');
    
    Route::get('/podcasts', [PodCastController::class, 'index'])->name('podcasts.index');
    Route::get('/podcasts/create', [PodCastController::class, 'create'])->name('podcasts.create');
    Route::post('/podcasts/create', [PodCastController::class, 'store'])->name('podcasts.store');
    Route::get('/podcasts/{id}/edit', [PodCastController::class, 'edit'])->name('podcasts.edit');
    Route::put('/podcasts/{id}', [PodCastController::class, 'update'])->name('podcasts.update');
    Route::delete('/podcasts/{id}', [PodCastController::class, 'destroy'])->name('podcasts.destroy');
    Route::get('/podcasts/{id}', [PodCastController::class, 'show'])->name('podcasts.show');
    
});



// run migrations
Route::get('/migrate', function () {
    if (request()->get('key') !== 'my-secret-key') {
        abort(403, 'Unauthorized');
    }
    try {
        Artisan::call('migrate', ['--force' => true]);
        return '✅ Migrations have been run successfully.';
    } catch (\Exception $e) {
        return '❌ Migration failed: ' . $e->getMessage();
    }
});




