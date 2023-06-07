<?php

namespace App\Http\Controllers;

use App\Mail\ConsultMail;
use App\Models\Consult;
use App\Models\Reference;
use App\Models\User;
use App\Mail\ReferenceMail;
use App\Services\TimeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\Factory;
use Illuminate\View\View;

class ReferenceController extends Controller {

    public function add(Request $request): RedirectResponse {
        $infos = $request->validate([
            "description" => ["required", "max:100"],
            "area" => ["required", "max:50"],
            "hard_skills" => ["required"],
            "soft_skills" => ["required"],
            "begin_date" => ["date", "required"],
            "end_date" => ["date", "required"],
            "email" => ["email", "required"],
            "first_name" => ["required", "max:50"],
            "last_name" => ["required", "max:50"],
            "birth_date" => ["date", "required"],
        ]);

        $hardSkills = explode(",", $infos["hard_skills"]);
        $softSkills = explode(",", $infos["soft_skills"]);
        $duration = strtotime($infos["end_date"]) - strtotime($infos["begin_date"]);

        if ($duration < 0) return redirect()
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
            ->with([
                "notifications" => [
                    "ok" => ["Référence ajoutée. En attente de confirmation."]
                ]
            ]);
    }

    public function display(Request $request): RedirectResponse|View|Factory {
        $token = $request->token;

        $reference = Reference::where("token", $token)->first();
        if ($reference) {
            return view("reference_display", ["reference" => $reference]);
        } else abort(404);
    }

    public function showConsult(Request $request): RedirectResponse|View|Factory {
        $token = $request->token;

        $consult = Consult::where("token", $token)->first();
        if ($consult) {
            return view("consult", ["consult" => $consult]);
        } else abort(404);
    }

    public function edit(Request $request): RedirectResponse|View|Factory {
        $token = $request->token;

        $infos = $request->validate([
            "hard_skills" => ["required", "max:100"],
            "soft_skills" => ["required", "max:100"]
        ]);

        info($infos["hard_skills"]);
        info($infos["soft_skills"]);

        $reference = Reference::where("token", $token)->first();
        if ($reference) {
            $reference->hard_skill_values = $infos["hard_skills"];
            $reference->soft_skill_values = $infos["soft_skills"];
            $reference->save();
            return redirect()
                ->intended("/references/display?token=" . $token)
                ->with([
                    "notifications" => [
                        "ok" => ["Référence modifiée"]
                    ]
                ]);

        } else abort(404);
    }

    public function confirm(Request $request): RedirectResponse|View|Factory {
        $token = $request->token;

        $reference = Reference::where("token", $token)->first();
        if ($reference) {
            $reference->confirm();
            return view("reference_confirm");
        } else abort(404);
    }

    public function remove(Request $request): RedirectResponse {
        $user = Auth::user();
        $ids = explode(",", $request->selected ?? "");
        foreach ($ids as $id) {
            $reference = Reference::where("id", $id)->where("user_id", $user->id)->first();
            if ($reference) {
                $reference->delete();
            } else return redirect()
                ->intended("/references")
                ->withErrors(["Une référence n'a pas été trouvée. La page est-elle à jour ?"]);
        }

        return redirect()
            ->intended("/references")
            ->with([
                "notifications" => [
                    "ok" => ["Références supprimées"]
                ]
            ]);
    }

    public function sendConsult(Request $request): RedirectResponse {
        $user = Auth::user();

        $time = App::make(TimeService::class);

        $infos = $request->validate([
            "selected" => [],
            "duration" => ["required"],
            "email" => ["required", "email"]
        ]);

        $ids = explode(",", $infos["selected"] ?? "");

        $references = [];

        foreach ($ids as $id) {
            $reference = Reference::where("id", $id)->where("user_id", $user->id);
            if ($reference) $references[] = $reference->first();
            else return redirect()
                ->intended("/references")
                ->withErrors(["Une référence n'a pas été trouvée. La page est-elle à jour ?"]);
        }

        $consult = Consult::create([
            "user_id" => $user->id,
            "email" => $infos["email"],
            "token" => uniqid(),
            "expire_at" => $time->currentTime($infos["duration"]*24*3600)
        ]);

        foreach($references as $reference) $consult->references()->attach($reference->id);

        Mail::to($infos["email"])->send(new ConsultMail($consult));

        return redirect()
            ->intended("/references")
            ->with([
                "notifications" => [
                    "ok" => ["Références envoyées à " . $infos["email"]]
                ]
            ]);
    }

    public function removeConsult(Request $request): RedirectResponse {
        $user = Auth::user();
        $ids = explode(",", $request->selected ?? "");
        info($ids);
        foreach ($ids as $id) {
            $consult = Consult::where("id", $id)->where("user_id", $user->id)->first();
            if ($consult) {
                $consult->delete();
            } else return redirect()
                ->intended("/references")
                ->withErrors(["Une consultation n'a pas été trouvée. La page est-elle à jour ?"]);
        }

        return redirect()
            ->intended("/references")
            ->with([
                "notifications" => [
                    "ok" => ["Consultations supprimées"]
                ]
            ]);
    }
}
