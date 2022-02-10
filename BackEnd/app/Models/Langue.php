<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Langue extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot',
    ];



    public function influenceur()
    {
        return $this->belongsToMany(Influenceur::class);
    }
}
