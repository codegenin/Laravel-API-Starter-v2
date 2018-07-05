<?php

namespace App\ACME\Api\V1\Setting\Controllers;

use App\Http\Controllers\ApiResponseController;

class PriceListController extends ApiResponseController
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
    
    /**
     * @apiGroup           Setting
     * @apiName            priceList
     * @api                {get} /api/setting/price-list Price List
     * @apiDescription     Show pricing list
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     */
    public function run()
    {
        return response()->json([
            'status' => 'true',
            'data'   => [
                [
                    'points' => 1000,
                    'price'  => 0.99
                ],
                [
                    'points' => 3000,
                    'price'  => 1.99
                ]
            ]
        ]);
    }
}