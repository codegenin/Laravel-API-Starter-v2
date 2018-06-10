<?php

namespace App\ACME\Api\V1\Collection\Controllers;


use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\ACME\Api\V1\Collection\Requests\AddMediaToCollectionRequest;
use App\ACME\Api\V1\Collection\Requests\IncrementDecrementScoreRequest;
use App\Http\Controllers\Controller;
use App\Traits\MediaTraits;
use Vinkla\Hashids\Facades\Hashids;

class IncrementScoreCollectionController extends Controller
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
     * @apiName            incrementScore
     * @api                {post} /api/collection/increment Increment Score
     * @apiDescription     Increment a collection score
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {String} collection_id the encoded id of the collection
     * @apiParam {Int} score score to increment - between 1 to 10
     *
     */
    public function run(IncrementDecrementScoreRequest $request)
    {
        try {
            $this->collectionRepository->increment($request->collection_id, $request->score);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => trans('common.not.found')
            ]);
        }
        
        return response()->json([
            'status'  => 'ok',
            'message' => trans('collection.increment.success')
        ]);
    }
}
