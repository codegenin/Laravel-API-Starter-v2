<?php

namespace App\ACME\Api\V1\User\Repositories;

use App\Repositories\AbstractBaseRepository;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository extends AbstractBaseRepository
{
    /**
     * RegisterRepository constructor.
     */
    public function __construct()
    {
        $this->setUpModel(User::class);
    }
    
    public function increment($value)
    {
        return DB::table('users')
                 ->whereId(auth()->user()->id)
                 ->increment('points', $value);
    }
    
}