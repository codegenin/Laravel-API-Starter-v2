<?php

namespace App\ACME\Api\V1\Favorite\Controllers;

use App\ACME\Api\V1\Category\Resource\CategoryResource;
use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\ACME\Api\V1\Collection\Resource\CollectionResource;
use App\ACME\Api\V1\User\Resource\UserResource;
use App\Http\Controllers\ApiResponseController;
use App\Models\Artist;
use App\Models\Category;
use App\Models\Collection;
use App\Traits\MediaTraits;
use Psr\Log\InvalidArgumentException;
use Vinkla\Hashids\Facades\Hashids;

class ListUserFavoritesController extends ApiResponseController
{
    use MediaTraits;
    
    /**
     * @var CollectionRepository
     */
    private $collectionRepository;
    
    /**
     * CollectionFavoriteController constructor.
     * @param CollectionRepository $collectionRepository
     */
    public function __construct(CollectionRepository $collectionRepository)
    {
        $this->middleware('jwt.auth', []);
        $this->collectionRepository = $collectionRepository;
    }
    
    /**
     * @apiGroup           Favorite
     * @apiName            listUserFavorites
     * @api                {get} /api/favorite/user-favorites List User Favorites
     * @apiDescription     Get all user favorites
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     *
     */
    public function run()
    {
        $categories = CategoryResource::collection(auth()
            ->user()
            ->favorite(Category::class));
        
        $collections = CollectionResource::collection(auth()
            ->user()
            ->favorite(Collection::class));
        
        $artists = UserResource::collection(auth()
            ->user()
            ->favorite(Artist::class));
        
        return response()->json([
            'status'      => true,
            'categories'  => $categories,
            'collections' => $collections,
            'artists'     => $artists
        ]);
        
    }
}