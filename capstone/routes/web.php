<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LogInController;

// LoggedOut Routes
Route::get('/', function () {
    return view('loggedOut.index');
})->name('index');

Route::get('/loggedOut/seemore', function () {
    return view('loggedOut.seemore');
})->name('seemore');

// Admin Routes
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/forum', [AdminController::class, 'forum'])->name('admin.forum');
    Route::get('/admin/chats', [AdminController::class, 'chats'])->name('admin.chats');
    Route::get('/admin/fullcalendar', [AdminController::class, 'fullcalendar'])->name('admin.fullcalendar');
    Route::get('/admin/events', [AdminController::class, 'getEvents'])->name('admin.events');
    Route::post('/admin/events', [AdminController::class, 'createEvent'])->name('admin.events.create');
    Route::get('/appointments', [AdminController::class, 'viewAppointments'])->name('appointments.index');
    Route::get('/appointments/{event}/edit', [AdminController::class, 'editAppointment'])->name('appointments.edit');
    Route::put('/appointments/{event}', [AdminController::class, 'updateAppointment'])->name('appointments.update');
    Route::delete('/appointments/{event}', [AdminController::class, 'deleteAppointment'])->name('appointments.destroy');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/dashboard/download-pdf', [AdminController::class, 'downloadDashboard'])->name('admin.dashboard.pdf');
    Route::get('/admin/clients', [AdminController::class, 'clients'])->name('admin.clients');

    Route::get('/admin/clients', [AdminController::class, 'clients'])->name('admin.clients');

    Route::get('admin/users', [AdminController::class, 'viewUsers'])->name('admin.users');
    Route::delete('admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    Route::get('/posts/admin', [PostController::class, 'admin'])->name('posts.admin');
    Route::get('/posts/admin/{post}', [PostController::class, 'showadmin'])->name('posts.showadmin');



    // Admin Chats
    Route::get('/admin/fetch-messages', [ChatsController::class, 'fetchMessages'])->name('admin.fetchMessages');
    Route::post('/admin/send-message', [ChatsController::class, 'sendMessage'])->name('admin.sendMessage');
});



Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/check', [AdminController::class, 'check'])->name('admin.check');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// User Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/user/forum', [UserController::class, 'forum'])->name('user.forum');
    // Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/user/faq', [UserController::class, 'faq'])->name('user.faq');
    Route::get('/workspace/colormatch', [UserController::class, 'colormatch'])->name('workspace.colormatch');
    Route::get('/workspace/game', [UserController::class, 'game'])->name('workspace.game');

    Route::get('/user/chats', [UserController::class, 'chats'])->name('user.chats');
    Route::get('/user/events', [UserController::class, 'getEvents'])->name('user.events');
    Route::get('/user/fullcalendar', [UserController::class, 'fullcalendar'])->name('user.fullcalendar');

    // View profile
    Route::get('user/profile', [UserController::class, 'viewProfile'])->name('user.profile');

    // Edit profile
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::post('/profile/edit', [UserController::class, 'updateProfile'])->name('profile.update');

    // Change password
    Route::get('/profile/change-password', [UserController::class, 'changePassword'])->name('password.change');
    Route::post('/profile/change-password', [UserController::class, 'updatePassword'])->name('password.update');

    // User Chats
    Route::get('/fetch-messages', [ChatsController::class, 'fetchMessagesFromUserToAdmin'])->name('fetch.messagesFromSellerToAdmin');
    Route::post('/send-message', [ChatsController::class, 'sendMessageFromUserToAdmin'])->name('send.Messageofsellertoadmin');
});

Route::get('/user/login', [UserController::class, 'login'])->name('user.login');
Route::post('/user/check', [UserController::class, 'check'])->name('user.check');
Route::post('/user/save', [UserController::class, 'save'])->name('user.save');
Route::get('/user/register', [UserController::class, 'register'])->name('user.register');
Route::get('/user/logout', [UserController::class, 'logout'])->name('user.logout');

// Employee Routes (add middleware if employees need specific authentication)
Route::get('/employee/EmployeeChat', [EmployeeController::class, 'EmployeeChat'])->name('employee.EmployeeChat');
Route::get('/employee/EmployeeCalendar', [EmployeeController::class, 'EmployeeCalendar'])->name('employee.EmployeeCalendar');
Route::get('/employee/EmployeeForum', [EmployeeController::class, 'EmployeeForum'])->name('employee.EmployeeForum');

// Log in and Log out routes
Route::post('/', [LogInController::class, 'login'])->name('login.user');
Route::post('/', [LogInController::class, 'logout'])->name('logout');

// Forum Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::resource('/posts', PostController::class)->except(['index', 'show'])->middleware('check.badwords');
    Route::post('/posts/{post}/comment', [PostController::class, 'storeComment'])->name('posts.comment');
Route::post('/posts/{post}/like', [PostController::class, 'toggleLike'])->name('posts.like');

});

