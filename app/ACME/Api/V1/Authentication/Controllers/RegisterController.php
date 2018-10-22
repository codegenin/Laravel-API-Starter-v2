<?php

namespace App\ACME\Api\V1\Authentication\Controllers;

use App\ACME\Api\V1\Authentication\Repositories\UserRepository;
use App\ACME\Api\V1\Authentication\Requests\SignUpRequest;
use App\Http\Controllers\ApiResponseController;
use App\Jobs\SendVerificationEmail;
use Config;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RegisterController extends ApiResponseController
{
    /**
     * @apiGroup           Authentication
     * @apiName            RegisACME\\terUser
     * @api                {post} /api/auth/register Register User
     * @apiDescription     Register a new artist or patron
     *
     * @apiVersion         1.0.0
     *
     * @apiParam {String} name the complete name of the user
     * @apiParam {String} email unique email of the user
     * @apiParam {String} password at least 6 characters
     * @apiParam {String} role artist | patron
     *
     * @apiSuccessExample {json} Success-Response:
     *                     { "status": true}
     */
    public function register(SignUpRequest $request, JWTAuth $JWTAuth)
    {
        $userRepo = new UserRepository();
        
        $data = [
            'name'               => $request->name,
            'email'              => $request->email,
            'password'           => Hash::make($request->password),
            'verification_token' => base64_encode($request->email),
            'points'             => 1000
        ];
        
        $exists = $userRepo->findByColumnsFirst(['email' => $request->email]);
        
        if ($exists) {
            return $this->responseWithError(trans('auth.registered'));
        }
        
        if (!$user = $userRepo->create($data)) {
            throw new HttpException(trans('auth.exception'));
        }
        
        // Send verification email
        dispatch(new SendVerificationEmail($user));
        
        if (!Config::get('boilerplate.sign_up.release_token')) {
            return response()->json([
                'status'  => true,
                'message' => 'A verification mail has been sent into your email account!'
            ], 201);
        }
        
        $token = $JWTAuth->fromUser($user);
        
        return response()->json([
            'status' => true,
            'token'  => $token
        ], 201);
    }
}
