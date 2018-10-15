<?php

namespace App\ACME\Api\V1\Authentication\Controllers;

use App\ACME\Api\V1\Authentication\Requests\LoginRequest;
use App\Events\AuthLoginEventHandler;
use App\Http\Controllers\ApiResponseController;
use Hashids\Hashids;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Auth;

class LoginController extends ApiResponseController
{
    /**
     * @apiGroup           Authentication
     * @apiName            loginUser
     * @api                {post} /api/auth/login Login User (Email)
     * @apiDescription     Logging in users via api endpoint.
     * @apiVersion         1.0.0
     *
     * @apiParam {String} email unique email of the user
     * @apiParam {String} password at least 6 characters
     *
     * @apiSuccessExample {json} Success-Response:
     *                     {
     * "status": true,
     * "token":
     * "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vYXBpLnlveW9naS5vby9hcGkvYXV0aC9sb2dpbiIsImlhdCI6MTUyNzY3ODg2NiwiZXhwIjoxNTI3NjgyNDY2LCJuYmYiOjE1Mjc2Nzg4NjYsImp0aSI6IklmdlpQbHIwcGJoUGFlcEoiLCJzdWIiOjMsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.xXrwVH9ggT1gx1iir6pXT8Jd0Tyw6Q1PIFK4VICSq8Q",
     * "expires_in": 3600,
     * "id": 3,
     * "name": "test",
     * "role": null
     * }
     *
     * @apiErrorExample {json} Error-Response:
     *                     {
     * "status": false,
     * "message": "403 Forbidden",
     * "status_code": 403
     * }
     */
    public function login(LoginRequest $request, JWTAuth $JWTAuth)
    {
        $credentials = $request->only([
            'email',
            'password'
        ]);
        
        try {
            $token = Auth::guard()
                         ->attempt($credentials);
            
            if (!$token) {
                throw new AccessDeniedHttpException(trans('auth.failed'));
            }
            
        } catch (JWTException $e) {
            return $this->responseWithError(trans('auth.exception'));
        }
        
        // Checks if user is active
        $user = Auth::guard()
                    ->authenticate($token);
        
        if (!$user->verified) {
            throw new AccessDeniedHttpException(trans('auth.disabled'));
        }
        
        event(new AuthLoginEventHandler($user));
        
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
                'is_new'     => $user->is_new
            ]);
    }
}
