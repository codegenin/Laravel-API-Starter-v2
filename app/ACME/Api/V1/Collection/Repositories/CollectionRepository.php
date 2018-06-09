<?php
namespace App\ACME\Api\V1\Collection\Repositories;

use App\Models\Collection;
use App\Repositories\AbstractBaseRepository;

class CollectionRepository extends AbstractBaseRepository
{
    /**
     * RegisterRepository constructor.
     */
    public function __construct()
    {
        $this->setUpModel(Collection::class);
    }
}