<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media as BaseMedia;
use Spatie\Tags\HasTags;

class Media extends BaseMedia implements HasMedia
{
    use HasMediaTrait, Sortable, HasTags, SearchableTrait,
        Translatable;
    
    public $translatedAttributes = [
        'title',
        'description'
    ];
    public $sortable = [
        'id',
        'order_column',
        'score',
        'created_at'
    ];
    protected $table = 'media';
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
        return $this->hasMany(MediaTranslation::class);
    }
}
