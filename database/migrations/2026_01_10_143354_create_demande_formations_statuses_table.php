<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('demande_formations_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('demandeformation_id');
            $table->enum('status' , ['validé' , 'en attente' , 'refuser']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_formations_statuses');
    }
};
