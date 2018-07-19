<?php

namespace App\ACME\Api\V1\Price\Controllers;

use App\ACME\Api\V1\Price\Resource\PriceResource;
use App\Models\Price;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListPricesController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
    
    public function run()
    {
        $prices = Price::all();
        
        return PriceResource::collection($prices);
    }
}
