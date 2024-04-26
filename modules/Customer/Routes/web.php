<?php
use Illuminate\Support\Facades\Route;
use Modules\Customer\Http\Controllers\Auth\ForgotPasswordController;
use Modules\Customer\Http\Controllers\Auth\LoginController;
use Modules\Customer\Http\Controllers\Auth\LogoutController;
use Modules\Customer\Http\Controllers\Auth\RegisterController;
use Modules\Customer\Http\Controllers\Auth\ResetPasswordController;
use Modules\Customer\Http\Controllers\HomeController;
use Modules\Customer\Http\Controllers\ProfileController;

Route::get("/", [HomeController::class, "index"])->name("home");
Route::get('/contact', [HomeController::class, "contact"])->name("contact");
Route::get('/about-us', [HomeController::class, "aboutUs"])->name("about_us");


Route::group(["middleware" => "guest"], function(){
    Route::get("login", [LoginController::class, "login"])->name("login");
    Route::post("login", [LoginController::class, "handleLogin"])->name("handle_login");

    Route::get("register", [RegisterController::class, "register"])->name("register");
    Route::post("register", [RegisterController::class, "handleRegister"])->name("handle_register");

    Route::get('/forgot-password', [ForgotPasswordController::class, "index"])->name("forgot_password");
    Route::post('/forgot-password', [ForgotPasswordController::class, "checkUser"])->name("check_user");

    Route::get('/confirm-otp', [ForgotPasswordController::class, "confirmOtp"])->name("confirm_otp");
    Route::post('/confirm-otp', [ForgotPasswordController::class, "checkInvalidOtp"])->name("check_invalid_otp");

    Route::post('/resend-otp', [ForgotPasswordController::class, "resendOtp"])->name("resend_otp");

    Route::get('/reset-password', [ResetPasswordController::class, "resetPassword"])->name("reset_password");
    Route::post('/reset-password', [ResetPasswordController::class, "updatePassword"])->name("update_password");

});


Route::group(["middleware" => "auth"], function(){
    Route::get("profile", [ProfileController::class, "index"])->name("profile.index");
    Route::put("profile", [ProfileController::class, "update"])->name("profile.update");
    Route::get("change-password", [ProfileController::class, "update"])->name("profile.update");
    Route::post("change-password", [ProfileController::class, "update"])->name("profile.update");
});

Route::get('/logout', [LogoutController::class, "logout"])->name("logout");




