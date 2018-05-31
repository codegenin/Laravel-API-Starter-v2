<?php

namespace App\ACME\Api\V1\User\Controllers;

use App\ACME\Api\V1\User\Repositories\UserRepository;
use App\ACME\Api\V1\User\Resource\UserResource;
use Dingo\Api\Exception\ResourceException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\ACME\Api\V1\Authentication\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Auth;
use Vinkla\Hashids\Facades\Hashids;

/**
 * @Resource("Users")
 */
class UserController extends Controller
{
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
    
    public function me()
    {
        UserResource::withoutWrapping();
        
        return new UserResource(Auth::guard()
                                    ->user());
    }
    
    /**
     * @apiGroup           User
     * @apiName            deleteUser
     * @api                {get} /api/user/{id}/delete Delete User
     * @apiDescription     Delete a user
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {String} id the encoded id of the user
     *
     *
     * @apiSuccessExample {json} Success-Response:
     *                     {
     * "status": "ok",
     * "message": "User has been delete!"
     * }
     *
     */
    public function delete($id)
    {
        $id = Hashids::decode($id);
        
        if (!$this->userRepository->delete($id)) {
            throw new ResourceNotFoundException();
        }
        
        return response()->json([
            'status'  => 'ok',
            'message' => 'User has been delete successfully!'
        ]);
    }
}
