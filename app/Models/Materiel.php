<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    use HasFactory;

    protected $table = 'materiels';

    protected $fillable = [
        'nom',
        'description',
        'catégorie_id',
        'prix_location',
        'stock',
        'image_url',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'catégorie_id');
    }

    public function packMateriels()
    {
        return $this->hasMany(PackMateriel::class);
    }

    public function reservationMateriels()
    {
        return $this->hasMany(ReservationMateriel::class);
    }
}
