<?php

namespace App\ACME\Api\V1\User\Controllers;

use App\ACME\Api\V1\User\Repositories\UserRepository;
use App\ACME\Api\V1\User\Resource\UserResource;
use App\Http\Controllers\ApiResponseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psr\Log\InvalidArgumentException;
use Vinkla\Hashids\Facades\Hashids;

class ViewUserController extends ApiResponseController
{
    private $userRepository;
    
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('jwt.auth', []);
        $this->userRepository = $userRepository;
    }
    
    /**
     * @apiGroup           User
     * @apiName            viewUser
     * @api                {get} /api/user/{id}/show View User
     * @apiDescription     Retrieve the user artist information
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {int} id the encoded user id
     */
    public function run($id)
    {
        try {
            $user = $this->userRepository->find( Hashids::decode($id));
        } catch (\Exception $e) {
            throw new InvalidArgumentException(trans('common.not.found'));
        }
        
        $user = collect(new UserResource($user));
        
        return $this->responseWithResource($user->toArray());
    }
}
