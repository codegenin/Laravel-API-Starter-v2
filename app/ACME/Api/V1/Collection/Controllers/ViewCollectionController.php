<?php

namespace App\ACME\Api\V1\Collection\Controllers;

use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\ACME\Api\V1\Collection\Resource\CollectionResource;
use App\Http\Controllers\ApiResponseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;

class ViewCollectionController extends ApiResponseController
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
     * @apiName            viewCollection
     * @api                {get} /api/collection/{id}/show View Collection
     * @apiDescription     Retrieve the collection information
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {int} id the encoded collection id
     */
    public function run($id)
    {
        $collection = $this->collectionRepository->find(Hashids::decode($id));
        $collection = collect(new CollectionResource($collection));
        
        return $this->responseWithResource($collection->toArray());
    }
}
