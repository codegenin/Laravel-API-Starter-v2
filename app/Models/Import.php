<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Class Import
 * @package App\Models
 * @property \Carbon\Carbon $created_at
 * @property int            $id
 * @property \Carbon\Carbon $updated_at
 */
class Import extends Model implements HasMedia
{
    use HasMediaTrait;
    
    public function records()
    {
        return $this->hasMany(ImportRecord::class);
    }
}
