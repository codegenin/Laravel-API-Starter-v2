<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaTranslation extends Model
{
    public    $timestamps = false;
    protected $fillable   = [
        'title',
        'description',
        'location',
        'medium'
    ];
}
