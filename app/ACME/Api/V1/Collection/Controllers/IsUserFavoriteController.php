<?php

namespace App\ACME\Api\V1\Collection\Controllers;

use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\ACME\Api\V1\Collection\Resource\CollectionResource;
use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\Controller;
use App\Models\Collection;
use Auth;
use Vinkla\Hashids\Facades\Hashids;

class IsUserFavoriteController extends ApiResponseController
{
    private $collectionRepository;
    
    /**
     * CollectionListsController constructor.
     * @param CollectionRepository $collectionRepository
     */
    public function __construct(CollectionRepository $collectionRepository)
    {
        $this->middleware('jwt.auth', []);
        $this->collectionRepository = $collectionRepository;
    }
    
    /**
     * @apiGroup           Collection
     * @apiName            isUserFavorite
     * @api                {get} /api/collection/{id}/is-user-favorite Is User Favorite
     * @apiDescription     Check if a collection is favorite of a user
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {int} id the encoded collection id
     */
    public function run($id)
    {
        $collection = $this->collectionRepository->find(Hashids::decode($id));
        
        return response()->json([
            'status'     => true,
            'isFavorite' => $collection->isFavorited(auth()->user()->id)
        ]);
    }
}