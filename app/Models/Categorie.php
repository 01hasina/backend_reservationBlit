<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['nom'];

    public function materiels()
    {
        return $this->hasMany(Materiel::class, 'catégorie_id');
    }
}
