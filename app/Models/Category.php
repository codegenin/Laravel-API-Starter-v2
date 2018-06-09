<?php

namespace App\Models;

use HighSolutions\EloquentSequence\Sequence;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Nestable\NestableTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Category extends Model implements HasMedia
{
    use NestableTrait, Sortable, Sequence, HasMediaTrait;
    
    public $sortable = [
        'id',
        'name',
        'seq'
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
    
    public function registerMediaCollections()
    {
        $this->addMediaCollection('category')
             ->singleFile()
             ->registerMediaConversions(function (Media $media) {
                 $this->addMediaConversion('large')
                      ->width(500)
                      ->height(500);
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
}
