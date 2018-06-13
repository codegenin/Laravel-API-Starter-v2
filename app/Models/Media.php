<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media as BaseMedia;

class Media extends BaseMedia implements HasMedia
{
    use HasMediaTrait, Sortable;
    
    public $sortable = [
        'id',
        'order_column',
        'created_at'
    ];
    
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
    
}
