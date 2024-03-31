<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Admin;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/studentHomePage', [CourseController::class, 'showCourses'])->name('studentHomePage');
Route::post('/add-course', [CourseController::class, 'addCourse'])->name('addCourse');

Route::get('/adminHomePage', [Admin::class, 'adminHomePage'])->name('adminHomePage');
Route::post('/create-course', [Admin::class, 'createCourse'])->name('createCourse');
Route::delete('/delete-course/{id}', [Admin::class, 'deleteCourse'])->name('deleteCourse');
Route::delete('/delete-all-courses', [Admin::class, 'deleteAllCourses'])->name('deleteAllCourses');
Route::post('/create-student', [Admin::class, 'createStudent'])->name('createStudent');
Route::put('/update-student/{id}', [Admin::class, 'updateStudent'])->name('updateStudent');
Route::put('/update-course/{id}', [Admin::class, 'updateCourse'])->name('updateCourse');
Route::delete('/delete-student/{id}', [Admin::class, 'deleteStudent'])->name('deleteStudent');
Route::delete('/delete-all-students', [Admin::class, 'deleteAllStudents'])->name('deleteAllStudents');
Route::post('/toggle-student-status/{id}', [Admin::class, 'toggleStudentStatus'])->name('toggleStudentStatus');
Route::get('/editTable/{studentId}', [CourseController::class, 'showEditTable'])->name('editTable');
Route::delete('/delete-course-association/{userId}/{courseId}', [CourseController::class, 'deleteCourseAssociation'])->name('deleteCourseAssociation');
