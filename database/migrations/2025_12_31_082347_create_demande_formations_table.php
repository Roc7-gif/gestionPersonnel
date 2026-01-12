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
        $table->text('objectifs');
        $table->string('profils_beneficiaires');
        $table->date('debut');
        $table->date('fin');
        $table->enum('type_formation', ['presentiel', 'en_ligne']);
        $table->text('img_path')->nullable();
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
