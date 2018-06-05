<?php
namespace App\ACME\Api\V1\Category\Repositories;

use App\Models\Category;
use App\Repositories\AbstractBaseRepository;

class CategoryRepository extends AbstractBaseRepository
{
    /**
     * RegisterRepository constructor.
     */
    public function __construct()
    {
        $this->setUpModel(Category::class);
    }
}