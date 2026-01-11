<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->string('intitule');
            $table->foreignId('author_id');
            $table->integer('nombre_participants');
            $table->text('objectifs');
            $table->string('img_path')->nullable(true);
            $table->boolean('is_interieur')->default(true);
            $table->text('justification_choix');
            $table->string('profils_beneficiaires');
            $table->string('module_nom');
            $table->string('duree');
            $table->string('profil_formateur');
            $table->enum('type_formation', ['presentiel', 'en_ligne']);
            $table->date('debut');
            $table->text('observation')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('formations');
    }
};