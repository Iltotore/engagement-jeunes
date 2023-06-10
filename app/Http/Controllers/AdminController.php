<?php


namespace App\Http\Controllers;

use App\Models\Reference;
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

class AdminController extends Controller
{

    public function removeUsers(Request $request): RedirectResponse {
        $ids = explode(",", $request->selected ?? "");
        foreach($ids as $id){
            $user = User::where("id", $id)->first();
            if($user){
                $user->delete();
            } else return redirect()
                ->intended("/admin")
                ->withErrors(["Un utilisateur n'a pas été trouvé. La page est-elle à jour ?"]);
        }
        return redirect()
            ->intended("/admin")
            ->with([
                "notifications" => [
                    "ok" => ["Utilisateurs supprimées"]
                ]
            ]);
    }
    public function removeReferences(Request $request): RedirectResponse {
        $ids = explode(",", $request->selected ?? "");
        foreach ($ids as $id) {
            $reference = Reference::find($id);
            if ($reference) {
                $reference->delete();
            } else return redirect()
                ->intended($request->has("current") ? "/admin?selected=".$request->current : "/admin")
                ->withErrors(["Une référence n'a pas été trouvée. La page est-elle à jour ?"]);
        }

        return redirect()
            ->intended($request->has("current") ? "/admin?selected=".$request->current : "/admin")
            ->with([
                "notifications" => [
                    "ok" => ["Références supprimées"]
                ]
            ]);
    }

    public function getPanel(Request $request): RedirectResponse|View {
        if($request->has("selected")) {
            $user = User::find($request->selected);
            if($user != null) return view("admin", ["current" => $user]);
        }

        return view("admin");
    }
}
