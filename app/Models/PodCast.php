<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PodCast extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'video_url',
        'description',
        'published_at',
        'duration',
        'is_latest'
    ];
}
