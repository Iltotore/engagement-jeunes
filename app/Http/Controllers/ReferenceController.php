<?php

namespace App\Http\Controllers;

use App\Models\Reference;
use App\Models\User;
use App\Mail\ReferenceMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\Factory;
use Illuminate\View\View;

class ReferenceController extends Controller {

    public function add(Request $request): RedirectResponse {
        $infos = $request->validate([
            "description" => ["required"],
            "area" => ["required"],
            "hard_skills" => ["required"],
            "soft_skills" => ["required"],
            "begin_date" => ["date", "required"],
            "end_date" => ["date", "required"],
            "email" => ["email", "required"],
            "first_name" => ["required"],
            "last_name" => ["required"],
            "birth_date" => ["date", "required"],
        ]);

        $hardSkills = explode(",", $infos["hard_skills"]);
        $softSkills = explode(",", $infos["soft_skills"]);
        $duration = strtotime($infos["end_date"]) - strtotime($infos["begin_date"]);

        if($duration < 0) return redirect()
          ->intended("/references")
          ->withErrors(["Begin date is later than end date"]);

        $reference = Reference::createUnconfirmed(
            Auth::user(),
            $infos["description"],
            $infos["area"],
            $hardSkills,
            $softSkills,
            $duration,
            $infos["email"],
            $infos["first_name"],
            $infos["last_name"],
            $infos["birth_date"]
        );

        info($infos["email"]);

        Mail::to($infos["email"])->send(new ReferenceMail($reference));

        return redirect()
          ->intended("/references")
          ->with(["notifications" => ["Référence ajoutée. En attente de confirmation."]]);
    }

    public function display(Request $request): RedirectResponse | View | Factory {
        $token = $request->token;

        $reference = Reference::where("token", $token)->first();
        if($reference) {
            return view("reference_display", ["reference" => $reference]);
        } else abort(404);
    }

    public function edit(Request $request): RedirectResponse | View | Factory {
        $token = $request->token;

        $infos = $request->validate([
            "hard_skills" => ["required"],
            "soft_skills" => ["required"]
        ]);

        info($infos["hard_skills"]);
        info($infos["soft_skills"]);

        $reference = Reference::where("token", $token)->first();
        if($reference) {
            $reference->hard_skill_values = $infos["hard_skills"];
            $reference->soft_skill_values = $infos["soft_skills"];
            $reference->save();
            return redirect()
              ->intended("/references/display?token=".$token)
              ->with(["notifications" => ["Référence modifiée"]]);
        } else abort(404);
    }

    public function confirm(Request $request): RedirectResponse | View | Factory {
        $token = $request->token;

        $reference = Reference::where("token", $token)->first();
        if($reference) {
            $reference->confirm();
            return view("reference_confirm");
        } else abort(404);
    }

    public function remove(Request $request): RedirectResponse {
        $user = Auth::user();
        $ids = explode(",", $request->selected ?? "");
        foreach($ids as $id) {
            $reference = Reference::where("id", $id)->where("user_id", $user->id);
            if($reference) {
                $reference->delete();
            } else return redirect()
                ->intended("/references")
                ->withErrors(["Une référence n'a pas été trouvée. La page est-elle à jour ?"]);
        }
        return redirect()->intended("/references")->with(["notifications" => ["Références supprimées"]]);
    }
}
