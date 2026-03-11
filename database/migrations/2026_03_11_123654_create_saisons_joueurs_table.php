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
        Schema::create('saisons_joueurs', function (Blueprint $table) {
            $table->foreignId('id_saison')->constrained('saisons', 'id_saison'); 
            $table->foreignId('id_joueur')->constrained('joueurs', 'id_joueur');       
            $table->integer('score')->default(0);
            $table->primary(['id_saison', 'id_joueur']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saisons_joueurs');
    }
};
