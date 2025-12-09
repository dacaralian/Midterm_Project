<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ScheduleController;

Route::get('/', function () {
    return view('home');
});

Route::get('/courses', function () {
    return view('courses');
});

Route::get('/announcements', function () {
    return view('announcements');
});

Route::get('/contactus', function () {
    return view('contactus');
});

// Chatbot Route
Route::post('/chat', [ChatbotController::class, 'sendMessage'])->name('chat.send');


// Course CRUD
Route::resource('courses', CourseController::class);

// Activities CRUD
Route::post('/courses/{course}/activities', [CourseController::class, 'storeActivity'])->name('courses.activities.store');
Route::put('/activities/{activity}', [CourseController::class, 'updateActivity'])->name('activities.update');
Route::delete('/activities/{activity}', [CourseController::class, 'deleteActivity'])->name('activities.delete');

// Schedule CRUD
Route::post('/courses/{course}/schedules', [ScheduleController::class, 'store'])->name('courses.schedules.store');
Route::put('/schedules/{schedule}', [ScheduleController::class, 'update'])->name('schedules.update');
Route::delete('/schedules/{schedule}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');