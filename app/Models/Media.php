<?php

namespace App\Models;

use App\Traits\LikableTrait;
use App\Traits\ReportableTrait;
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
        Translatable, LikableTrait, ViewableTrait, Rememberable, ReportableTrait;
    
    public $translatedAttributes = [
        'title_short',
        'title',
        'description',
        'location',
        'time_period',
        'medium'
    ];
    
    protected $table = 'media';
    
    protected $with = [
        'collection',
        'translations'
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
    
    public function scopeVisible($query)
    {
        return $query->where('visible', 1);
    }
    
    public function getActionButtonsAttribute()
    {
        return "<button type=\"button\" data-toggle=\"modal\" title=\"SHOW or HIDE\"
                                    class=\"btn btn-box-tool public\" data-id=\"{$this->id}\" data-target=\"#publicModal\">
                                <i class=\"fa fa-eye\"></i>
                            </button>

                            <button type=\"button\" data-toggle=\"modal\" title=\"EDIT\"
                                    class=\"btn btn-box-tool edit\" data-id=\"{$this->id}\" data-target=\"#editModal\">
                                <i class=\"fa fa-pencil\"></i>
                            </button>

                            <button type=\"button\" data-toggle=\"modal\" title=\"DELETE\"
                                    class=\"btn btn-box-tool delete\" data-id=\"{$this->id}\" data-target=\"#deleteModal\">
                                <i class=\"fa fa-remove\"></i>
                            </button>";
    }
}
