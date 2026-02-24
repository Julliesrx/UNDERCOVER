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
        Schema::create('parties', function (Blueprint $table) {
        $table->id('id_partie');
        $table->dateTime('date');
        $table->integer('nbJoueurs');
        $table->integer('nbUndercovers');
        $table->integer('nbMrWhite');
        $table->string('mot_civil')->nullable();
        $table->string('mot_undercover')->nullable();
        $table->foreignId('id_mots')->constrained('mots', 'id_mots');
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
        Schema::dropIfExists('parties');
    }
};
