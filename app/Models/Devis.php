<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    use HasFactory;

    protected $table = 'devis';

    protected $fillable = [
        'reservation_id',
        'total_ht',
        'tva',
        'total_ttc',
        'date_emission',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
