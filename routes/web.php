<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\FeesInvoiceController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\PaymentStudentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ReciptstudentController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentPromotionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeatcherController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('index');
       })->name('index');

});
// Auth
Route::get('login', [AuthController::class, 'showLogin']);
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('register', [AuthController::class, 'showRegister']);
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');





############# المراحل الدراسيه
Route::resource('grade', GradeController::class);
############# الصفوف الدراسيه
Route::resource('classroom', ClassroomController::class);
Route::post('delete_all', [ClassroomController::class, 'delete_all'])->name('delete_all');
Route::post('Filter_Classes', [ClassroomController::class, 'Filter_Classes'])->name('Filter_Classes');
########### الاقسام
Route::resource('section', SectionController::class);
Route::get('/classes/{id}', [SectionController::class,'getclasses']);
// livewire
Route::get('test', function () {
  return view('livewire.add-parent');
});


//################# المدرسين

Route::resource('teatchers',TeatcherController::class );
// ############### الطلاب
Route::resource('students', StudentController::class);
Route::get('Get_Classrooms/{id}', [StudentController::class, 'Get_Classrooms']);
Route::get('Get_Section/{id}', [StudentController::class, 'Get_Section']);
Route::resource('list_student', StudentController::class);

// ترقيه الطلاب
Route::resource('student_promotions', StudentPromotionController::class);

Route::resource('fees', FeeController::class);
Route::resource('fees_invoices', FeesInvoiceController::class);

Route::resource('reciptstudent', ReciptstudentController::class);
Route::resource('payment_student', PaymentStudentController::class);
Route::resource('attendance_student', AttendanceController::class);
Route::resource('subject_student', SubjectController::class);
Route::resource('quiz_student', QuizController::class);

Route::resource('library_student', LibraryController::class);
Route::resource('setting', SettingController::class);
