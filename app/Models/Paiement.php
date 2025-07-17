<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $table = 'paiements';

    protected $fillable = [
        'reservation_id',
        'montant',
        'moyen_paiement',
        'date_paiement',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
