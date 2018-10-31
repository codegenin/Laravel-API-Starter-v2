<?php

namespace App\ACME\Api\V1\Favorite\Controllers;

use App\ACME\Api\V1\User\Repositories\UserRepository;
use App\Http\Controllers\ApiResponseController;
use App\Models\Artist;
use App\Models\User;
use Psr\Log\InvalidArgumentException;
use Vinkla\Hashids\Facades\Hashids;

class SetArtistAsFavoriteController extends ApiResponseController
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
     * @apiName            setArtistAsFavorite
     * @api                {get} /api/favorite/{id}/artist Set Artist As Favorite
     * @apiDescription     Set a artist as user favorite - send same request to toggle favorite to on/off
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {String} id the encoded artist id
     *
     */
    public function run($id)
    {
        try {
            $artist = Artist::where('id', Hashids::decode($id))
                            ->where('role', 'artist')
                            ->first();
            auth()
                ->user()
                ->toggleFavorite($artist);
        } catch (\Exception $e) {
            throw new InvalidArgumentException($e);
        }
        
        return $this->responseWithSuccess(trans('favorite.user.success'));
        
    }
}