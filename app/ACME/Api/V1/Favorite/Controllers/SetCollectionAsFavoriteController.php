<?php

namespace App\ACME\Api\V1\Favorite\Controllers;

use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\Http\Controllers\ApiResponseController;
use App\Models\Collection;
use Psr\Log\InvalidArgumentException;
use Vinkla\Hashids\Facades\Hashids;

class SetCollectionAsFavoriteController extends ApiResponseController
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
     * @apiName            setCollectionAsFavorite
     * @api                {get} /api/favorite/{id}/collection Set Collection As Favorite
     * @apiDescription     Set a collection as user favorite - send the same request to toggle the favorite to on/off
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {String} id the encoded collection id
     *
     */
    public function run($id)
    {
        try {
            $collection = $this->collectionRepository->find(Hashids::decode($id));
            auth()
                ->user()
                ->toggleFavorite($collection);
        } catch (\Exception $e) {
            throw new InvalidArgumentException($e);
        }
        
        return $this->responseWithSuccess(trans('favorite.collection.success'));
        
    }
}