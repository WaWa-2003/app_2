<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\OpportunityController;

use App\Http\Controllers\Applicant\JobController;
use App\Http\Controllers\Applicant\EducationController;
use App\Http\Controllers\Applicant\OtherController;
use App\Http\Controllers\Applicant\ProfessionalInformationController;
use App\Http\Controllers\Applicant\WishlistController;
use App\Http\Controllers\Applicant\ApplyController;

use App\Http\Controllers\Admin\ApplicationController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [OpportunityController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth','admin'])->prefix('/admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});


Route::prefix('/admin/applications')->middleware(['auth','admin'])->group(function () {

    Route::get(
        '/',
        [ApplicationController::class, 'index']
        )->name('application.index');

    Route::get(
        '/{status}',
        [ApplicationController::class, 'getApplicationsByStatus']
        )->name('application.status');

    Route::get(
        'opportunity/{opportunity}',
        [ApplicationController::class, 'show']
        )->name('application.opportunity.show');

    Route::get(
        'opportunity/{opportunity}/{status}',
        [ApplicationController::class, 'getApplicationsByOpportunityByStatus']
        )->name('application.opportunity.show.status');

    Route::get(
        '/opportunity/{opportunity_id}/{status}/applicant/{applicant_id}',
        [ApplicationController::class, 'applicantDetail']
        )->name('application.opportunity.applicant');


    Route::post(
        '/opportunities/{opportunity_id}/{status}/applicant/{applicant_id}/notes',
        [ApplicationController::class, 'noteStore']
        )->name('note.store');

});


Route::prefix('/opportunities')->group(function () {
    Route::middleware(['auth','admin'])->group(function () {
        Route::get('/{opportunity}/edit', [OpportunityController::class, 'edit'])->name('opportunity.edit');
        Route::put('/{opportunity}', [OpportunityController::class, 'update'])->name('opportunity.update');
        Route::patch('/{opportunity}', [OpportunityController::class, 'update']);
        Route::delete('/{opportunity}', [OpportunityController::class, 'destroy'])->name('opportunity.destroy');
        Route::get('/', [OpportunityController::class, 'index'])->name('opportunity.index');
        Route::get('/create', [OpportunityController::class, 'create'])->name('opportunity.create');
        Route::post('/', [OpportunityController::class, 'store'])->name('opportunity.store');
    });
    Route::get('/', [OpportunityController::class, 'index'])->name('opportunity.index');
    Route::get('/{opportunity}', [OpportunityController::class, 'show'])->name('opportunity.show');
}); // Route::resource('opportunities', OpportunityController::class);


Route::post('/wishlist/add/{opportunity}', [WishlistController::class, 'wishlist_add'])->name('wishlist.add');
Route::put('/wishlist/remove/{opportunity}', [WishlistController::class, 'wishlist_remove'])->name('wishlist.remove');

Route::post('/apply/{opportunity}', [ApplyController::class, 'apply'])->name('apply');


Route::resource('jobs', JobController::class);
Route::resource('educations', EducationController::class);
Route::resource('others', OtherController::class);

// Route::get('/professional-information', function () {
//     return view('applicant.index');
// });

Route::get('/professional-information', [ProfessionalInformationController::class, 'index'])->name('applicant.index');

Route::prefix('/notes')->group(function () {
    Route::middleware(['auth:sanctum', 'admin'])->group(function () {

        Route::get('/', [ApplicationController::class, 'index'])->name('note.index');
        Route::get('/{note}', [ApplicationController::class, 'show'])->name('note.show');
        Route::get('/{note}/edit', [ApplicationController::class, 'edit'])->name('note.edit');
        Route::put('/{note}', [ApplicationController::class, 'update'])->name('note.update');
        Route::patch('/{note}', [ApplicationController::class, 'update']);
        Route::delete('/{note}', [ApplicationController::class, 'destroy'])->name('note.destroy');

        Route::get('/create', [ApplicationController::class, 'create'])->name('note.create');
        //Route::post('/', [ApplicationController::class, 'noteStore'])->name('note.store');
    });
});


