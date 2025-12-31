<?php 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DemandeFormationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormationController;
use App\Models\DemandeFormation;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;
// Routes Publiques
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/register', [AuthController::class, 'register']);

// Routes Protégées (nécessitent d'être connecté)
Route::middleware('auth:sanctum')->group(function () {
    
    // Utilisateur connecté
    Route::get('/me', [AuthController::class, 'me']);

    // Gestion de la hiérarchie (Admin ou RH)
    Route::apiResource('users', UserController::class);
    Route::get('/users/{id}/subordonnes', action: [UserController::class, 'subordonnes']);

    // Workflow des Formations
    Route::get('/mes-demandes', [DemandeFormation::class, 'mesDemandes']);
    Route::get('/a-valider', [DemandeFormation::class, 'demandesAValider']);
    
    Route::patch('/formations/{id}/valider', [DemandeFormation::class, 'valider']);
    Route::patch('/formations/{id}/rejeter', [DemandeFormation::class, 'rejeter']);
    
    // CRUD Standard
    Route::apiResource('demande_formations',  DemandeFormationController::class);
    Route::apiResource('formations', FormationController::class);
});