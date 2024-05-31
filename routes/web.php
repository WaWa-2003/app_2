<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OpportunityController;
use App\Http\Controllers\Applicant\JobController;
use App\Http\Controllers\Applicant\EducationController;
use App\Http\Controllers\Applicant\OtherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Applicant\ProfessionalInformationController;

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
}); // Route::get('/admin/dashboard',[AdminController::class, 'index'])->middleware(['auth','admin'])->name('admin.dashboard') ;

Route::prefix('/opportunities')->group(function () {
    Route::get('/', [OpportunityController::class, 'index'])->name('opportunity.index');
    Route::get('/create', [OpportunityController::class, 'create'])->name('opportunity.create');
    Route::post('/', [OpportunityController::class, 'store'])->name('opportunity.store');
    Route::get('/{opportunity}', [OpportunityController::class, 'show'])->name('opportunity.show');
    Route::get('/{opportunity}/edit', [OpportunityController::class, 'edit'])->name('opportunity.edit');
    Route::put('/{opportunity}', [OpportunityController::class, 'update'])->name('opportunity.update');
    Route::patch('/{opportunity}', [OpportunityController::class, 'update']);
    Route::delete('/{opportunity}', [OpportunityController::class, 'destroy'])->name('opportunity.destroy');
}); // Route::resource('opportunities', OpportunityController::class);




Route::resource('jobs', JobController::class);
Route::resource('educations', EducationController::class);
Route::resource('others', OtherController::class);

Route::get('/professional-information', function () {
    return view('applicant.index');
});


Route::get('/professional-information', [ProfessionalInformationController::class, 'index'])->name('applicant.index');
