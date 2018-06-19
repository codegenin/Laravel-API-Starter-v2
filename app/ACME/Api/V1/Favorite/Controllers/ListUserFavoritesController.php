<?php

namespace App\ACME\Api\V1\Favorite\Controllers;

use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\Http\Controllers\ApiResponseController;
use App\Models\Category;
use App\Models\Collection;
use Psr\Log\InvalidArgumentException;
use Vinkla\Hashids\Facades\Hashids;

class ListUserFavoritesController extends ApiResponseController
{
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
        $categories = [];
        
        if (count(auth()
                ->user()
                ->favorite(Category::class)) > 0) {
            foreach (auth()
                ->user()
                ->favorite(Category::class) as $category) {
                $categories[] = $category;
            }
        }
        
        $collections = [];
        
        if (count(auth()
                ->user()
                ->favorite(Collection::class)) > 0) {
            foreach (auth()
                ->user()
                ->favorite(Collection::class) as $collection) {
                $collections[] = $collection;
            }
        }
        
        return response()->json([
            'status'      => true,
            'categories'  => $categories,
            'collections' => $collections
        ]);
        
    }
}