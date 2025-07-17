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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->date('date_evenement');
            $table->time('heure_evenement');
            $table->integer('duree_heure');
            $table->string('lieu')->nullable();
            $table->enum('statut', ['en_attente', 'validee', 'confirmee', 'annulee'])->default('en_attente');
            $table->decimal('prix_estime', 10, 2)->nullable();
            $table->decimal('prix_final', 10, 2)->nullable();
            $table->string('calendar_event_id')->nullable();
            $table->enum('etat_commande', ['non_emis', 'devis_envoye', 'commande_validee', 'commande_annulee'])->default('non_emis');
            $table->timestamp('date_reservation')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
