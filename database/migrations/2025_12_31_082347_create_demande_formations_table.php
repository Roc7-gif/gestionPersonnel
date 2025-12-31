<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::create('demande_formations', function (Blueprint $table) {
        $table->id();
        $table->string('intitule');
        $table->integer('nombre_participants');
        $table->text('objectifs');
        $table->boolean('is_interieur')->default(true); // true = Intérieur, false = Extérieur
        $table->text('justification_choix');
        $table->string('profils_beneficiaires');
        
        // Détails du module
        $table->string('module_nom');
        $table->string('duree');
        $table->string('profil_formateur');
        $table->enum('type_formation', ['presentiel', 'en_ligne']);
        $table->text('observation')->nullable();
        $table->foreignId('user_create_id')->nullable();
        $table->foreignId('user_actuel_id')->nullable();
        $table->timestamps(); 

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_formations');
    }
};
