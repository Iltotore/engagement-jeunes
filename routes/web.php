<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\SettingsController;
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


// Fallback for GET requests to /references/summarize. These can happen when refreshing for example.
Route::get("/references/summarize", function() {
	return redirect("/account");
})->middleware("auth");

// Summary Generation POST Route
Route::any("/references/summarize", function() {
	$summary_settings = $_POST;
	if($summary_settings["summary_type"] == "PDF") {
		$pdf = App::make('dompdf.wrapper');
		$pdf->loadHTML(view("reference_summary_template", ["summary_settings"=>$summary_settings]));
		return $pdf->stream();
	}
	else {
		return view("reference_summary_template", ["summary_settings"=>$summary_settings]);
	}
})->middleware(["post", "auth.account"]);

Route::get("/logout", [AuthController::class, "logout"]);
Route::get("/references/display", [ReferenceController::class, "display"]);
Route::get("/consult", [ReferenceController::class, "showConsult"]);

Route::any("/api/login", [AuthController::class, "login"])->middleware("post");
Route::any("/api/register", [AuthController::class, "register"])->middleware("post");;
Route::any("/api/references/add", [ReferenceController::class, "add"])->middleware(["post", "auth.account"]);
Route::any("/api/references/edit", [ReferenceController::class, "edit"])->middleware("post");;
Route::any("/api/references/confirm", [ReferenceController::class, "confirm"])->middleware("post");;
Route::any("/api/settings", [SettingsController::class, "update"])->middleware(["post", "auth.account"]);
Route::any("/api/references/remove", [ReferenceController::class, "remove"])->middleware(["post", "auth.account"]);
Route::any("/api/references/send", [ReferenceController::class, "sendConsult"])->middleware(["post", "auth.account"]);
Route::any("/api/consults/remove", [ReferenceController::class, "removeConsult"])->middleware(["post", "auth.account"]);
