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
        Schema::create('catechumene', function (Blueprint $table) {
            $table->id();
            $table->string("matricule");
            $table->string("photo")->nullable();
            $table->string("nom");
            $table->string("prenom");
            $table->string("age_de_naissance");
            $table->string("contact");
            $table->string("niveau_catechese");
            $table->string("classe_or_profession");
            $table->string("jour_cours");
            $table->string("annee_catechese");
            $table->string("profil");
            $table->string("date_naissance");
            $table->date('date_inscription');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catechumene');
    }
};
