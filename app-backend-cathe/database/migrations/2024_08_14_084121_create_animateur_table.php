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
        Schema::create('animateur', function (Blueprint $table) {
            $table->id();
            $table->string("photo_animateur")->nullable();
            $table->string("nom");
            $table->string("prenom");
            $table->string("contact");
            $table->string('categorie_catechumene');
            $table->string('jour_cours');
            $table->string('annee_catechese');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animateur');
    }
};
