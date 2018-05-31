<?php

namespace App\ACME\Api\V1\User\Controllers;

use App\ACME\Api\V1\User\Resource\UserResource;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\ACME\Api\V1\Authentication\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Auth;

/**
 * @Resource("Users")
 */
class UserController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth', []);
    }
    
    public function me()
    {
        UserResource::withoutWrapping();
        return new UserResource(Auth::guard()->user());
    }
}
