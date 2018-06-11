<?php

namespace App\ACME\Api\V1\User\Controllers;

use App\ACME\Api\V1\User\Repositories\UserRepository;
use App\ACME\Api\V1\User\Requests\UpdateProfileRequest;
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
class UpdateProfileController extends ApiResponseController
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
     * @apiName            updateProfile
     * @api                {post} /api/user/profile-update Update Profile
     * @apiDescription     Update a user profile
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {File} file the image to be uploaded for the avatar
     * @apiParam {String} name the complete name of the user
     * @apiParam {String} about introduction about the user
     * @apiParam {String} birthday the birthday of the user formatted by YYY-MM-DD
     * @apiParam {String} website users website format: http://domain.com
     * @apiParam {String} location the locaton of the user e.g. paris 
     *
     */
    public function run(UpdateProfileRequest $request)
    {
        $this->userRepository->update(auth()->user()->id, [
            'name'     => $request->name,
            'about'    => $request->about,
            'birthday' => $request->birthday,
            'location' => $request->location,
            'website'  => $request->website
        ]);
        
        $user = $this->userRepository->find(auth()->user()->id);
        
        if ($request->has('file')) {
            $this->associateMedia($user, $request, 'avatar');
        }
        
        return $this->responseWithSuccess(trans('common.update.success'));
    }
    
}
