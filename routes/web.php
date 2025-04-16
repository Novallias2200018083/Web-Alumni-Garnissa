<?php
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AlumniDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AlumniProfileController;
use App\Http\Controllers\AlumniEventController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlumniBlogController;
use App\Http\Controllers\AlumniAnnouncementController;
use App\Http\Controllers\InviteRegisterController;
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);

Route::get('/about', function () {
    return view('about');
});

// frontend routes
Route::get('/showEvents', [EventController::class, 'front'])->name('events.front');
Route::get('/showBlogs', [BlogController::class, 'front'])->name('blogs.front');
Route::get('/showAnnouncements', [AnnouncementController::class, 'front'])->name('announcements.front');
Route::get('/about', [AboutController::class, 'front'])->name('about.front');
// Route::get('/', [AlumniProfileController::class, 'front'])->name('welcome');





Route::get('/contact', function () {
    return view('contact');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Users management
    Route::resource('admin/users', UserController::class);
    // 
    Route::resource('/admin/users', AdminUserController::class);

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

    // This route is for showing the registration completion form.
    Route::get('register/complete/{email}', [InviteRegisterController::class, 'completeRegistration'])->name('register.complete');

    // This route is for handling the form submission to complete the registration.
    Route::post('register/complete/{email}', [InviteRegisterController::class, 'postCompleteRegistration'])->name('register.complete.post');



});

Route::middleware(['auth', 'alumni'])->group(function () {
    Route::get('/dashboard/alumni', [AlumniDashboardController::class, 'index'])->name('alumni.dashboard');

    // Profile management
    Route::get('/alumni/profile', [AlumniProfileController::class, 'show'])->name('alumni.profile.show');
    Route::get('/alumni/profile/edit', [AlumniProfileController::class, 'edit'])->name('alumni.profile.edit');
    Route::put('/alumni/profile', [AlumniProfileController::class, 'update'])->name('alumni.profile.update');

    // events 
    Route::get('/alumni/events', [AlumniEventController::class, 'index'])->name('alumni.events.index');
    // Blogs
    Route::get('/alumni/blogs', [AlumniBlogController::class, 'index'])->name('alumni.blogs.index');

    // Announcements
    Route::get('/alumni/announcements', [AlumniAnnouncementController::class, 'index'])->name('alumni.announcements.index');

});





require __DIR__ . '/auth.php';
