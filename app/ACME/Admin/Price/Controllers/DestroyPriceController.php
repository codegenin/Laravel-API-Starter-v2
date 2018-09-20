<?php

namespace App\ACME\Admin\Price\Controllers;

use App\ACME\Admin\Setting\Requests\DeleteSettingRequest;
use App\Http\Controllers\Controller;
use App\Models\Price;
use Spatie\Tags\Tag;

class DestroyPriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function run(DeleteSettingRequest $request)
    {
        $price = Price::find($request->id);
        $price->delete();
        
        return redirect()
            ->back()
            ->with('success', 'Request successfully processed!');
    }
}
