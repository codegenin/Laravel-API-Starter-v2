<?php

namespace App\ACME\Api\V1\Authentication\Controllers;

use App\ACME\Api\V1\Authentication\Requests\SocialAuthenticationRequest;
use App\ACME\Api\V1\User\Repositories\UserRepository;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use Auth;

class SocialAuthenticationController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    
    /**
     * SocialAuthencationController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    /**
     * @apiGroup           Authentication
     * @apiName            socialAuthentication
     * @api                {post} /api/auth/social Login/Register User (Social)
     * @apiDescription     Logging in users using social account.
     * @apiVersion         1.0.0
     *
     * @apiParam {String} email unique email of the user
     * @apiParam {String} social_id the id of the user from the provider
     * @apiParam {String} provider default to 'app' or choose between facebook and google
     * @apiParam {String} name name of the user
     *
     * @apiSuccessExample {json} Success-Response:
     *{
     * "status": true,
     * "token":
     * "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vYXBpLnlveW9naS5vby9hcGkvYXV0aC9zb2NpYWwiLCJpYXQiOjE1MjgwMzEwMTcsImV4cCI6MTUyODAzNDYxNywibmJmIjoxNTI4MDMxMDE3LCJqdGkiOiJZSDlOWHRNeWNiQkFaMm5ZIiwic3ViIjoxLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.iBP8LY555D-acykoIUPmYvEG1e20iFr2vAqAqoeL4qo",
     * "expires_in": 3600,
     * "id": "Yx3WVBlkw697rJjZznqg2oab",
     * "name": "test",
     * "role": null
     * }
     *
     */
    public function login(SocialAuthenticationRequest $request, JWTAuth $JWTAuth)
    {
        $user = $this->userRepository->findByColumnsFirst([
            'email'     => $request->email,
            'social_id' => $request->social_id,
            'provider'  => $request->provider
        ]);
        
        if (!$user) {
            
            // Check if a user exists
            $exists = $this->userRepository->findByColumnsFirst([
                'email' => $request->email
            ]);
            
            if ($exists) {
                return response()->json([
                    'status'  => false,
                    'message' => 'User already exist using a different provider!'
                ]);
            }
            
            // Create User
            $user = $this->userRepository->create([
                'name'               => $request->name,
                'email'              => $request->email,
                'password'           => bcrypt($request->email . '123'),
                'social_id'          => $request->social_id,
                'provider'           => $request->provider,
                /*'avatar'             => $request->avatar,
                'avatar_original'    => $request->avata,
                'social_profile_url' => $request->social_profile,*/
                'verified'           => 1
            ]);
        }
        
        $token = Auth::guard()
                     ->fromUser($user);
        
        return response()
            ->json([
                'status'     => true,
                'token'      => $token,
                'expires_in' => Auth::guard()
                                    ->factory()
                                    ->getTTL() * 60,
                'id'         => \Vinkla\Hashids\Facades\Hashids::encode($user->id),
                'name'       => $user->name,
                'role'       => $user->role,
            ]);
    }
}
