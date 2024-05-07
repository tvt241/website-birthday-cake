<?php
use Illuminate\Support\Facades\Route;
use Modules\Customer\Http\Controllers\Auth\ForgotPasswordController;
use Modules\Customer\Http\Controllers\Auth\LoginController;
use Modules\Customer\Http\Controllers\Auth\LogoutController;
use Modules\Customer\Http\Controllers\Auth\RegisterController;
use Modules\Customer\Http\Controllers\Auth\ResetPasswordController;
use Modules\Customer\Http\Controllers\Auth\SocialiteController;
use Modules\Customer\Http\Controllers\HomeController;
use Modules\Customer\Http\Controllers\ProfileController;

Route::get("/", [HomeController::class, "index"])->name("home");
Route::get('/contact', [HomeController::class, "contact"])->name("contact");
Route::post('/contact', [HomeController::class, "storeContact"])->name("store_contact");
Route::get('/about-us', [HomeController::class, "aboutUs"])->name("about_us");
Route::get('/terms-and-condition', [HomeController::class, "termsAndCondition"])->name("terms_and_condition");
Route::get('/privacy-policy', [HomeController::class, "privacyPolicy"])->name("privacy_policy");
Route::get('/privacy-policy', [HomeController::class, "privacyPolicy"])->name("privacy_policy");
Route::get('/privacy-policy', [HomeController::class, "privacyPolicy"])->name("return_policy");
Route::get('/privacy-policy', [HomeController::class, "privacyPolicy"])->name("refund_policy");
Route::get('/privacy-policy', [HomeController::class, "privacyPolicy"])->name("cancellation_policy");

// cancellation_policy



Route::group(["middleware" => "guest"], function(){
    Route::get("login", [LoginController::class, "login"])->name("login");
    Route::post("login", [LoginController::class, "handleLogin"])->name("handle_login");

    Route::get("register", [RegisterController::class, "register"])->name("register");
    Route::post("register", [RegisterController::class, "handleRegister"])->name("handle_register");

    Route::get('/auth/{social}', [SocialiteController::class, "redirect"])->name("social.login");
    Route::get('/auth/{social}/callback', [SocialiteController::class, "login"]);

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
    Route::get("profile-update", [ProfileController::class, "edit"])->name("profile.edit");
    Route::put("profile-update", [ProfileController::class, "update"])->name("profile.update");
    Route::get("change-password", [ProfileController::class, "update"])->name("password.index");
    Route::post("change-password", [ProfileController::class, "update"])->name("password.update");
    Route::post("delete-account", [ProfileController::class, "delete"])->name("profile.delete");
});

Route::get('/logout', [LogoutController::class, "logout"])->name("logout");




