<?php

namespace App\ACME\Api\V1\User\Controllers;

use App\ACME\Api\V1\User\Repositories\UserRepository;
use App\ACME\Api\V1\User\Requests\UpdateAboutRequest;
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
class UpdateAboutController extends ApiResponseController
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
     * @apiName            updateAbout
     * @api                {post} /api/user/about-update Update About
     * @apiDescription     Update a user about information
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {String} about a introduction of the user
     *
     */
    public function run(UpdateAboutRequest $request)
    {
        $this->userRepository->update(auth()->user()->id, [
            'about' => $request->about,
        ]);
        
        return $this->responseWithSuccess(trans('common.update.success'));
    }
    
}
