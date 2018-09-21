<?php

namespace App\Models;

use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Nestable\NestableTrait;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Category extends Model implements HasMedia, Sortable
{
    use NestableTrait, HasMediaTrait, Favoriteable,
        SearchableTrait, Translatable, SortableTrait;
    
    public $sortable = [
        'order_column_name'  => 'seq',
        'sort_when_creating' => true,
    ];
    
    public $translatedAttributes = [
        'name',
        'description'
    ];
    
    protected $with = ['translations'];
    
    protected $searchable = [
        'columns' => [
            'name' => 10,
        ],
    ];
    
    protected $parent = 'parent_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
        $this->addMediaConversion('zoom')
             ->width(2000)
             ->height(2000);
        $this->addMediaConversion('cover')
             ->width(1200)
             ->height(1200);
        $this->addMediaConversion('large')
             ->width(500)
             ->height(500);
        $this->addMediaConversion('medium')
             ->width(300)
             ->height(300);
        /*$this->addMediaConversion('small')
             ->width(100)
             ->height(100);*/
    }
    
    public function registerMediaCollections()
    {
        $this->addMediaCollection('category')
             ->singleFile()
             ->registerMediaConversions(function (Media $media) {
                 $this->addMediaConversion('zoom')
                      ->width(2000)
                      ->height(2000);
                 $this->addMediaConversion('cover')
                      ->width(1200)
                      ->height(1200);
                 $this->addMediaConversion('large')
                      ->width(500)
                      ->height(500);
                 $this->addMediaConversion('medium')
                      ->width(200)
                      ->height(200);
                 /*$this->addMediaConversion('small')
                      ->width(100)
                      ->height(100);*/
             });
    }
    
    public function cover()
    {
        return $this->hasOne(Media::class, 'id', 'media_id');
    }
    
    public function getCoverUrlAttribute()
    {
        return $this->cover->getUrl();
    }
    
    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
    
    public function images()
    {
        return $this->hasMany(Media::class);
    }
}
