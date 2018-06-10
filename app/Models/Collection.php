<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Collection extends Model implements HasMedia
{
    use HasMediaTrait, Sortable;
    
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
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function images()
    {
        return $this->hasMany(Media::class, 'model_id', 'id');
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
