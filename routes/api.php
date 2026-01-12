<?php 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DemandeFormationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\FormationSuiviController;
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
    // Route::get('/users/{id}/subordonnes', action: [UserController::class, 'subordonnes']);

    // Workflow des Formations
    Route::get('/mes-demandes', [DemandeFormationController::class, 'mesDemandes']);
    Route::get('/a-valider', [DemandeFormationController::class, 'demandesAValider']);
    
    Route::post('/demande_formations/validation', [DemandeFormationController::class, 'verification']);
    
    // CRUD Standard
    Route::apiResource('demande_formations',  DemandeFormationController::class);

    Route::apiResource('formations', FormationController::class);

// Inscription
Route::post('/formations/inscription', [FormationSuiviController::class, 'store']);

Route::delete('/formations/{formationId}/participants', [FormationSuiviController::class, 'destroy']);
});