<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    use HasFactory;

    protected $table = 'packs';

    protected $fillable = [
        'nom',
        'description',
        'prix_total',
    ];

    public function packMateriels()
    {
        return $this->hasMany(PackMateriel::class);
    }

    public function reservationPacks()
    {
        return $this->hasMany(ReservationPack::class);
    }
}
