<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationMateriel extends Model
{
    use HasFactory;

    protected $table = 'reservation_materiels';

    protected $fillable = [
        'reservation_id',
        'materiel_id',
        'quantite',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function materiel()
    {
        return $this->belongsTo(Materiel::class);
    }
}
