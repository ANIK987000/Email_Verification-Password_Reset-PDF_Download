<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
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


// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->name('verification.notice');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();
 
//     return back()->with('message', 'Verification link sent!');
// })->middleware(['throttle:6,1'])->name('verification.send');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
 
//     return redirect()->route('user.dashboard');
// })->middleware(['signed'])->name('verification.verify');



//____________________________________________________________

Route::get('/',[LoginController::class, 'home'])->name('home');
Route::get('/registration',[function(){return view('registration');}])->name('registration');
Route::post('/registration',[RegistrationController::class, 'registration'])->name('submit.registration');
Route::get('/login',[function () {return view('login');}])->name('login');
Route::post('/login',[LoginController::class, 'login'])->name('submit.login');

Route::get('/logout',[LoginController::class, 'userLogout'])->name('logout');

//______________________________________________________________

Route::get('admin/dashboard',[AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/search',[AdminController::class,'search'])->name('admin.search');
Route::post('/toggle/status',[AdminController::class,'toggleStatus'])->name('admin.toggleStatus');

//______________________________________________________________

Route::get('user/dashboard',[UserController::class, 'dashboard'])->name('user.dashboard');
Route::get('/profile',[UserController::class, 'profile'])->name('user.profile');
Route::get('/update/profile',[UserController::class, 'updateProfile'])->name('user.updateProfile');
Route::post('/update/profile',[UserController::class, 'updateProfileSubmit'])->name('user.updateProfileSubmit');
Route::get('/user/details/{Email}',[UserController::class,'userDetails'])->name('user.userDetails');
Route::get('/profile/download',[UserController::class,'downloadProfile'])->name('download.profile');
Route::get('/forgot/password',[UserController::class,'forgotPassword'])->name('forgot.password');
Route::post('/reset/password/mail',[UserController::class,'resetPasswordMail'])->name('reset.password.mail');
Route::get('/reset/password/{verification_code}',[UserController::class,'resetPassword'])->name('reset.password');
Route::post('/reset/password/{verification_code}',[UserController::class,'resetPasswordMainPage'])->name('reset.password.main.page');

//_____________________________________________________

Route::get('/email/verify/{verification_code}',[RegistrationController::class,'verifyMail'])->name('verify.mail');
Route::post('/email/resend',[RegistrationController::class,'resendMail'])->name('resend.mail');
Route::get('/verify/email',[RegistrationController::class,'verifyEmail'])->name('auth.verify-email');


