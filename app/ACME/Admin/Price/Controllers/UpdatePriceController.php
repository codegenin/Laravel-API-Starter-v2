<?php

namespace App\ACME\Admin\Price\Controllers;

use App\ACME\Admin\Price\Requests\StorePriceRequest;
use App\Models\Price;
use App\Http\Controllers\Controller;

class UpdatePriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function run(StorePriceRequest $request)
    {
        $price            = Price::find($request->id);
        $price->points    = $request->points;
        $price->price     = $request->price;
        $price->google_id = $request->google_id;
        $price->save();
        
        return redirect()
            ->back()
            ->with('success', 'Request successfully processed!');
    }
}
