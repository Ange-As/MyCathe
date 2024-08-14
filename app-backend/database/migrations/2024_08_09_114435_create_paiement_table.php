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
        Schema::create('paiement', function (Blueprint $table) {
            $table->id();
            $table->foreignId('catechumene_id')->references('id')->on('catechumene')->onDelete('CASCADE');
            $table->foreignId("mode_paiement_id")->references("id")->on("mode_paiement")->onDelete('CASCADE');
            $table->string("reference_id");
            $table->boolean("is_paiement_valid")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiement');
    }
};
