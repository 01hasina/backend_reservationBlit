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
        Schema::create('materiels', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 150);
            $table->text('description')->nullable();
            $table->foreignId('categorie_id')->constrained('categories');
            $table->decimal('prix_location', 10, 2);
            $table->integer('stock')->default(0);
            $table->string('image_url', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiels');
    }
};
