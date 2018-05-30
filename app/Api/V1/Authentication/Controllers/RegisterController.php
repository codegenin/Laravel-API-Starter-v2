<?php

namespace App\Api\V1\Authentication\Controllers;

use App\Api\V1\Authentication\Requests\SignUpRequest;
use Config;
use App\User;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RegisterController extends Controller
{
    /**
     * @apiGroup           Authentication
     * @apiName            RegisterUser
     * @api                {post} /api/auth/register Register User
     * @apiDescription     Register a new artist or patron
     *
     * @apiVersion         1.0.0
     * @apiPermission      none
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
        // Remove this once email confirmation is set
        $request->merge([
            'is_active' => 1
        ]);
        
        $user            = new User();
        $user->name      = $request->name;
        $user->email     = $request->email;
        $user->password  = $request->password;
        $user->is_active = 1; // Remove this when email confirmation is active
        
        if (!$user->save()) {
            throw new HttpException(500);
        }
        
        if (!Config::get('boilerplate.sign_up.release_token')) {
            return response()->json([
                'status' => 'ok'
            ], 201);
        }
        
        $token = $JWTAuth->fromUser($user);
        
        return response()->json([
            'status' => 'ok',
            'token'  => $token
        ], 201);
    }
}
