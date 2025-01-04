<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CTFcontroller;
use App\Http\Controllers\ProfilesController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\SocialiteController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;


use App\Http\Controllers\AcademyController;
use App\Http\Controllers\PageController;

Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.edit_user');
Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
Route::get('/auth/redirect', [SocialiteController::class, 'redirect']);
Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);  

Route::get('/register-mentor', [AdminController::class, 'showMentorRegistrationForm'])->name('register.mentor.form');
    Route::post('/register-mentor', [AdminController::class, 'registerMentor'])->name('register.mentor');
Route::get('/academy', [AcademyController::class, 'index'])->name('academy');

Route::get('/mentor', [PageController::class, 'mentor_index'])
    ->name('mentor_index')
    ->middleware(['auth', 'verified']);
    

    


use App\Http\Controllers\CourseController;

Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create')->middleware('auth');
Route::post('/courses', [CourseController::class, 'store'])->name('courses.store')->middleware('auth');
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');



Route::get('/', function () {
    return view('index');
});



/**
 * Section page
 */
Route::post('/challenge/{id}/submit', [CTFcontroller::class, 'submit'])->name('challenge.submit');

Route::get('/about' , [SessionController::class, 'about']) -> name('about');
Route::get('/index' , [SessionController::class, 'index']) -> name('index');
Route::get('/team' , [SessionController::class, 'team']) -> name('team');
Route::get('/netsim' , [SessionController::class, 'netsim']) -> name('netsim');
Route::get('/about_ctf' , [SessionController::class, 'about_ctf']) -> name('about_ctf');

// routes/web.php
// 
Route::get('/dashboard', function () {
    
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/student/courses', [CourseController::class, 'indexForStudent'])->name('student.courses');
Route::post('/courses/{course}/join', [CourseController::class, 'join'])->name('courses.join');

Route::get('/ctf/os-challenge', [CTFController::class, 'osChallenge'])->name('ctf.os_challenge');
Route::post('/ctf/check-os-flag', [CTFController::class, 'checkOSFlag'])->name('ctf.check_os_flag');

Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');
Route::get('/materials', [CourseController::class, 'showJoinedMaterials'])->name('materials.index');

Route::get('admin/edit/{userId}', [AdminController::class, 'editUser'])->name('admin.editUser');
Route::delete('admin/delete/{userId}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
Route::get('admin/index', [AdminController::class, 'index'])->name('admin_index');

Route::get('/courses/{courseId}', [CourseController::class, 'show'])->name('courses.show');

Route::get('/ctf', [CTFController::class, 'index'])->name('ctf.index');

Route::get('/ctf/encryption', [CTFController::class, 'encryption'])->name('ctf.encryption');


Route::post('/ctf/encryption', [CTFController::class, 'checkEncryptionFlag'])->name('ctf.encryption.check');
Route::get('/ctf/lfi', [CTFController::class, 'lfi'])->name('ctf.lfi');

Route::post('/ctf/lfi/submit', [CTFController::class, 'submitLFI'])->name('ctf.lfi.submit');


Route::get('/ctf/directory-traversal', [CTFController::class, 'directoryTraversal'])->name('ctf.directory_traversal');


Route::post('/ctf/check-directory-traversal', [CTFController::class, 'checkDirectoryTraversal'])->name('ctf.check_directory_traversal');
Route::get('/ctf/secret-page', [CTFController::class, 'secretPage'])->name('ctf.secret_page');
Route::post('/ctf/submit-secret-flag', [CTFController::class, 'submitSecretPageFlag'])->name('ctf.submit_secret_flag');

Route::get('/ctf/reset', [CTFController::class, 'resetChallenges'])->name('ctf.reset');
use App\Http\Controllers\CertificateController;



Route::get('/mentor/certificate/{mentorName}', [CertificateController::class, 'showCertificate'])->name('mentor.certificate');


require __DIR__.'/auth.php';

Route::get('/profiles', [ProfilesController::class, 'show'])->name('custom_profile.show');

Route::get('/courses/{courseId}/payment', [CourseController::class, 'payment'])->name('courses.payment');
Route::post('/courses/{courseId}/payment', [CourseController::class, 'processPayment'])->name('courses.processPayment');


Route::get('/my-courses', [CourseController::class, 'myCourses'])
    ->name('courses.myCourses')
    ->middleware('auth');

// ...
Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
Route::get('/joined-courses', [CourseController::class, 'listJoinedCourses'])->name('courses.joined.list');

use App\Http\Controllers\QuizController;



Route::post('/submit-quiz', [QuizController::class, 'submitQuiz'])->name('quiz.submit');

Route::get('/material-images/{filename}', [CourseController::class, 'showImage'])->name('material.image');