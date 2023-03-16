<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Grade\GradeController;
use App\Http\Controllers\Classroom\ClassroomController;
use App\Http\Controllers\Section\SectionController;
use App\Http\Controllers\Student\PromotionController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Teacher\TeacherController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware(['guest']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth', 'verified']
], function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('grades', GradeController::class);
    Route::resource('classrooms', ClassroomController::class);
    Route::post('delete_all', [ClassroomController::class, 'delete_all'])->name('delete_all');
    Route::post('filter_classes', [ClassroomController::class, 'filter_classes'])->name('filter_classes');
    Route::resource('sections', SectionController::class);
    Route::get('classes/{id}', [SectionController::class, 'getClasses']);
    Route::view('add_parent', 'livewire.show_Form')->name('add_parent');

    Route::resource('teachers', TeacherController::class);

    Route::resource('students', StudentController::class);
    Route::get('Get_classrooms/{id}', [StudentController::class, 'Get_classrooms']);
    Route::get('Get_sections/{id}', [StudentController::class, 'Get_sections']);

    Route::post('upload_attachment', [StudentController::class, 'upload_attachment'])
        ->name('upload_attachment');
    Route::get('download_attachment/{studentsname}/{filename}', [StudentController::class, 'download_attachment'])
        ->name('download_attachment');
    Route::post('delete_attachment', [StudentController::class, 'delete_attachment'])
        ->name('delete_attachment');

    Route::resource('promotios', PromotionController::class);

});
require __DIR__ . '/auth.php';
