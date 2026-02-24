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
        Schema::create('joueurs', function (Blueprint $table) {
        $table->id('id_joueur');
        $table->string('nom');
        $table->string('avatar')->nullable();
        $table->integer('scoreTotal')->default(0);
        $table->unsignedBigInteger('id_user');
        $table->foreign('id_user')->references('id_user')->on('users');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joueurs');
    }
};
