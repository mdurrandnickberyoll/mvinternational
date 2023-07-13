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
        Schema::create('etapes', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->integer('sequence');
            $table->foreignId('workflow_id');
            $table->foreignId('role_id');
            $table->unsignedBigInteger('statut_debut');
            $table->unsignedBigInteger('statut_fin');
            $table->foreign('statut_debut')->references('id')->on('statuts'); 
            $table->foreign('statut_fin')->references('id')->on('statuts'); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etapes');
    }
};
