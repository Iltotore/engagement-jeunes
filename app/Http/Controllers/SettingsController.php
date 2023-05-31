<?php


namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\RegisterMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\Factory;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'birth_date' => ['required', 'date'],
        ]);
        $user = $request->user();
        $errors = [];
        if (!Hash::check($request->password, $user->password)) $errors += ['password' => 'Mot de passe incorect'];
        if (Hash::check($request->new_password, $user->password)) $errors += ['password' => 'Le nouveau mot de passe doit être différent de l\'ancien'];
        if ($request->new_password != $request->confirm) $errors += ['new_password' => 'Les deux mots de passe ne correspondent pas.'];

        if (sizeof($errors) > 0)
            return redirect()
                ->intended("/settings")
                ->withErrors($errors)
                ->withInput($request->except("password", "confirm"));
        else {
            if ($request->new_password != null) {
                $user->password = $request->new_password;
                $user->save();
                $request->session()->flush();
            }
            if ($request->email != $user->email) {
                $user->email = $request->email;
                $user->save();
                $user->unconfirm();
                $request->session()->flush();
                //Mail::to($user->email)->send(new RegisterMail($user)); ACTIVATE IT LATER

            }
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->birth_date = $request->birth_date;
            $user->save();
            Log::info("validated bitch");
            return redirect()
                ->intended("/settings")
                ->withInput($request->except("password", "confirm"));
        }
    }
}