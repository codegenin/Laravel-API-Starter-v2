<?php

namespace App\ACME\Api\V1\Category\Controllers;

use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\ACME\Api\V1\Category\Resource\CategoryResource;
use App\ACME\Api\V1\Category\Resource\CategoryResourceCollection;
use App\ACME\Api\V1\Collection\Resource\CollectionResourceCollection;
use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Collection;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Vinkla\Hashids\Facades\Hashids;

class WeekCollectionsCategoryController extends ApiResponseController
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
     * @apiName            weekCollections
     * @api                {get} /api/category/{id}/collections/week This Week Collections
     * @apiDescription     Retrieve all collections which has been updated on current week.
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {string} id the encoded category id
     * @apiParam {int} [page] the page number
     */
    public function run($id)
    {
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        
        try {
            $collections = Collection::where('category_id', Hashids::decode($id))
                                     ->whereBetween('created_at', [
                                         Carbon::now()
                                               ->startOfWeek(),
                                         Carbon::now()
                                               ->endOfWeek()
                                     ])
                                     ->orderBy('score', 'desc')
                                     ->paginate();
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
        
        return new CollectionResourceCollection($collections);
    }
}