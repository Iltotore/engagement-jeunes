<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller {
    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): RedirectResponse {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $redirect = $request->redirect ?? "/home";

        if (Auth::attempt($credentials)) {
            $request->session()->start();

            return redirect()->to($redirect);
        } else {
            return redirect()->intended("/login")->withErrors([
                'credentials' => 'Addresse mail ou mot de passe incorrect',
            ])->withInput($request->except("password"));
        }
    }
}
