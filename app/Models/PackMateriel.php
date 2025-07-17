<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackMateriel extends Model
{
    use HasFactory;

    protected $table = 'pack_materiels';

    protected $fillable = [
        'pack_id',
        'materiel_id',
        'quantite',
    ];

    public function pack()
    {
        return $this->belongsTo(Pack::class);
    }

    public function materiel()
    {
        return $this->belongsTo(Materiel::class);
    }
}
