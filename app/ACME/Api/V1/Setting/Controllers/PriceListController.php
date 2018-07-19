<?php

namespace App\ACME\Api\V1\Setting\Controllers;

use App\ACME\Api\V1\Price\Resource\PriceResource;
use App\ACME\Api\V1\Price\Resource\PriceResourceCollection;
use App\Http\Controllers\ApiResponseController;
use App\Models\Price;

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
        $prices = Price::all();
        
        return new PriceResourceCollection($prices);
    }
}