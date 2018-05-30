<?php

namespace App\Api\V1\Authentication\Controllers;

use App\Api\V1\Authentication\Requests\LoginRequest;
use Hashids\Hashids;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Auth;

class LoginController extends Controller
{
    /**
     * @apiGroup           Authentication
     * @apiName            loginUser
     * @api                {post} /api/auth/login Login User (Email)
     * @apiDescription     Logging in users via api endpoint.
     * @apiVersion         1.0.0
     * @apiPermission      none
     *
     * @apiParam {String} email unique email of the user
     * @apiParam {String} password at least 6 characters
     *
     * @apiSuccessExample {json} Success-Response:
     *                     {
     * "status": "ok",
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
     * "status": "error",
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
                throw new AccessDeniedHttpException();
            }
            
        } catch (JWTException $e) {
            throw new HttpException(500);
        }
        
        // Checks if user is active
        $user = Auth::guard()
                    ->authenticate($token);
        
        if (!$user->is_active) {
            throw new AccessDeniedHttpException('Account is disabled! please check your email to activate your account.');
        }
        
        return response()
            ->json([
                'status'     => 'ok',
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
