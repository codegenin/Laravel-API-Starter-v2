<?php

namespace App\ACME\Api\V1\User\Controllers;

use App\ACME\Api\V1\User\Repositories\UserRepository;
use App\ACME\Api\V1\User\Resource\UserResource;
use App\Http\Controllers\ApiResponseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;

class ViewArtistController extends ApiResponseController
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
     * @apiName            viewArtist
     * @api                {get} /api/user/artist/{id}/show View Artist
     * @apiDescription     Retrieve the user artist information
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {int} id the encoded user id
     */
    public function run($id)
    {
        $user = $this->userRepository->findByColumnsFirst([
            'id'   => Hashids::decode($id),
            'role' => 'artist'
        ]);
        
        $user = collect(new UserResource($user));
        
        return $this->responseWithResource($user->toArray());
    }
}
