<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    protected $fillable = [
        'user_id',
        'date_evenement',
        'heure_evenement',
        'duree_heure',
        'lieu',
        'statut',
        'prix_estime',
        'prix_final',
        'calendar_event_id',
        'etat_commande',
        'date_reservation',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservationMateriels()
    {
        return $this->hasMany(ReservationMateriel::class);
    }

    public function reservationPacks()
    {
        return $this->hasMany(ReservationPack::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    public function devis()
    {
        return $this->hasOne(Devis::class);
    }

    public function facture()
    {
        return $this->hasOne(Facture::class);
    }
}
