<?php
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AlumniDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AlumniProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
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

// frontend routes
Route::get('/showEvents', [EventController::class, 'front'])->name('events.front');
Route::get('/showBlogs', [BlogController::class, 'front'])->name('blogs.front');
Route::get('/showAnnouncements', [AnnouncementController::class, 'front'])->name('announcements.front');
Route::get('/about', [AboutController::class, 'front'])->name('about.front');




Route::get('/contact', function () {
    return view('contact');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Users management
    Route::resource('admin/users', UserController::class);
    // about us
    Route::get('/admin/about', [AboutController::class, 'index'])->name('about.index');
    Route::get('/admin/about/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::post('/admin/about/update', [AboutController::class, 'update'])->name('about.update');

    // blogs
    Route::resource('/admin/blogs', controller: BlogController::class);
    // events
    Route::resource('/admin/events', controller: EventController::class);
    // announcements
    Route::resource('/admin/announcements', AnnouncementController::class);

    Route::get('register/complete/{email}', [RegisterController::class, 'completeRegistration'])->name('register.complete');


});

// Route::middleware(['auth', 'alumni'])->group(function () {
//     Route::get('/dashboard/alumni', [AlumniDashboardController::class, 'index'])->name('alumni.dashboard');
// });





require __DIR__ . '/auth.php';
