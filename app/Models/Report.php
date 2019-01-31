<?php

namespace App\Models;

use App\Traits\ReportabilityTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Report extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reports';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'booked'
    ];
    
    /**
     * Define a polymorphic, inverse one-to-one or many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function reportable()
    {
        return $this->morphTo();
    }
    
    public function user()
    {
        return $this->belongsTo(Config::get('auth.providers.users.model'));
    }
    
    public function allReported($class)
    {
        return $this->where('reportable_type', $class)
                    ->with(['reportable'])
                    ->paginate();
    }
}
