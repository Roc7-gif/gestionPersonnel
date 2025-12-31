<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    public function index() {
        return response()->json(Formation::all(), 200);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'intitule' => 'required|string|max:255',
            'nombre_participants' => 'required|integer',
            'type_formation' => 'required|in:presentiel,en_ligne',
            // Ajoutez les autres validations ici
        ]);

        $formation = Formation::create($request->all());
        return response()->json($formation, 201);
    }

    public function show($id) {
        $formation = Formation::find($id);
        if (!$formation) return response()->json(['message' => 'Formation non trouvée'], 404);
        return response()->json($formation, 200);
    }

    public function update(Request $request, $id) {
        $formation = Formation::find($id);
        if (!$formation) return response()->json(['message' => 'Formation non trouvée'], 404);
        
        $formation->update($request->all());
        return response()->json($formation, 200);
    }

    public function destroy($id) {
        $formation = Formation::find($id);
        if (!$formation) return response()->json(['message' => 'Formation non trouvée'], 404);
        
        $formation->delete();
        return response()->json(['message' => 'Supprimé avec succès'], 200);
    }
}