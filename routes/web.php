<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Zimmoah Enterprise Platform
|--------------------------------------------------------------------------
*/

// 1. Public Facing Pages (Maersk Inspired UI)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tracking', [HomeController::class, 'tracking'])->name('tracking');
Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');

// Services & Company
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/forwarding', [ServiceController::class, 'forwarding'])->name('forwarding');
    Route::get('/warehousing', [ServiceController::class, 'warehousing'])->name('warehousing');
    Route::get('/trucking', [ServiceController::class, 'trucking'])->name('trucking');
    Route::get('/consolidation', [ServiceController::class, 'consolidation'])->name('consolidation');
});

Route::get('/profile', [ServiceController::class, 'profile'])->name('company.profile');
Route::get('/contact', [ServiceController::class, 'contact'])->name('contact');

// 2. Career & Recruitment Portal
Route::prefix('careers')->name('career.')->group(function () {
    Route::get('/', [CareerController::class, 'index'])->name('index');
    Route::get('/{slug}', [CareerController::class, 'show'])->name('show');
    Route::post('/{slug}/apply', [CareerController::class, 'apply'])
        ->middleware('throttle:6,1') // Anti-spam rate limiting
        ->name('apply');
    Route::get('/{slug}/applied', [CareerController::class, 'success'])->name('success');
});

// 3. Email Ticketing & Customer Support System
Route::prefix('tickets')->name('tickets.')->group(function () {
    Route::get('/new', [TicketController::class, 'create'])->name('create');
    Route::post('/', [TicketController::class, 'store'])
        ->middleware('throttle:6,1') // Rate limiting
        ->name('store');
    Route::get('/track', [TicketController::class, 'track'])->name('track');
    Route::get('/lookup', [TicketController::class, 'track'])->name('lookup');
    Route::post('/{code}/reply', [TicketController::class, 'reply'])
        ->middleware('throttle:10,1')
        ->name('reply');
});

// Inbound Email Webhook API
Route::post('/api/inbound-email', [TicketController::class, 'inboundEmail'])->name('api.inbound_email');

// 4. Staff & Back-Office Admin Portal
Route::get('/login', [AdminController::class, 'showLogin'])->name('login');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])
        ->middleware('throttle:5,1') // Brute-force protection
        ->name('login.submit');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    // Authenticated Staff Area
    Route::middleware('auth')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

        // Helpdesk & Tickets
        Route::get('/tickets', [AdminController::class, 'tickets'])->name('tickets.index');
        Route::get('/tickets/{id}', [AdminController::class, 'showTicket'])->name('tickets.show');
        Route::post('/tickets/{id}/reply', [AdminController::class, 'replyTicket'])->name('tickets.reply');

        // HR ATS & Candidate Management
        Route::get('/applications', [AdminController::class, 'applications'])->name('applications.index');
        Route::get('/applications/{id}', [AdminController::class, 'showApplication'])->name('applications.show');
        Route::post('/applications/{id}/stage', [AdminController::class, 'updateApplicationStage'])->name('applications.stage');
        Route::post('/applications/{id}/notes', [AdminController::class, 'addApplicationNote'])->name('applications.notes');

        // Secure File Streamers (Private storage protection)
        Route::get('/resumes/{id}/download', [AdminController::class, 'downloadResume'])->name('resumes.download');
        Route::get('/attachments/{id}/download', [AdminController::class, 'downloadAttachment'])->name('attachments.download');
    });
});
