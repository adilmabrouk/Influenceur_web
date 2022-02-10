<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adresse extends Model
{
    use HasFactory;

    protected $fillable = [
        'ville',
        'quartier',
        'influenceur_id'
    ];

    protected $hidden = [
        'id',
        'influenceur_id',
        'created_at',
        'updated_at',
    ];

    public function influenceur()
    {
        return $this->belongsTo(Influenceur::class);
    }
}
