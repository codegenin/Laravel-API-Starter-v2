<?php

namespace App\ACME\Api\V1\Favorite\Controllers;

use App\ACME\Api\V1\User\Repositories\UserRepository;
use App\Http\Controllers\ApiResponseController;
use App\Models\Artist;
use App\Models\User;
use Psr\Log\InvalidArgumentException;
use Vinkla\Hashids\Facades\Hashids;

class SetUserAsFavoriteController extends ApiResponseController
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    
    /**
     * UserFavoriteController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('jwt.auth', []);
        $this->userRepository = $userRepository;
    }
    
    /**
     * @apiGroup           Favorite
     * @apiName            setUserAsFavorite
     * @api                {get} /api/favorite/{id}/user Set User As Favorite
     * @apiDescription     Set a user as user favorite
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {String} id the encoded user id
     *
     */
    public function run($id)
    {
        $artist = new Artist();
        
        try {
            $artist = $artist->find(Hashids::decode($id));
            auth()
                ->user()
                ->toggleFavorite($artist);
        } catch (\Exception $e) {
            throw new InvalidArgumentException($e);
        }
        
        return $this->responseWithSuccess(trans('favorite.user.success'));
        
    }
}