<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\RegisterMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller {

    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request): RedirectResponse {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $redirect = $request->redirect ?? "/home";

        if (Auth::attempt($credentials)) {
            $request->session()->start();
            return redirect()->to($redirect);
        } else {
            return redirect()
                ->intended("/login")
                ->withErrors(['credentials' => 'Addresse mail ou mot de passe incorrect'])
                ->withInput($request->except("password", "confirm"));
        }
    }

    public function register(Request $request): RedirectResponse {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'confirm' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'birth_date' => ['required', 'date'],
        ]);

        $redirect = $request->redirect ?? "/home";

        $errors = [];

        if ($request->password != $request->confirm) $errors += ['password' => 'Les deux mots de passe ne correspondent pas.'];
        if (User::where("email", $request->email)->first()) $errors += ['email' => 'Cet email est déjà utilisé'];

        if (sizeof($errors) > 0)
            return redirect()
                ->intended("/login")
                ->withErrors($errors)
                ->withInput($request->except("password", "confirm"));

        $newUser = User::createUnconfirmed( $request->email, $request->password, $request->first_name, $request->last_name, $request->birth_date);

        Mail::to($request->email)->send(new RegisterMail($newUser));

        return redirect()
            ->to("/registered")
            ->with(["user" => $newUser]);
    }
}
