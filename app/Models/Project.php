<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'slug',
        'excerpt',
        'image',
        'url',
        'youtube_url',
        'tags',
        'in_development',
        'order',
        'visible',
    ];

    
    protected $casts = [
        'tags'    => 'array',
        'visible' => 'boolean',
    ];
}
