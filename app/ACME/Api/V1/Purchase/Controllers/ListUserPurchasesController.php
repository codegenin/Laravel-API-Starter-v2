<?php

namespace App\ACME\Api\V1\Purchase\Controllers;

use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\ACME\Api\V1\Collection\Resource\CollectionResource;
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
        /*$collections = CollectionResource::collection(auth()
            ->user()
            ->purchase(Collection::class));*/
        
        $query = DB::table('collections')
            ->join('purchases', 'collections.id', '=', 'purchases.purchasable_id');
        
        if (request()->has('category_id') AND !empty(request('category_id'))) {
            $query->where('collections.category_id', Hashids::decode(request('category_id')));
        }
        
        $collections = $query->where('purchases.user_id', auth()->user()->id)
            ->orderBy('collections.created_at', 'desc')
            ->paginate();
        
        return response()->json([
            'status'      => true,
            'collections' => $collections,
        ]);
    }
}