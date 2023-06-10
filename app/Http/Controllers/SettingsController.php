<?php


namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\RegisterMail;
use App\Services\TimeService;
use DateTimeInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\Factory;
use Illuminate\View\View;

/**
 * Controller for the /settings page.
 */
class SettingsController extends Controller
{

    /**
     * Update settings
     */
    public function update(Request $request): RedirectResponse
    {
        $time = App::make(TimeService::class);

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'first_name' => ['required', 'max:50'],
            'last_name' => ['required', 'max:50'],
            'birth_date' => ['required', 'date'],
        ]);
        $user = $request->user();
        $errors = [];
        $current = $time->currentTime(0);
        $age = $current - strtotime($request->birth_date);
        $year = 365*24*3600;
        if($age < 16*$year || $age > 30*$year) $errors += ["birth" => "Seuls les jeunes de 16 à 30 ans peuvent s'inscrire."];
        if ($request->email != $user->email && User::where("email", $request->email)->first()) $errors += ['email' => 'Cet email est déjà utilisé'];
        if (!Hash::check($request->password, $user->password)) $errors += ['password' => 'Mot de passe incorect'];
        if ($request->new_password != null && Hash::check($request->new_password, $user->password)) $errors += ['password' => 'Le nouveau mot de passe doit être différent de l\'ancien'];
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

            return redirect()
                ->intended("/settings")
                ->with([
                    "notifications" => [
                        "ok" => ["Paramètres mis à jour"]
                    ]
                ])
                ->withInput($request->except("password", "confirm"));
        }
    }
}
