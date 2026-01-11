<?php

namespace App\Http\Controllers;

use App\Models\DemandeFormation;
use App\Models\DemandeFormationsStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Array_;

class DemandeFormationController extends Controller
{
    // GET : Liste toutes les demandes
    public function index()
    {
        return response()->json(DemandeFormation::all(), 200);
    }

    // POST : Créer une nouvelle demande
    public function store(Request $request)
    {
        $validated = $request->validate([
            'intitule' => 'required|string',
            'nombre_participants' => 'required|integer',
            'type_formation' => 'required|in:presentiel,en_ligne',
            // Ajoutez les autres validations ici...
        ]);

        $demande = DemandeFormation::create(['user_create_id' => Auth::id(), ...$request->all()]);
        return response()->json([$demande, Auth::id()], 201);
    }

    // GET {id} : Voir une demande spécifique
    public function show($id)
    {
        $demande = DemandeFormation::find($id);
        if (!$demande) return response()->json(['message' => 'Non trouvé'], 404);
        return response()->json($demande, 200);
    }

    // PUT {id} : Modifier une demande
    public function update(Request $request, $id)
    {
        $demande = DemandeFormation::find($id);
        if (!$demande) return response()->json(['message' => 'Non trouvé'], 404);
        $demande->update($request->all());
        return response()->json($demande, 200);
    }

    // DELETE {id} : Supprimer
    public function destroy($id)
    {
        $demande = DemandeFormation::find($id);
        if (!$demande) return response()->json(['message' => 'Non trouvé'], 404);
        $demande->delete();
        return response()->json(['message' => 'Supprimé avec succès'], 200);
    }
    // DELETE {id} : Supprimer
    public function verification(Request $request)
    {
        $validated = $request->validate([
            'demandeformation_id' => 'required',
            'status' => 'required|string',
        ]);
        $status = DemandeFormationsStatus::firstOrCreate(['demandeformation_id' => $validated['demandeformation_id'], 'user_id' => Auth::id()],  [...$validated, 'user_id' => Auth::id()]);
        if ($status->status != $validated['status']) {
            $status->status = $validated['status'];
            $status->save();
        }
        return response()->json(['status' => 'success', 'data'=> $status], 200);
    }

    public function mesDemandes()
    {
        $demande = DemandeFormation::all()->whereIn('user_create_id', [Auth::id()]);
        if (!$demande) return response()->json(['message' => 'Aucune demandes'], 404);
        return response()->json($demande, 200);
    }

    // public function demandesAValider($id)
    // {
    //     $subId = [];
    //     foreach (Auth::user()->subordonnes() as $subordonne) {
    //         array_push($subId, $subordonne->id);
    //     }
    //     $demandes = DemandeFormation::all()->whereIn('user_create_id', $subId);
    //     return response()->json($demandes, 200);
    // }
}
