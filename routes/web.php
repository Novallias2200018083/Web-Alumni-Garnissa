<?php
use App\Http\Controllers\EventController;
use App\Http\Controllers\AlumniDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AlumniProfileController;
use App\Http\Controllers\ProfileController;
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
Route::get('/about', function () {
    return view('about');
});


Route::get('/showEvents', [EventController::class, 'front'])->name('events.front');
Route::get('/about', [AboutController::class, 'front'])->name('about.front');



Route::get('/blogs', function () {
    return view('blog');
});

Route::get('/contact', function () {
    return view('contact');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // events
    Route::resource('events', controller: EventController::class);

    // about us
    Route::get('/admin/about',[AboutController::class, 'index'])->name('about.index');
    Route::get('/admin/about/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::post('/admin/about/update', [AboutController::class, 'update'])->name('about.update');
}); 

// Route::middleware(['auth', 'alumni'])->group(function () {
//     Route::get('/dashboard/alumni', [AlumniDashboardController::class, 'index'])->name('alumni.dashboard');
// });





require __DIR__ . '/auth.php';
