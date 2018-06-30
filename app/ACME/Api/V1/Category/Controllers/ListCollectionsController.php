<?php

namespace App\ACME\Api\V1\Category\Controllers;

use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\ACME\Api\V1\Collection\Resource\CollectionResourceCollection;
use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\Controller;
use App\Models\Collection;
use Auth;
use Psr\Log\InvalidArgumentException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Vinkla\Hashids\Facades\Hashids;

class ListCollectionsController extends ApiResponseController
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
     * @apiName            listCollections
     * @api                {get} /api/category/{id}/collections List Collections
     * @apiDescription     Retrieve all collections of a category
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
                                     ->orderBy('created_at', 'desc')
                                     ->paginate();
        } catch (\Exception $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
        
        return new CollectionResourceCollection($collections);
    }
}