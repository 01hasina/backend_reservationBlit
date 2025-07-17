<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;  // Ajout du trait Sanctum

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;  // Ajout de HasApiTokens ici

    protected $table = 'users';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
        'telephone',
        'role_id',
        'date_inscription',
    ];

    protected $hidden = [
        'mot_de_passe',
    ];

    // Hash automatique du mot de passe à l'attribution
    public function setMotDePasseAttribute($value)
    {
        $this->attributes['mot_de_passe'] = bcrypt($value);
    }

    // Relation vers Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Relation vers Reservation
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
