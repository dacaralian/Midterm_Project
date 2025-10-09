<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\CourseController;

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

Route::post('/chat', [ChatbotController::class, 'sendMessage']);
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
