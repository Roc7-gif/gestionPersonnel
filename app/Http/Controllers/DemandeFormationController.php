<?php

namespace App\Http\Controllers;
use App\Models\DemandeFormation;
use Illuminate\Http\Request;

class DemandeFormationController extends Controller
{
    // GET : Liste toutes les demandes
    public function index() {
        return response()->json(DemandeFormation::all(), 200);
    }

    // POST : Créer une nouvelle demande
    public function store(Request $request) {
        $validated = $request->validate([
            'intitule' => 'required|string',
            'nombre_participants' => 'required|integer',
            'type_formation' => 'required|in:presentiel,en_ligne',
            // Ajoutez les autres validations ici...
        ]);

        $demande = DemandeFormation::create($request->all());
        return response()->json($demande, 201);
    }

    // GET {id} : Voir une demande spécifique
    public function show($id) {
        $demande = DemandeFormation::find($id);
        if (!$demande) return response()->json(['message' => 'Non trouvé'], 404);
        return response()->json($demande, 200);
    }

    // PUT {id} : Modifier une demande
    public function update(Request $request, $id) {
        $demande = DemandeFormation::find($id);
        if (!$demande) return response()->json(['message' => 'Non trouvé'], 404);
        $demande->update($request->all());
        return response()->json($demande, 200);
    }

    // DELETE {id} : Supprimer
    public function destroy($id) {
        $demande = DemandeFormation::find($id);
        if (!$demande) return response()->json(['message' => 'Non trouvé'], 404);
        $demande->delete();
        return response()->json(['message' => 'Supprimé avec succès'], 200);
    }
     // DELETE {id} : Supprimer
    public function verifie($id) {
       
    }
     // DELETE {id} : Supprimer
    public function rejeter($id) {
       
    }

    public function mesDemandes($id) {
       
    }
    public function demandesAValider($id) {
       
    }
}