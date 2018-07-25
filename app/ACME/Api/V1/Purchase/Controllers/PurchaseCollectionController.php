<?php

namespace App\ACME\Api\V1\Purchase\Controllers;

use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\Http\Controllers\ApiResponseController;
use App\Models\Collection;
use App\Models\User;
use Psr\Log\InvalidArgumentException;
use Vinkla\Hashids\Facades\Hashids;

class PurchaseCollectionController extends ApiResponseController
{
    /**
     * @var CollectionRepository
     */
    private $collectionRepository;
    
    /**
     * PurchaseCollectionController constructor.
     * @param CollectionRepository $collectionRepository
     */
    public function __construct(CollectionRepository $collectionRepository)
    {
        $this->middleware('jwt.auth');
        $this->collectionRepository = $collectionRepository;
    }
    
    /**
     * @apiGroup           Purchase
     * @apiName            purchaseCollection
     * @api                {get} /api/purchase/{id}/collection Purchase A Collection
     * @apiDescription     Purchase a collection to unlock it
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {String} id the encoded collection id
     *
     */
    public function run($id)
    {
        $collection = $this->collectionRepository->findOrFail(Hashids::decode($id));
        
        if(empty($collection)) {
            return $this->responseWithError(trans('common.not.found'));
        }
        
        // Checks if user points  is enough to purchase the collection
        if (auth()->user()->points < $collection->points) {
            return $this->responseWithError(trans('purchase.not_enough_points'));
        }
        
        // Checks if the collection has been purchased already
        if(auth()->user()->hasPurchased($collection)) {
            return $this->responseWithError(trans('purchase.already_purchased'));
        }
    
        // Try to purchase the collection
        try {
            auth()
                ->user()
                ->togglePurchase($collection);
    
            // Deduct user points
            $user = User::find(auth()->user()->id);
            $user->points = $user->points - $collection->points;
            $user->save();
            
        } catch (\Exception $e) {
            throw  new InvalidArgumentException($e);
        }
        
        return $this->responseWithSuccess(trans('purchase.success'));
        
    }
}