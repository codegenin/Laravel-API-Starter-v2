<?php

namespace App\Models;

use App\Traits\LikableTrait;
use App\Traits\ViewableTrait;
use Dimsav\Translatable\Translatable;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media as BaseMedia;
use Spatie\Tags\HasTags;
use Watson\Rememberable\Rememberable;

class Media extends BaseMedia implements HasMedia
{
    use HasMediaTrait, HasTags, SearchableTrait,
        Translatable, LikableTrait, ViewableTrait, Rememberable;
    
    public $translatedAttributes = [
        'title',
        'description',
        'location',
        'medium'
    ];
    
    protected $table = 'media';
    
    protected $with = [
        'collection'
    ];
    
    protected $searchable = [
        'columns' => [
            'title'       => 10,
            'description' => 5,
            'location'    => 1
        ],
    ];
    
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function translations()
    {
        return $this->hasMany(MediaTranslation::class, 'media_id', 'id');
    }
    
    public function collection()
    {
        return $this->hasOne(Collection::class, 'id', 'model_id');
    }
}
