<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\Adminmiddleware;
use App\Http\Controllers\LogInController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EmployeeController;
use Spatie\GoogleCalendar\Event;
use App\Http\Controllers\ChatsController;


// LoggedOut Routes (wag baguhin mag log in ka nalang kapag may ichecheck kang feature)
Route::get('/', function () {return view('loggedOut.index');})->name('index'); // ->middleware(Adminmiddleware::class);

Route::get('/loggedOut/seemore', function () {return view('loggedOut.seemore');})->name('seemore');

//admin routes
Route::post('/admin/calendar', [AdminController::class, 'store'])->name('calendar.store');
Route::get('/admin/forum', [AdminController::class, 'forum'])->name('admin.forum');
Route::get('/admin/calendar', [AdminController::class, 'calendar'])->name('admin.calendar');
Route::get('/admin/get-google-calendar-events', [AdminController::class, 'getGoogleCalendarEvents']);
Route::get('/admin/calendar', [AdminController::class, 'calendar'])->name('admin.calendar');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/chats', [AdminController::class, 'chats'])->name('admin.chats');
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/check', [AdminController::class, 'check'])->name('admin.check');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

//user routes
Route::post('user/save', [UserController::class, 'save'])->name('user.save');
Route::get('/user/forum', [UserController::class, 'forum'])->name('user.forum');
Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
Route::get('/user/faq', [UserController::class, 'faq'])->name('user.faq');
Route::get('/workspace/colormatch', [UserController::class, 'colormatch'])->name('workspace.colormatch');
Route::get('/workspace/game', [UserController::class, 'game'])->name('workspace.game');
Route::get('/user/calendar', [UserController::class, 'calendar'])->name('user.calendar');
Route::get('/user/chats', [UserController::class, 'chats'])->name('user.chats');
Route::get('/user/login', [UserController::class, 'login'])->name('user.login');
Route::post('/user/check', [UserController::class, 'check'])->name('user.check');
Route::get('/user/register', [UserController::class, 'register'])->name('user.register');

// Employee routes
Route::get('/employee/EmployeeChat', [EmployeeController::class, 'EmployeeChat'])->name('employee.EmployeeChat');
Route::get('/employee/EmployeeCalendar', [EmployeeController::class, 'EmployeeCalendar'])->name('employee.EmployeeCalendar');
Route::get('/employee/EmployeeForum', [EmployeeController::class, 'EmployeeForum'])->name('employee.EmployeeForum');

// Log in and Log out routes
Route::post('/', [LogInController::class, 'login'])->name('login.user');
Route::post('/', [LogInController::class, 'logout'])->name('logout');

//forum routes
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::resource('/posts', PostController::class)->except(['index', 'show']);
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::resource('/posts', PostController::class)->except(['index', 'show']);

// chats
Route::get('/fetch-messages', [ChatsController::class, 'fetchMessagesFromUserToAdmin'])->name('fetch.messagesFromSellerToAdmin');
Route::post('/send-message', [ChatsController::class, 'sendMessageFromUserToAdmin'])->name('send.Messageofsellertoadmin');

Route::get('/admin/fetch-messages', [ChatsController::class, 'fetchMessages'])->name('admin.fetchMessages');
Route::post('/admin/send-message', [ChatsController::class, 'sendMessage'])->name('admin.sendMessage');