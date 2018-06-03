<?php

namespace App\ACME\Api\V1\Authentication\Controllers;

use App\ACME\Api\V1\Authentication\Repositories\UserRepository;
use App\ACME\Api\V1\Authentication\Requests\SignUpRequest;
use App\Jobs\SendVerificationEmail;
use Config;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RegisterController extends Controller
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
     *                     { "status": "ok"}
     */
    public function register(SignUpRequest $request, JWTAuth $JWTAuth)
    {
        $userRepo = new UserRepository();
        
        $data = [
            'name'               => $request->name,
            'email'              => $request->email,
            'password'           => $request->password,
            'verification_token' => base64_encode($request->email)
        ];
        
        if (!$user = $userRepo->create($data)) {
            throw new HttpException(500);
        }
        
        // Send verification email
        dispatch(new SendVerificationEmail($user));
        
        if (!Config::get('boilerplate.sign_up.release_token')) {
            return response()->json([
                'status'  => 'ok',
                'message' => 'A verification mail has been sent into your email account!'
            ], 201);
        }
        
        $token = $JWTAuth->fromUser($user);
        
        return response()->json([
            'status' => 'ok',
            'token'  => $token
        ], 201);
    }
}
