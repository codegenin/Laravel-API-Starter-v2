<?php

namespace App\Models;

use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Hashids\Hashids;
use HighSolutions\EloquentSequence\Sequence;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Nestable\NestableTrait;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Category extends Model implements HasMedia
{
    use NestableTrait, Sortable, Sequence, HasMediaTrait, Favoriteable,
        SearchableTrait;
    
    public $sortable = [
        'id',
        'name',
        'seq'
    ];
    
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
    
    public function sequence()
    {
        return [
            'fieldName' => 'seq'
        ];
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
        $this->addMediaCollection('category')
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
}
