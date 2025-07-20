use App\Http\Controllers\{
HomeController,
HouseController,
ActivityController,
UserController,
Admin\HouseController as AdminHouseController,
Admin\ActivityController as AdminActivityController,
Admin\BannerController
};

// 🌍 VISTAS PÚBLICAS

// Página principal
Route::get('/', [HomeController::class, 'index'])->name('home');

// Detalle de casas
Route::get('/houses/{id}', [HouseController::class, 'show'])->name('houses.show');

// Listado de actividades
Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');

// (Opcional) Detalle de actividad
Route::get('/activities/{id}', [ActivityController::class, 'show'])->name('activities.show');

// Info legal
Route::view('/info-legal/privacy', 'info_legal.privacy')->name('legal.privacy');
Route::view('/info-legal/terms', 'info_legal.terms_conditions')->name('legal.terms');

// 👤 PERFIL DE USUARIO (autenticado)
Route::middleware(['auth'])->group(function () {
Route::get('/user/profile', [UserController::class, 'edit'])->name('user.profile.edit');
Route::post('/user/profile', [UserController::class, 'update'])->name('user.profile.update');
});


// 🛠 PANEL DE ADMINISTRACIÓN
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

// Dashboard (renombrado a admin_dashboard)
Route::view('/dashboard', 'admin_dashboard')->name('dashboard');

// Casas
Route::get('/houses', [AdminHouseController::class, 'index'])->name('houses.index');
Route::get('/houses/create', [AdminHouseController::class, 'create'])->name('houses.create');
Route::post('/houses', [AdminHouseController::class, 'store'])->name('houses.store');
Route::get('/houses/{id}/edit', [AdminHouseController::class, 'edit'])->name('houses.edit');
Route::put('/houses/{id}', [AdminHouseController::class, 'update'])->name('houses.update');
Route::delete('/houses/{id}', [AdminHouseController::class, 'destroy'])->name('houses.destroy');

// Actividades
Route::get('/activities', [AdminActivityController::class, 'index'])->name('activities.index');
Route::get('/activities/create', [AdminActivityController::class, 'create'])->name('activities.create');
Route::post('/activities', [AdminActivityController::class, 'store'])->name('activities.store');
Route::get('/activities/{id}/edit', [AdminActivityController::class, 'edit'])->name('activities.edit');
Route::put('/activities/{id}', [AdminActivityController::class, 'update'])->name('activities.update');
Route::delete('/activities/{id}', [AdminActivityController::class, 'destroy'])->name('activities.destroy');

// Banners
Route::get('/banners', [BannerController::class, 'index'])->name('banners.index');
Route::get('/banners/create', [BannerController::class, 'create'])->name('banners.create');
Route::post('/banners', [BannerController::class, 'store'])->name('banners.store');
Route::get('/banners/{id}/edit', [BannerController::class, 'edit'])->name('banners.edit');
Route::put('/banners/{id}', [BannerController::class, 'update'])->name('banners.update');
Route::delete('/banners/{id}', [BannerController::class, 'destroy'])->name('banners.destroy');
});