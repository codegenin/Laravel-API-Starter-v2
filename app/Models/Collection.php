<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Collection extends Model implements HasMedia
{
    use HasMediaTrait;
    
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
    
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
             ->width(368)
             ->height(232)
             ->sharpen(10);
    }
    
    public function registerMediaCollections()
    {
        $this->addMediaCollection('category')
             ->singleFile();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
