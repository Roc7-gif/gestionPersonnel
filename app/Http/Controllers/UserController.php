<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Liste tous les utilisateurs avec leur chef
    public function index() {
        return response()->json(User::with('chef')->get());
    }

    // Créer un utilisateur et lui assigner un chef (parent_id)
    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'parent_id' => 'nullable|exists:users,id' // ID du chef
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $user = User::create($validated);

        return response()->json($user, 201);
    }

    // Voir les subordonnés d'un utilisateur spécifique
    public function subordonnes($id) {
        $user = User::findOrFail($id);
        return response()->json($user->subordonnes);
    }
}