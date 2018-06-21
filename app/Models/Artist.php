<?php

namespace App\Models;

use ChristianKuri\LaravelFavorite\Traits\Favoriteability;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Vinkla\Hashids\Facades\Hashids;

class Artist extends Model implements HasMedia
{
    use HasMediaTrait, SearchableTrait, Favoriteable;
    
    protected $table = 'users';
    
    protected $searchable = [
        'columns' => [
            'name' => 10
        ],
    ];
    
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
}
