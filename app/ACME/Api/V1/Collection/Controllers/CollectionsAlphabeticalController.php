<?php

namespace App\ACME\Api\V1\Collection\Controllers;

use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\ACME\Api\V1\Category\Resource\AdminCategoryResource;
use App\ACME\Api\V1\Category\Resource\CategoryResourceCollection;
use App\ACME\Api\V1\Collection\Resource\CollectionResource;
use App\ACME\Api\V1\Collection\Resource\CollectionResourceCollection;
use App\ACME\Api\V1\Media\Resource\MediaResource;
use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Media;
use Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Vinkla\Hashids\Facades\Hashids;

class CollectionsAlphabeticalController extends ApiResponseController
{
    public function __construct()
    {
        $this->middleware('jwt.auth', []);
    }
    
    /**
     * @apiGroup           Collection
     * @apiName            collectionsAlphabetical
     * @api                {get} /api/collection/all-alphabetical-collections List Alphabetical Collections
     * @apiDescription     Retrieve all collections in alphabetically
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     */
    public function run()
    {
        $collection = Collection::join('collection_translations as t', function ($join) {
            $join->on('collections.id', '=', 't.collection_id')
                 ->where('t.locale', '=', 'en');
        })->visible()
                                ->orderBy('t.title', 'asc')
                                ->select('collections.*', 't.title')
                                ->with('translations')
                                ->paginate();
        
        return new CollectionResourceCollection($collection);
    }
}