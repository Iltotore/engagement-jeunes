<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

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

//C'est un GET mais c'est que pour le test

Route::get("/home", function () {
    return view("home");
});

Route::get("/login", function () {
    return view("login");
});

Route::get("/api/login", [LoginController::class, "authenticate"]);
