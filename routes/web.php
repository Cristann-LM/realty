<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OurTeamController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\InquiryController;
use App\Models\OurTeam;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])
    ->name('home.index');
Route::get('/about-us', [AboutUsController::class, 'index'])
    ->name('about-us.index');
 Route::resource('contact-us', ContactUsController::class)
    ->only(['index']);
     Route::resource('inquiry', InquiryController::class)
    ->only(['store']);
Route::get('/our-team', [OurTeamController::class, 'index'])
    ->name('our-team.index');
Route::get('/properties', [PropertyController::class, 'index'])
    ->name('properties.index');
    Route::get('/properties/{property}', [PropertyController::class, 'show'])
    ->name('properties.show');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', function () {
            return Inertia::render('Admin/Dashboard');
        })->name('dashboard');
        Route::resource('property-units', \App\Http\Controllers\Admin\PropertyUnitController::class);
        Route::resource('developer', \App\Http\Controllers\Admin\DeveloperController::class)
        ->except(['show', 'create']);
        Route::resource('project', \App\Http\Controllers\Admin\ProjectController::class);
        Route::resource('amenities', \App\Http\Controllers\Admin\AmenitiesController::class)
            ->only(['store', 'destroy']);
        Route::resource('property-units.images', \App\Http\Controllers\Admin\UnitImageController::class)
            ->only(['store', 'destroy']);
        Route::patch('property-units/{property_unit}/images/{image}/primary',
        [\App\Http\Controllers\Admin\UnitImageController::class, 'setPrimary'])
        ->name('property-units.images.primary');
        Route::resource('about-us', \App\Http\Controllers\Admin\AboutUsController::class)
            ->only(['edit', 'update']);
        Route::post('about-us/{about_u}', [\App\Http\Controllers\Admin\AboutUsController::class, 'update'])
            ->name('about-us.update');
        Route::post('our-team/{our_team}', [\App\Http\Controllers\Admin\OurTeamController::class, 'update'])
            ->name('our-team.update');
        Route::resource('contact-us', \App\Http\Controllers\Admin\ContactUsController::class)
            ->only(['edit', 'update']);
        Route::resource('journeys', \App\Http\Controllers\Admin\OurJourneyController::class)
            ->only(['store','edit','update','destroy']);
        Route::resource('our-team', \App\Http\Controllers\Admin\OurTeamController::class);
        Route::resource('inquiries', \App\Http\Controllers\Admin\InquiryController::class)
            ->only(['index', 'edit', 'update','destroy']);
        Route::patch('inquiries/{inquiry}/mark-as-read', [\App\Http\Controllers\Admin\InquiryController::class, 'markAsRead'])
            ->name('inquiries.mark-as-read');
        Route::post('heroes/{hero}', [\App\Http\Controllers\Admin\HeroController::class, 'update'])
            ->name('heroes.update');
        Route::resource('heroes', \App\Http\Controllers\Admin\HeroController::class)
            ->only(['edit', 'update']);
});




require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
