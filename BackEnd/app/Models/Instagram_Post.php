<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instagram_Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'like',
        'comment_count',
        'views',
        'link_to_post',
        'caption',
        'thumbnail_src',
        'timestamp'
    ];

    public $timestamps = false;


    public function instagram()
    {
        return $this->belongsTo(Instagram::class);
    }
}
