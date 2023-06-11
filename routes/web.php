<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\App;

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

//Pages
Route::get('/', function () {
    return view('welcome');
});

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

Route::get("/account", function () {
    return view("references");
})->middleware("auth");

Route::get("/logout", [AuthController::class, "logout"]);
Route::get("/references/display", [ReferenceController::class, "display"]);
Route::get("/consult", [ReferenceController::class, "showConsult"]);

// Summary generation
Route::any("/references/summarize", [ReferenceController::class, "summarize"])->middleware(["post", "auth.account"]);

//Private API Routes.
Route::any("/api/login", [AuthController::class, "login"])->middleware("post");
Route::any("/api/register", [AuthController::class, "register"])->middleware("post");;
Route::any("/api/references/add", [ReferenceController::class, "add"])->middleware(["post", "auth.account"]);
Route::any("/api/references/edit", [ReferenceController::class, "edit"])->middleware("post");;
Route::any("/api/references/confirm", [ReferenceController::class, "confirm"])->middleware("post");;
Route::any("/api/settings", [SettingsController::class, "update"])->middleware(["post", "auth.account"]);
Route::any("/api/references/remove", [ReferenceController::class, "remove"])->middleware(["post", "auth.account"]);
Route::any("/api/references/send", [ReferenceController::class, "sendConsult"])->middleware(["post", "auth.account"]);
Route::any("/api/consults/remove", [ReferenceController::class, "removeConsult"])->middleware(["post", "auth.account"]);

//Admin routes
Route::get("/admin", [AdminController::class, "getPanel"])->middleware("admin");

Route::post("/api/admin/users/remove", [AdminController::class, "removeUsers"])->middleware("admin");
Route::post("/api/admin/references/remove", [AdminController::class, "removeReferences"])->middleware("admin");
