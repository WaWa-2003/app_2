<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ApplicationController;

use App\Http\Controllers\OpportunityController;

use App\Http\Controllers\Applicant\JobController;
use App\Http\Controllers\Applicant\EducationController;
use App\Http\Controllers\Applicant\OtherController;
use App\Http\Controllers\Applicant\ProfessionalInformationController;
use App\Http\Controllers\Applicant\WishlistController;
use App\Http\Controllers\Applicant\ApplyController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
    Route::get('/', [ApplicationController::class, 'index'])->name('application.index');
    Route::get('opportunity/{opportunity}', [ApplicationController::class, 'show'])->name('application.opportunity.show');
    Route::get('opportunity/{opportunity}/all', [ApplicationController::class, 'showAll'])->name('application.opportunity.show.all');
    Route::get('opportunity/{opportunity}/new', [ApplicationController::class, 'showNew'])->name('application.opportunity.show.new');
    Route::get('opportunity/{opportunity}/prescreen', [ApplicationController::class, 'showPrescreen'])->name('application.opportunity.show.prescreen');
    Route::get('opportunity/{opportunity}/first-interview', [ApplicationController::class, 'showFirstInterview'])->name('application.opportunity.show.firstInterview');
    Route::get('opportunity/{opportunity}/second-interview', [ApplicationController::class, 'showSecondInterview'])->name('application.opportunity.show.secondInterview');
    Route::get('opportunity/{opportunity}/third-interview', [ApplicationController::class, 'showThirdInterview'])->name('application.opportunity.show.thirdInterview');
    Route::get('opportunity/{opportunity}/offer', [ApplicationController::class, 'showOffer'])->name('application.opportunity.show.offer');
    Route::get('opportunity/{opportunity}/accept', [ApplicationController::class, 'showAccept'])->name('application.opportunity.show.accept');
    Route::get('opportunity/{opportunity}/reject', [ApplicationController::class, 'showReject'])->name('application.opportunity.show.reject');
    Route::get('opportunity/{opportunity}/not-suitable', [ApplicationController::class, 'showNotSuitable'])->name('application.opportunity.show.notSuitable');

    Route::get('/{application}/opportunity/{opportunity}/applicant/{applicant}', [ApplicationController::class, 'applicantDetail'])->name('application.opportunity.applicant');
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
