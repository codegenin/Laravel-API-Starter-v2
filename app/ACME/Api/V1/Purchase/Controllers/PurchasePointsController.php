<?php

namespace App\ACME\Api\V1\Purchase\Controllers;

use App\ACME\Api\V1\Puchase\Requests\PurchasePointsRequest;
use App\ACME\Api\V1\User\Repositories\UserRepository;
use App\Http\Controllers\ApiResponseController;

class PurchasePointsController extends ApiResponseController
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    
    /**
     * PurchaseCollectionController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('jwt.auth');
        $this->userRepository = $userRepository;
    }
    
    /**
     * @apiGroup           Purchase
     * @apiName            purchasePoints
     * @api                {post} /api/purchase/user-points Purchase Points
     * @apiDescription     Purchase points from google store
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {int} points the value of points to be added to the user
     *
     * @param PurchasePointsRequest $request
     * @return mixed
     */
    public function run(PurchasePointsRequest $request)
    {
        $this->userRepository->increment($request->points);
        
        return $this->responseWithSuccess(trans('purchase.success'));
        
    }
}