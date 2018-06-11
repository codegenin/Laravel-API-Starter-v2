<?php

namespace App\ACME\Api\V1\Category\Controllers;

use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\ACME\Api\V1\Category\Resource\CategoryResource;
use App\ACME\Api\V1\Category\Resource\CategoryResourceCollection;
use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Collection;
use Auth;
use Vinkla\Hashids\Facades\Hashids;

class DayCollectionsCategoryController extends ApiResponseController
{
    private $categoryRepository;
    
    /**
     * CategoryListsController constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->middleware('jwt.auth', []);
        $this->categoryRepository = $categoryRepository;
    }
    
    /**
     * @apiGroup           Category
     * @apiName            dayCollections
     * @api                {get} /api/category/{id}/collections/day Daily Collections
     * @apiDescription     Retrieve all collections which has been updated today
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {string} id the encoded category id
     * @apiParam {int} [page] the page number
     */
    public function run($id)
    {
        try {
            $collections = Collection::where('category_id', Hashids::decode($id))
                                     ->sortable()
                                     ->paginate(10);
        } catch (\Exception $e) {
            throw new NotFoundResourceException(trans('common.not.found'));
        }
        
        return new CollectionResourceCollection($collections);
    }
}