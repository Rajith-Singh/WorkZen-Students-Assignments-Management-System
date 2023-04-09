<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Lecturer\LecturerController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\AssignmentController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('user')->name('user.')->group(function(){
    Route::middleware(['guest:web','PreventBackHistory'])->group(function(){
        Route::view('/login','dashboard.user.login')->name('login');
        Route::view('/register','dashboard.user.register')->name('register');
        Route::post('/create',[UserController::class,'create'])->name('create');
        Route::post('/check',[UserController::class,'check'])->name('check');
        Route::get('/verify',[UserController::class,'verify'])->name('verify');

        Route::get('/password/forgot',[UserController::class,'showForgotForm'])->name('forgot.password.form');
        Route::post('/password/forgot',[UserController::class,'sendResetLink'])->name('forgot.password.link');
        Route::get('/password/reset/{token}',[UserController::class,'showResetForm'])->name('reset.password.form');
        Route::post('/password/reset',[UserController::class,'resetPassword'])->name('reset.password');

    });

    Route::middleware(['auth:web','is_user_verify_email','PreventBackHistory'])->group(function(){
        Route::view('/home','dashboard.user.home')->name('home');
        Route::post('/logout',[UserController::class,'logout'])->name('logout');

    });
});




Route::prefix('lecturer')->name('lecturer.')->group(function(){
    Route::middleware(['guest:lecturer','PreventBackHistory'])->group(function(){
        Route::view('/login','dashboard.lecturer.login')->name('login');
        Route::view('/register','dashboard.lecturer.register')->name('register');
        Route::post('/create',[LecturerController::class,'create'])->name('create');
        Route::post('/check',[LecturerController::class,'check'])->name('check');
        Route::get('/verify',[LecturerController::class,'verify'])->name('verify');

        Route::get('/password/forgot',[LecturerController::class,'showForgotForm'])->name('forgot.password.form');
        Route::post('/password/forgot',[LecturerController::class,'sendResetLink'])->name('forgot.password.link');
        Route::get('/password/reset/{token}',[LecturerController::class,'showResetForm'])->name('reset.password.form');
        Route::post('/password/reset',[LecturerController::class,'resetPassword'])->name('reset.password');

    });

    Route::middleware(['auth:lecturer','is_lecturer_verify_email','PreventBackHistory'])->group(function(){
        Route::view('/home','dashboard.lecturer.home')->name('home');
        Route::post('/logout',[LecturerController::class,'logout'])->name('logout');

        Route::get('/add-assignment', function () {
            return view('dashboard.lecturer.add-assignment');
        });

        Route::get('/manage-assignment',[AssignmentController::class,'manageAssignment']);

        Route::get('/show', [AssignmentController::class, 'show']);

        Route::get('/deleteAssignment/{id}', [AssignmentController::class, 'deleteAssignment']);

        Route::get('/editAssignment/{id}', [AssignmentController::class, 'editAssignment']);

        Route::post('/updateAssignment', [AssignmentController::class, 'updateAssignment']);


    });
});




Route::prefix('student')->name('student.')->group(function(){
    Route::middleware(['guest:student','PreventBackHistory'])->group(function(){
        Route::view('/login','dashboard.student.login')->name('login');
        Route::view('/register','dashboard.student.register')->name('register');
        Route::post('/create',[StudentController::class,'create'])->name('create');
        Route::post('/check',[StudentController::class,'check'])->name('check');
        Route::get('/verify',[StudentController::class,'verify'])->name('verify');

        Route::get('/password/forgot',[StudentController::class,'showForgotForm'])->name('forgot.password.form');
        Route::post('/password/forgot',[StudentController::class,'sendResetLink'])->name('forgot.password.link');
        Route::get('/password/reset/{token}',[StudentController::class,'showResetForm'])->name('reset.password.form');
        Route::post('/password/reset',[StudentController::class,'resetPassword'])->name('reset.password');

    });

    Route::middleware(['auth:student','is_student_verify_email','PreventBackHistory'])->group(function(){
        Route::view('/home','dashboard.student.home')->name('home');
        Route::post('/logout',[StudentController::class,'logout'])->name('logout');

        Route::get('/viewAssignment/{year}/{semester}', [AssignmentController::class, 'viewAssignment']);
        Route::get('/viewRelevantAssignment/{id}', [AssignmentController::class, 'viewRelevantAssignment']);

        Route::get('/status', function () {
            return view('dashboard.student.uploading-status');
        });

        Route::get('/viewReuploadingAssignment/{year}/{semester}', [AssignmentController::class, 'viewReuploadingAssignment']);
        Route::get('/viewReuploadingRelevantAssignment/{id}/{std_id}', [AssignmentController::class, 'viewReuploadingRelevantAssignment']);

        Route::get('/deleteSubmission/{id}/{std_id}', [AssignmentController::class, 'deleteSubmission']);

    });
});


Route::post('/saveAssignment',[AssignmentController::class,'storeAssignment']);

Route::post('/submission', [AssignmentController::class, 'uploadFile']);

Route::post('/resubmission', [AssignmentController::class, 'reuploadFile']);

Route::get('/download/{file}', [AssignmentController::class, 'download']);

Route::get('/view{id}', [AssignmentController::class, 'view']);


