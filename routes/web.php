<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    HouseController,
    ActivityController,
    UserController,
    Admin\HouseController as AdminHouseController,
    Admin\ActivityController as AdminActivityController,
    Admin\BannerController
};
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/houses/{id}', [HouseController::class, 'show'])->name('houses.show');


Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');


Route::get('/activities/{id}', [ActivityController::class, 'show'])->name('activities.show');


Route::view('/info-legal/privacy', 'info_legal.privacy')->name('legal.privacy');
Route::view('/info-legal/terms', 'info_legal.terms_conditions')->name('legal.terms');


Route::middleware(['auth'])->group(function () {
    Route::get('/user/profile', [UserController::class, 'edit'])->name('user.profile.edit');
    Route::post('/user/profile', [UserController::class, 'update'])->name('user.profile.update');
});



Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {


    Route::view('/dashboard', 'admin_dashboard')->name('dashboard');


    Route::get('/houses', [AdminHouseController::class, 'index'])->name('houses.index');
    Route::get('/houses/create', [AdminHouseController::class, 'create'])->name('houses.create');
    Route::post('/houses', [AdminHouseController::class, 'store'])->name('houses.store');
    Route::get('/houses/{id}/edit', [AdminHouseController::class, 'edit'])->name('houses.edit');
    Route::put('/houses/{id}', [AdminHouseController::class, 'update'])->name('houses.update');
    Route::delete('/houses/{id}', [AdminHouseController::class, 'destroy'])->name('houses.destroy');


    Route::get('/activities', [AdminActivityController::class, 'index'])->name('activities.index');
    Route::get('/activities/create', [AdminActivityController::class, 'create'])->name('activities.create');
    Route::post('/activities', [AdminActivityController::class, 'store'])->name('activities.store');
    Route::get('/activities/{id}/edit', [AdminActivityController::class, 'edit'])->name('activities.edit');
    Route::put('/activities/{id}', [AdminActivityController::class, 'update'])->name('activities.update');
    Route::delete('/activities/{id}', [AdminActivityController::class, 'destroy'])->name('activities.destroy');


    Route::get('/banners', [BannerController::class, 'index'])->name('banners.index');
    Route::get('/banners/create', [BannerController::class, 'create'])->name('banners.create');
    Route::post('/banners', [BannerController::class, 'store'])->name('banners.store');
    Route::get('/banners/{id}/edit', [BannerController::class, 'edit'])->name('banners.edit');
    Route::put('/banners/{id}', [BannerController::class, 'update'])->name('banners.update');
    Route::delete('/banners/{id}', [BannerController::class, 'destroy'])->name('banners.destroy');
});

require __DIR__ . '/auth.php';
