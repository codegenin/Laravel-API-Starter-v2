<?php

namespace App\ACME\Api\V1\Purchase\Controllers;

use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\ACME\Api\V1\Collection\Resource\CollectionResource;
use App\ACME\Api\V1\Collection\Resource\CollectionResourceCollection;
use App\Http\Controllers\ApiResponseController;
use App\Models\Collection;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
     * @api                {get} /api/purchase/user-purchases/{category_id?} List User Purchases
     * @apiDescription     List All User Purchases
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {string} category_id the encoded category id - optional
     */
    public function run()
    {
        $query = Collection::visible();
        
        if (request()->has('category_id') AND !empty(request('category_id'))) {
            $query->where('category_id', Hashids::decode(request('category_id')));
        }
        
        $collections = $query->whereHas('archives', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->paginate();
        
        return new CollectionResourceCollection($collections);

    }
}