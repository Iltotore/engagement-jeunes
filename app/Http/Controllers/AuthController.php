<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\RegisterMail;
use App\Services\TimeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\Factory;
use Illuminate\View\View;

class AuthController extends Controller
{

    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            "email" => ["required", "email"],
            "password" => ["required"],
        ]);

        $redirect = $request->redirect ?? "/home";
        $remember_me = $request->remember_me;

        if (Auth::attempt($credentials, $remember_me)) {
            if (!Auth::user()->isConfirmed()) {
                $request->session()->flush();
                return redirect()
                    ->back()
                    ->withErrors(["email" => "Mail non confirmé"]);
            }
            $request->session()->start();
            return redirect()->to($redirect);
        } else {
            return redirect()
                ->back()
                ->withErrors(["credentials" => "Addresse mail ou mot de passe incorrect"])
                ->withInput($request->except("password", "confirm"));
        }
    }

    public function register(Request $request): RedirectResponse
    {
        $time = App::make(TimeService::class);

        $request->validate([
            "email" => ["required", "email"],
            "password" => ["required", "min:8", "max:50"],
            "confirm" => ["required", "min:8", "max:50"],
            "first_name" => ["required", "max:50", "regex:/^[a-zA-Z\u{00C0}-\u{00D6}\u{00D8}-\u{00F6}\u{00F8}-\u{024F} -]+$/u"],
            "last_name" => ["required", "max:50", "regex:/^[a-zA-Z\u{00C0}-\u{00D6}\u{00D8}-\u{00F6}\u{00F8}-\u{024F} -]+$/u"],
            "birth_date" => ["required", "date"],
        ]);

        $errors = [];

        $current = $time->currentTime(0);
        $age = $current - strtotime($request->birth_date);
        $year = 365*24*3600;

        if($age < 16*$year || $age > 30*$year) $errors += ["birth" => "Seuls les jeunes de 16 à 30 ans peuvent s'inscrire.".$request->birth_date];
        if ($request->password != $request->confirm) $errors += ["password" => "Les deux mots de passe ne correspondent pas."];
        if (User::where("email", $request->email)->first()) $errors += ["email" => "Cet email est déjà utilisé"];

        if (sizeof($errors) > 0)
            return redirect()
                ->back()
                ->withErrors($errors)
                ->withInput($request->except("password", "confirm"));

        $newUser = User::createUnconfirmed($request->email, $request->password, $request->first_name, $request->last_name, $request->birth_date);

        Mail::to($request->email)->send(new RegisterMail($newUser));

        return redirect()
            ->to("/registered")
            ->with(["user" => $newUser]);
    }

    public function confirm(Request $request): RedirectResponse|View|Factory
    {
        $token = $request->token;

        $user = User::where("registration_token", $token)->first();
        if ($user) {
            $user->confirm();
            return view("confirm");
        } else abort(404);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

       //$request->session()->regenerateToken(); if problem uncomment

        return redirect("/home");
    }
}

