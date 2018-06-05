<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Nestable\NestableTrait;

class Category extends Model
{
    use NestableTrait, Sortable;
    
    public $sortable = [
        'id',
        'name',
        'order'
    ];
    
    protected $parent = 'parent_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'slug',
        'name',
        'description',
        'image_path',
        'is_public',
        'order'
    ];
    
}
