<?php

namespace App\ACME\Api\V1\Collection\Controllers;


use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\ACME\Api\V1\Collection\Requests\AddMediaToCollectionRequest;
use App\ACME\Api\V1\Collection\Requests\IncrementDecrementScoreRequest;
use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\Controller;
use App\Traits\MediaTraits;
use Vinkla\Hashids\Facades\Hashids;

class DecrementScoreCollectionController extends ApiResponseController
{
    /**
     * @var CollectionRepository
     */
    private $collectionRepository;
    
    /**
     * CreateCollectionController constructor.
     * @param CollectionRepository $collectionRepository
     */
    public function __construct(CollectionRepository $collectionRepository)
    {
        $this->middleware('jwt.auth', []);
        $this->collectionRepository = $collectionRepository;
    }
    
    /**
     * @apiGroup           Collection
     * @apiName            decrementScore
     * @api                {post} /api/collection/decrement Decrement Score
     * @apiDescription     Decrement a collection score
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {String} collection_id the encoded id of the collection
     * @apiParam {Int} score score to decrement - between 1 to 10
     *
     */
    public function run(IncrementDecrementScoreRequest $request)
    {
        try {
            $this->collectionRepository->decrement($request->collection_id, $request->score);
        } catch (\Exception $e) {
            return $this->responseWithError(trans('common.not.found'));
        }
        
        return $this->responseWithSuccess(trans('collection.decrement.success'));
    }
}
