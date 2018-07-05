<?php

namespace App\Models;

use App\Traits\LikableTrait;
use Dimsav\Translatable\Translatable;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media as BaseMedia;
use Spatie\Tags\HasTags;

class Media extends BaseMedia implements HasMedia
{
    use HasMediaTrait, HasTags, SearchableTrait,
        Translatable, LikableTrait;
    
    public $translatedAttributes = [
        'title',
        'description'
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
