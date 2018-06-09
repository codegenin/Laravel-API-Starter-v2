<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    public function collection()
    {
        return $this->belongsTo(Collection::class, 'id', 'model_id');
    }
}
