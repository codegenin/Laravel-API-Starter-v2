<?php

namespace App\ACME\Api\V1\Search\Controllers;

use App\ACME\Api\V1\Category\Resource\CategoryResource;
use App\ACME\Api\V1\Collection\Resource\CollectionResource;
use App\ACME\Api\V1\Search\Requests\SearchRequest;
use App\ACME\Api\V1\User\Resource\UserResource;
use App\Http\Controllers\ApiResponseController;
use App\Models\Artist;
use App\Models\Category;
use App\Models\Collection;

class SearchAllController extends ApiResponseController
{
    public function __construct()
    {
        $this->middleware('jwt.auth', []);
    }
    
    /**
     * @apiGroup           Search
     * @apiName            search
     * @api                {get} /api/search/{term}/all Search All Records
     * @apiDescription     Search all records by query string
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {String} term the word to search
     *
     */
    public function run($term)
    {
        $categories = Category::search($term)
                              ->get();
        
        $collections = Collection::search($term)
                                 ->get();
        
        $artist = Artist::search($term)
                        ->where('role', 'artist')
                        ->get();
        
        return response()->json([
            'status'     => true,
            'categories' => CategoryResource::collection($categories),
            'collection' => CollectionResource::collection($collections),
            'artist'     => UserResource::collection($artist)
        ]);
    }
}
