<?php

namespace App\ACME\Api\V1\Purchase\Controllers;

use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\ACME\Api\V1\Collection\Resource\CollectionResource;
use App\Http\Controllers\ApiResponseController;
use App\Models\Collection;
use App\Models\User;
use Psr\Log\InvalidArgumentException;
use Vinkla\Hashids\Facades\Hashids;

class ListUserPurchasesController extends ApiResponseController
{
    /**
     * @var CollectionRepository
     */
    private $collectionRepository;
    
    /**
     */
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
    
    /**
     * @apiGroup           Purchase
     * @apiName            userPurchases
     * @api                {get} /api/purchase/user-purchases List User Purchases
     * @apiDescription     List All User Purchases
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     */
    public function run()
    {
        $collections = CollectionResource::collection(auth()
            ->user()
            ->purchase(Collection::class));
        
        return response()->json([
            'status'      => true,
            'collections' => $collections,
        ]);
    }
}