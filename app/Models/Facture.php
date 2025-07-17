<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $table = 'factures';

    protected $fillable = [
        'reservation_id',
        'montant_total',
        'date_facturation',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
