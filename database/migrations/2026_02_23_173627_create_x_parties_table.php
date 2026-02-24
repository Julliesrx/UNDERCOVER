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
        Schema::create('x_parties', function (Blueprint $table) {
        $table->foreignId('id_partie')->constrained('parties', 'id_partie'); 
        $table->foreignId('id_joueur')->constrained('joueurs', 'id_joueur'); // id_joueur ou id_user ??
        $table->string('role');
        $table->string('mot_recu')->nullable();
        $table->integer('score')->default(0);
        $table->boolean('estGagnant')->default(false);
        $table->primary(['id_partie', 'id_joueur']);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('x_parties');
    }
};
