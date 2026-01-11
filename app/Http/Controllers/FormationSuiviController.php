<?php
namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class   FormationSuiviController extends Controller
{
    // 1. Lister les participants d'une formation
    public function index($formationId)
    {
        $formation = Formation::with('participants')->findOrFail($formationId);
        return response()->json($formation->participants);
    }

    // 2. Inscrire un utilisateur (CREATE)
    public function store(Request $request)
    {
        $request->validate([
            'formation_id' => 'required|exists:formations,id',
        ]);

        $user = User::findOrFail(Auth::id());
        
        // attach() ajoute l'entrée. syncWithoutDetaching() évite les doublons.
        $user->formationsSuivies()->syncWithoutDetaching([$request->formation_id]);

        return response()->json(['message' => 'Inscription réussie']);
    }

    // 3. Désinscrire un utilisateur (DELETE)
    public function destroy($formationId)
    {
        $user = User::findOrFail(Auth::id());
        $user->formationsSuivies()->detach($formationId);

        return response()->json(['message' => 'Désinscription réussie']);
    }
    // Récupérer les formations d'un utilisateur spécifique
public function getFormationsByUser()
{
    // On récupère l'utilisateur avec ses formations associées
    $user = User::with('formationsSuivies')->find(Auth::id());

    if (!$user) {
        return response()->json(['message' => 'Utilisateur non trouvé'], 404);
    }

    return response()->json([
        'user' => $user->name,
        'formations' => $user->formationsSuivies
    ]);
}
}