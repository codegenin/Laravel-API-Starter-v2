<?php

namespace App\ACME\Api\V1\Collection\Repositories;

use App\Models\Collection;
use App\Repositories\AbstractBaseRepository;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;

class CollectionRepository extends AbstractBaseRepository
{
    /**
     * RegisterRepository constructor.
     */
    public function __construct()
    {
        $this->setUpModel(Collection::class);
    }
    
    public function increment($collectionId, $value)
    {
        return DB::table('collections')
                 ->whereId(Hashids::decode($collectionId))
                 ->increment('score', $value);
    }
    
    public function decrement($collectionId, $value)
    {
        return DB::table('collections')
                 ->whereId(Hashids::decode($collectionId))
                 ->decrement('score', $value);
    }
}