<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\DoctorScheduleController;
use App\Http\Controllers\AdminSettingController;
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
// Signup
Route::get('/', function(){
    return view("signin");
});
Route::get('signup', function(){
    return view("signup");
});
Route::post('signup/save', [AdminSettingController::class, 'signup']);
Route::post('signin/save', [AdminSettingController::class, 'signin']);
Route::get('dashboard', [AdminSettingController::class, 'dashboard']);
Route::get('profileUpdate/{id}', [AdminSettingController::class, 'updateProfile']);
Route::put('profileUpdate/save', [AdminSettingController::class, 'profileUpdateSave']);
Route::get('signout', [AdminSettingController::class, 'signout']);

// Speciality
Route::resource('speciality', SpecialityController::class);

// Doctor
Route::get('doctor', [DoctorsController::class, 'doctorsList']);
Route::get('doctor/{id}/editDoctor', [DoctorsController::class, 'editDoctor']);
Route::delete('doctor/{id}/delDoctor', [DoctorsController::class, 'deleteDoctor']);
Route::get('doctor/fetch_data', [DoctorsController::class, 'doctorAjaxPagination']);

Route::get('doctor/speciality', [DoctorsController::class, 'showSpeciality']); 
Route::post('doctor/save', [DoctorsController::class, 'doctorInsert']);
Route::post('doctor/uplaodImage', [DoctorsController::class, 'uplaodDcotorImage']);
Route::post('doctor/removeImage', [DoctorsController::class, 'removeDoctorImage']);
Route::get('doctor/{id}/viewDoctors', [DoctorsController::class, 'showDoctors']); 
Route::put('doctor/chnageStatus', [DoctorsController::class, 'changeStatusDoctor']);

// Doctor Schedule
Route::get('doctorSchedule', [DoctorScheduleController::class, 'doctorScheduleList']);
Route::post('doctorSchedule/save', [DoctorScheduleController::class, 'doctorScheduleSave']);
Route::get('doctorSchedule/{id}/edit', [DoctorScheduleController::class, 'editDoctorSchedule']);
Route::get('doctorSchedule/doctor', [DoctorScheduleController::class, 'showDoctors']); 
Route::get('doctorSchedule/fetch_data', [DoctorScheduleController::class, 'doctorScheduleAjaxPagination']);
Route::delete('doctorSchedule/delete/{id}', [DoctorScheduleController::class, 'destroyDoctorSchedule']);

// Doctor Portal
Route::get('doctorportal', function(){
    return view("doctor_signin");
});
Route::post('doctorportal/signin', [DoctorPortalController::class, 'signin']);