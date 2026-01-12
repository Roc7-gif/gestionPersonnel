<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->string('intitule');
            $table->string('author');
            $table->text('objectifs');
            $table->string('img_path')->nullable(true);
            $table->string('profils_beneficiaires');
            $table->string('profil_formateur');
            $table->enum('type_formation', ['presentiel', 'en_ligne']);
            $table->date('debut');
            $table->date('fin');
            $table->foreignId('demande_formation_id')->constrained();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('formations');
    }
};