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

class CollectionsRecentController extends ApiResponseController
{
    public function __construct()
    {
        $this->middleware('jwt.auth', []);
    }
    
    /**
     * @apiGroup           Collection
     * @apiName            collectionsRecent
     * @api                {get} /api/collection/all-recent-collections List Recent Collections
     * @apiDescription     Retrieve all recent collections
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     */
    public function run()
    {
        $collection = Collection::orderBy('created_at', 'desc')
                                ->paginate();
        
        return new CollectionResourceCollection($collection);
    }
}