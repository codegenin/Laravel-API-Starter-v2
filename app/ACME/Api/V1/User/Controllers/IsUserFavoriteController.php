<?php

namespace App\ACME\Api\V1\User\Controllers;

use App\ACME\Api\V1\User\Repositories\UserRepository;
use App\ACME\Api\V1\User\Resource\UserResource;
use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\User;
use Auth;
use Vinkla\Hashids\Facades\Hashids;

class IsUserFavoriteController extends ApiResponseController
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    
    /**
     * IsUserFavoriteController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('jwt.auth', []);
        $this->userRepository = $userRepository;
    }
    
    /**
     * @apiGroup           User
     * @apiName            isArtistUserFavorite
     * @api                {get} /api/user/artist/{id}/is-user-favorite Is Artist User Favorite
     * @apiDescription     Check if a artist is favorite of a user
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {int} id the encoded artist id
     */
    public function run($id)
    {
        $artist = Artist::where('id', Hashids::decode($id))
                        ->where('role', 'artist')
                        ->first();
        
        return response()->json([
            'status'     => true,
            'isFavorite' => $artist->isFavorited(auth()->user()->id)
        ]);
    }
}