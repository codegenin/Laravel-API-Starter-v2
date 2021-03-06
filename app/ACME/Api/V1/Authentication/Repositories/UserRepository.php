<?php
namespace App\ACME\Api\V1\Authentication\Repositories;

use App\Repositories\AbstractBaseRepository;
use App\Models\User;

class UserRepository extends AbstractBaseRepository
{
    /**
     * RegisterRepository constructor.
     */
    public function __construct()
    {
        $this->setUpModel(User::class);
    }
}