<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/', function(){
    return view("pages.home");
})->name("home");

Route::get('/products', function(){
    return view("pages.products.index");
})->name("products");

Route::get('/products/1', function(){
    return view("pages.products.details");
})->name("products.details");

Route::get('/blogs', function(){
    return view("pages.blogs.index");
})->name("blogs");

Route::get('/blogs/1', function(){
    return view("pages.blogs.details");
})->name("blogs.details");

Route::get('/carts', function(){
    return view("pages.carts.details");
})->name("carts");

Route::get('/checkout', function(){
    return view("pages.carts.checkout");
})->name("checkout");

Route::get('/contact', function(){
    return view("pages.contact");
})->name("contact");

Route::get('/about-us', function(){
    return view("pages.contact");
})->name("about_us");

Route::get('/login', function(){
    return view("pages.auth.login");
})->name("login");

Route::get('/register', function(){
    return view("pages.auth.register");
})->name("register");