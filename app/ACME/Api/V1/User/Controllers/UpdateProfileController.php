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
     * @apiParam {String} name the complete name of the user
     * @apiParam {String} [contact_email] the contact email of the user
     * @apiParam {Date} [birthday] the birthday of the user formatted by YYY-MM-DD
     * @apiParam {String} [website] users website format: http://domain.com
     * @apiParam {String} location the locaton of the user e.g. paris
     * @apiParam {String} [phone] the users phone number
     * @apiParam {String} [password] change user password
     *
     */
    public function run(UpdateProfileRequest $request)
    {
        $user                     = User::find(auth()->user()->id);
        $user->name               = $request->name;
        $details                  = $user->details;
        $details['contact_email'] = isset($request->contact_email) ? $request->contact_email : '';
        $details['contact_email'] = isset($request->contact_email) ? $request->contact_email : '';
        $details['birthday']      = isset($request->birthday) ? $request->birthday : '';
        $details['location']      = isset($request->location) ? $request->location : '';
        $details['website']       = isset($request->website) ? $request->website : '';
        $details['phone']         = isset($request->phone) ? $request->phone : '';
        $user->details            = $details;
        
        if ($request->has('password') AND !empty($request->password)) {
            $user->password = $request->password;
        }
        
        $user->save();
        
        return $this->responseWithSuccess(trans('common.update.success'));
    }
    
}
