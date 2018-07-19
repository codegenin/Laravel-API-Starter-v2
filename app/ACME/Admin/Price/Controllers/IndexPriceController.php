<?php

namespace App\ACME\Admin\Price\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexPriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function run()
    {
        $prices = Price::paginate();
        
        return view('admin.price.index', compact('prices'));
    }
}
