<?php

namespace App\ACME\Admin\Price\Controllers;

use App\ACME\Admin\Price\Requests\StorePriceRequest;
use App\Models\Price;
use App\Http\Controllers\Controller;

class StorePriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function run(StorePriceRequest $request)
    {
        $price         = new Price();
        $price->points = $request->points;
        $price->price  = $request->price;
        $price->save();
        
        return redirect()
            ->back()
            ->with('success', 'Request successfully processed!');
    }
}
