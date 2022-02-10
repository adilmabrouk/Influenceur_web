<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Influenceur extends User
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'date_naissance',
        'genre',
        'situation_familiale',
        'niveau_etude',
        'profession',
        'telephone',
        'facebook',
        'youtube',
        'tiktok',
        'instagram',
    ];

    protected $hidden = [
        'password',
        'email_verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
        "remember_token"
    ];

    public $timestamps = false;


    public function adresse()
    {
        return $this->hasOne(Adresse::class);
    }

    public function langues()
    {
        return $this->belongsToMany(Langue::class);
    }

    public function instagram()
    {
        return $this->hasOne(Instagram::class);
    }
}
