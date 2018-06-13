<?php

namespace App\ACME\Api\V1\Media\Repositories;

use App\Models\Collection;
use App\Models\Media;
use App\Repositories\AbstractBaseRepository;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;

class MediaRepository extends AbstractBaseRepository
{
    /**
     * RegisterRepository constructor.
     */
    public function __construct()
    {
        $this->setUpModel(Media::class);
    }
    
    public function increment($mediaId, $value)
    {
        return DB::table('media')
                 ->whereId(Hashids::decode($mediaId))
                 ->increment('score', $value);
    }
    
    public function decrement($mediaId, $value)
    {
        return DB::table('media')
                 ->whereId(Hashids::decode($mediaId))
                 ->decrement('score', $value);
    }
}