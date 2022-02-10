<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instagram extends Model
{


    protected $fillable = [
        'username',
        'full_name', '
        followers', '
        following',
        'category_name',
        'profile_pic_url'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $timestamps = false;


    public function influenceur()
    {
        return $this->belongsTo(Influenceur::class);
    }

    public function posts()
    {
        return $this->hasMany(Instagram_Post::class);
    }
}
