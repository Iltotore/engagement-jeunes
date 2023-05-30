<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;

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
})->middleware("auth");

Route::get("/references", function () {
    return view("references");
})->middleware("auth");

Route::get("/references/display", [ReferenceController::class, "display"]);
Route::get("/consult", [ReferenceController::class, "showConsult"]);

Route::post("/api/login", [AuthController::class, "login"]);
Route::post("/api/register", [AuthController::class, "register"]);
Route::post("/api/references/add", [ReferenceController::class, "add"]);
Route::post("/api/references/edit", [ReferenceController::class, "edit"]);
Route::post("/api/references/confirm", [ReferenceController::class, "confirm"]);
Route::post("/api/settings", [SettingsController::class, "update"]);
Route::post("/api/references/remove", [ReferenceController::class, "remove"]);
Route::post("/api/references/send", [ReferenceController::class, "sendConsult"]);
Route::post("/api/consults/remove", [ReferenceController::class, "removeConsult"]);