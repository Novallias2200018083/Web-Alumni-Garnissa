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
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AdminMajorController;
use App\Http\Controllers\EventRegistrationController; 
use App\Http\Controllers\CommentController;
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
Route::get('/events/{event}/detail', [EventController::class, 'detail'])->name('events.public.detail'); // <-- PERUBAHAN DI SINI
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
    // 
    Route::resource('/admin/users', AdminUserController::class);

    // URI-nya adalah 'admin/majors'
    Route::resource('/admin/majors', controller: AdminMajorController::class);

    // about us
    Route::get('/admin/about', [AboutController::class, 'index'])->name('about.index');
    Route::get('/admin/about/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::post('/admin/about/update', [AboutController::class, 'update'])->name('about.update');

    // blogs
    Route::resource('/admin/blogs', controller: BlogController::class);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/admin/comments/{parentComment}/reply', [CommentController::class, 'reply'])->name('admin.comments.reply'); // Menggunakan metode reply yang sama

    // events
    Route::resource('/admin/events', controller: EventController::class);

    Route::get('/admin/events/{event}/registrations', [EventRegistrationController::class, 'indexEventRegistrations'])->name('admin.events.registrations.index');
    // announcements
    Route::resource('/admin/announcements', AnnouncementController::class);

    // This route is for showing the registration completion form.
    Route::get('register/complete/{email}', [InviteRegisterController::class, 'completeRegistration'])->name('register.complete');

    // This route is for handling the form submission to complete the registration.
    Route::post('register/complete/{email}', [InviteRegisterController::class, 'postCompleteRegistration'])->name('register.complete.post');

    // Manajemen Pendaftaran Event (Admin)
        Route::get('/admin/event-registrations', [EventRegistrationController::class, 'indexAdmin'])->name('admin.registrations.index');
        Route::get('/admin/event-registrations/{registration}', [EventRegistrationController::class, 'showAdmin'])->name('admin.registrations.show'); // <--- Baru, untuk detail pendaftaran
        Route::put('/admin/event-registrations/{registration}/confirm', [EventRegistrationController::class, 'confirmPayment'])->name('admin.registrations.confirm');
        Route::put('/admin/event-registrations/{registration}/reject', [EventRegistrationController::class, 'rejectPayment'])->name('admin.registrations.reject');
        Route::delete('/admin/event-registrations/{registration}', [EventRegistrationController::class, 'destroyAdmin'])->name('admin.registrations.destroy');

    // Ini untuk melihat registrasi per event (indexEventRegistrations)
    Route::get('/admin/events/{event}/registrations', [EventRegistrationController::class, 'indexEventRegistrations'])->name('admin.events.registrations.index');

});

// // Rute Publik untuk melihat profil alumni (tanpa login)
// // Menggunakan Route Model Binding dengan kolom 'alumni_code'
// Route::get('/alumni/directory/{alumniProfile:alumni_code}', [AlumniProfileController::class, 'showPublicProfile'])->name('alumni.directory.show');


Route::middleware(['auth', 'alumni'])->group(function () {
    Route::get('/dashboard/alumni', [AlumniDashboardController::class, 'index'])->name('alumni.dashboard');

    // Profile management
    Route::get('/alumni/profile', [AlumniProfileController::class, 'show'])->name('alumni.profile.show');
    Route::get('/alumni/profile/edit', [AlumniProfileController::class, 'edit'])->name('alumni.profile.edit');
    Route::put('/alumni/profile', [AlumniProfileController::class, 'update'])->name('alumni.profile.update');
    Route::get('/alumni/profile/card', [AlumniProfileController::class, 'printCard'])->name('alumni.profile.card');

    Route::get('/alumni/directory', [AlumniController::class, 'index'])->name('alumni.directory.index');

    // Rute untuk menampilkan Profil Detail seorang alumni
    // {user} adalah parameter yang akan diterima oleh method show()
    Route::get('/alumni/directory/{user}', [AlumniController::class, 'show'])->name('alumni.directory.show');
    
    // events 
    Route::get('/alumni/events', [AlumniEventController::class, 'index'])->name('alumni.events.index');
    Route::get('/events/{event}/detail', [EventController::class, 'detail'])->name('events.public.detail');
    // Blogs
    Route::get('/alumni/blogs', [AlumniBlogController::class, 'index'])->name('alumni.blogs.index');
     // Rute detail blog alumni
    Route::get('/alumni/blogs/{blog}/detail', [AlumniBlogController::class, 'show'])->name('alumni.blogs.show'); // Ini yang akan kita pakai

    // Rute untuk Komentar Blog
    Route::post('/alumni/blogs/{blog}/comments', [CommentController::class, 'store'])->name('alumni.comments.store');
    Route::delete('/alumni/comments/{comment}', [CommentController::class, 'destroy'])->name('alumni.comments.destroy'); // Opsional: Untuk menghapus komentar sendiri
    // Rute untuk reply komentar
    Route::post('/alumni/comments/{parentComment}/reply', [CommentController::class, 'reply'])->name('alumni.comments.reply');


    // Announcements
    Route::get('/alumni/announcements', [AlumniAnnouncementController::class, 'index'])->name('alumni.announcements.index');

   
    Route::post('/events/{event}/rsvp', [EventRegistrationController::class, 'rsvp'])->name('events.rsvp'); // <--- PASTIKAN BARIS INI ADA DAN TIDAK ADA TYPO
    Route::get('/registrations/{registration}/payment', [EventRegistrationController::class, 'showPaymentForm'])->name('events.payment');
    Route::post('/registrations/{registration}/upload-proof', [EventRegistrationController::class, 'uploadPaymentProof'])->name('events.upload-proof');
});





require __DIR__ . '/auth.php';
