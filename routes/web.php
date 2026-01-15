<?php

use App\Http\Controllers\Admin\AboutTopicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\UniversityController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ScholarshipController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SettingController;

// Frontend Controllers
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CourseController as FrontendCourseController;
use App\Http\Controllers\Frontend\CountryController as FrontendCountryController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\Frontend\ContactController as FrontendContactController;
use App\Http\Controllers\Frontend\ApplicationController as FrontendApplicationController;
use App\Http\Controllers\Frontend\UniversityController as FrontendUniversityController;

use Illuminate\Support\Facades\Route;

// ============================================
// FRONTEND ROUTES (Public)
// ============================================

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');

// Courses
Route::get('/courses', [FrontendCourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{slug}', [FrontendCourseController::class, 'show'])->name('courses.show');

// Countries
Route::get('/countries', [FrontendCountryController::class, 'index'])->name('countries.index');
Route::get('/countries/{slug}', [FrontendCountryController::class, 'show'])->name('countries.show');

// Blogs
Route::get('/blogs', [FrontendBlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [FrontendBlogController::class, 'show'])->name('blogs.show');

// Contact
Route::get('/contact', [FrontendContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [FrontendContactController::class, 'store'])->name('contact.store');

//university
Route::get('/universities', [FrontendUniversityController::class, 'index'])->name('universities.index');
Route::get('/universities/{slug}', [FrontendUniversityController::class, 'show'])->name('universities.show');

// Application
Route::get('/apply', [FrontendApplicationController::class, 'create'])->name('application.create');
Route::post('/apply', [FrontendApplicationController::class, 'store'])->name('application.store');
Route::get('/application/success', [FrontendApplicationController::class, 'success'])->name('application.success');

// Teams
Route::get('/team', [HomeController::class, 'team'])->name('team');

// Events
Route::get('/events', [HomeController::class, 'events'])->name('events.index');

// Scholarships
Route::get('/scholarships', [HomeController::class, 'scholarships'])->name('scholarships.index');

// FAQs
Route::get('/faqs', [HomeController::class, 'faqs'])->name('faqs');

// Dynamic Pages
Route::get('/page/{slug}', [HomeController::class, 'page'])->name('page.show');

// ============================================
// AUTHENTICATION ROUTES (Laravel Breeze)
// ============================================

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ============================================
// ADMIN ROUTES (Protected by auth middleware)
// ============================================

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Countries
    Route::resource('countries', CountryController::class);

    // Courses
    Route::resource('courses', CourseController::class);

    Route::resource('about-topics', AboutTopicController::class);


    // Universities
    Route::resource('universities', UniversityController::class);

    // Services
    Route::resource('services', ServiceController::class);

    // Branches
    Route::resource('branches', BranchController::class);

    // Teams
    Route::resource('teams', TeamController::class);

    // Blogs
    Route::resource('blogs', BlogController::class);
    Route::post('blogs/{blog}/publish', [BlogController::class, 'publish'])->name('blogs.publish');

    // Contacts
    Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
    Route::patch('contacts/{contact}/status', [ContactController::class, 'updateStatus'])->name('contacts.status');
    Route::post('contacts/{contact}/reply', [ContactController::class, 'reply'])->name('contacts.reply');
    Route::delete('contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    // Applications
    Route::get('applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('applications/{application}', [ApplicationController::class, 'show'])->name('applications.show');
    Route::patch('applications/{application}/status', [ApplicationController::class, 'updateStatus'])->name('applications.status');
    Route::delete('applications/{application}', [ApplicationController::class, 'destroy'])->name('applications.destroy');
    Route::get('applications/export/excel', [ApplicationController::class, 'exportExcel'])->name('applications.export');

    // Testimonials
    Route::resource('testimonials', TestimonialController::class);

    // Events
    Route::resource('events', EventController::class);

    // FAQs
    Route::resource('faqs', FaqController::class);

    // Scholarships
    Route::resource('scholarships', ScholarshipController::class);

    // Appointments
    Route::get('appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
    Route::patch('appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.status');
    Route::delete('appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

    // Pages
    Route::resource('pages', PageController::class);

    // Settings (Admin Only)
    Route::middleware('admin')->group(function () {
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    });
});
