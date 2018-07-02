<?php

namespace App\Models;

use App\Traits\PurchasableTrait;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Collection extends Model implements HasMedia
{
    use HasMediaTrait,Favoriteable, SearchableTrait,
        Translatable, PurchasableTrait;
    
    public $translatedAttributes = [
        'title',
        'description'
    ];
    
    protected $with = ['translations'];
    
    protected $searchable = [
        'columns' => [
            'title'       => 10
        ],
    ];
    
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
    
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }
    
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('large')
             ->width(500)
             ->height(500);
        $this->addMediaConversion('medium')
             ->width(300)
             ->height(300);
        $this->addMediaConversion('small')
             ->width(100)
             ->height(100);
    }
    
    public function registerMediaCollections()
    {
        $this->addMediaCollection('collection')
             ->singleFile()
             ->registerMediaConversions(function (Media $media) {
                 $this->addMediaConversion('large')
                      ->width(500)
                      ->height(500);
                 $this->addMediaConversion('medium')
                      ->width(300)
                      ->height(300);
                 $this->addMediaConversion('small')
                      ->width(100)
                      ->height(100);
             });
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
