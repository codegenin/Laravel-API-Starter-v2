<?php

namespace App\ACME\Api\V1\Category\Controllers;

use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\ACME\Api\V1\Collection\Resource\CollectionResourceCollection;
use App\Http\Controllers\Controller;
use App\Models\Collection;
use Auth;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class CollectionCategoryController extends Controller
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
     * @apiName            categoryCollections
     * @api                {get} /api/category/{id}/collections Category Collections
     * @apiDescription     Retrieve all collections of a category
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {string} id identifier code of the category
     * @apiParam {int} [page] the page number
     */
    public function run($id)
    {
        $id          = \Vinkla\Hashids\Facades\Hashids::decode($id);
        
        try {
            $collections = Collection::where('category_id', $id)
                                     ->sortable()
                                     ->paginate(2);
        } catch (\Exception $e) {
            throw new NotFoundResourceException(trans('common.not.found'));
        }
        
        return new CollectionResourceCollection($collections);
    }
}