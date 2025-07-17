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
        Schema::create('pack_materiels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pack_id')->constrained('packs')->onDelete('cascade');
            $table->foreignId('materiel_id')->constrained('materiels')->onDelete('cascade');
            $table->integer('quantite')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pack_materiels');
    }
};
