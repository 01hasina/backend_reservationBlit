<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationPack extends Model
{
    use HasFactory;

    protected $table = 'reservation_packs';

    protected $fillable = [
        'reservation_id',
        'pack_id',
        'quantite',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function pack()
    {
        return $this->belongsTo(Pack::class);
    }
}
