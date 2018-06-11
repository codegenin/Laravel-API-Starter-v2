<?php

namespace App\ACME\Api\V1\User\Controllers;

use App\ACME\Api\V1\User\Repositories\UserRepository;
use App\ACME\Api\V1\User\Requests\UpdateAboutRequest;
use App\ACME\Api\V1\User\Requests\UpdateAvatarRequest;
use App\ACME\Api\V1\User\Resource\UserResource;
use App\Http\Controllers\ApiResponseController;
use App\Models\User;
use App\Traits\MediaTraits;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use App\Http\Controllers\Controller;
use Auth;
use Vinkla\Hashids\Facades\Hashids;

/**
 * @Resource("Users")
 */
class UpdateAvatarController extends ApiResponseController
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
     * @apiName            updateAvatar
     * @api                {post} /api/user/avatar-update Update Avatar
     * @apiDescription     Update or Upload a user avatar image
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {File} file the image file for the user
     *
     */
    public function run(UpdateAvatarRequest $request)
    {
        $user = $this->userRepository->find(auth()->user()->id);
        $this->associateMedia($user, $request, 'avatar');
        
        return $this->responseWithSuccess(trans('common.update.success'));
    }
    
}
