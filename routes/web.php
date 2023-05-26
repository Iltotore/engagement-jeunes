<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReferenceController;
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

Route::get("/registered", function () {
    return view("registered");
});

Route::get("/confirm", [AuthController::class, "confirm"]);

Route::get("/partners", function () {
    return view("partners");
});

Route::get("/settings", function () {
    return view("settings");
});

Route::get("/references", function () {
    return view("references");
});

Route::get("/references/display", [ReferenceController::class, "display"]);

Route::get("/api/login", [AuthController::class, "login"]);
Route::get("/api/register", [AuthController::class, "register"]);
Route::get("/api/references/add", [ReferenceController::class, "add"]);