<?php

namespace App\Models;

use App\Traits\LikabilityTrait;
use App\Traits\PurchasabilityTrait;
use App\Traits\ViewabilityTrait;
use ChristianKuri\LaravelFavorite\Traits\Favoriteability;
use Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, HasMedia
{
    use Notifiable, HasMediaTrait, Favoriteability, SearchableTrait,
        PurchasabilityTrait, LikabilityTrait, ViewabilityTrait;
    
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
    
    protected $casts = [
        'details' => 'array'
    ];
    
    protected $searchable = [
        'columns' => [
            'name' => 10
        ],
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    /**
     * Set Media conversions
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('avatar')
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
    
    /**
     * Automatically creates hash for the user password.
     *
     * @param  string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
    
    /**
     * Automatically transforms name to lower case
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }
    
    /**
     * Automatically transforms name to title case
     *
     * @param $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return title_case($value);
    }
    
    /**
     * Automatically transforms email to lower case
     *
     * @param $value
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }
    
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    
    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
}
