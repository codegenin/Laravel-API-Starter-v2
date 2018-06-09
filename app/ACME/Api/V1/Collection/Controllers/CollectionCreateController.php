<?php

namespace App\ACME\Api\V1\Collection\Controllers;


use App\ACME\Api\V1\Collection\Requests\CreateCollectionRequest;
use App\Http\Controllers\Controller;
use App\Models\Collection;

class CollectionCreateController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', []);
    }
    
    public function store(CreateCollectionRequest $request)
    {
        $collection = new Collection();
        
    }
}
