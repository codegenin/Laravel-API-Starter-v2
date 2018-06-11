<?php

namespace App\ACME\Api\V1\User\Controllers;

use App\ACME\Api\V1\User\Repositories\UserRepository;
use App\ACME\Api\V1\User\Requests\UpdateProfileRequest;
use App\ACME\Api\V1\User\Resource\UserResource;
use App\Http\Controllers\ApiResponseController;
use App\Traits\MediaTraits;
use Auth;

/**
 * @Resource("Users")
 */
class UserProfileController extends ApiResponseController
{
    use MediaTraits;
    
    /**
     * @var UserRepository
     */
    private $userRepository;
    
    /**
     * Create a new AuthController instance.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('jwt.auth', []);
        $this->userRepository = $userRepository;
    }
    
    /**
     * @apiGroup           User
     * @apiName            userProfile
     * @api                {get} /api/user/profile User Profile
     * @apiDescription     Get User profile
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     *
     */
    public function run()
    {
        UserResource::withoutWrapping();
    
        return new UserResource(Auth::guard()
                                    ->user());
    }
    
}
