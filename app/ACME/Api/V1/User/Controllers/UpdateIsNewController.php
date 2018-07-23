<?php

namespace App\ACME\Api\V1\User\Controllers;

use App\ACME\Api\V1\User\Repositories\UserRepository;
use App\ACME\Api\V1\User\Requests\UpdateAboutRequest;
use App\ACME\Api\V1\User\Requests\UpdateAvatarRequest;
use App\ACME\Api\V1\User\Requests\UpdateIsNewRequest;
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
class UpdateIsNewController extends ApiResponseController
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
     * @apiName            updateIsNew
     * @api                {post} /api/user/update-is-new Update Is New
     * @apiDescription     Set the is_new column to 0
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {String} is_new set 0 if false and 1 if true
     *
     * @param UpdateIsNewRequest $request
     * @return mixed
     */
    public function run(UpdateIsNewRequest $request)
    {
        $user         = $this->userRepository->find(auth()->user()->id);
        $user->is_new = $request->is_new;
        $user->save();
        
        return $this->responseWithSuccess(trans('common.update.success'));
    }
    
}
