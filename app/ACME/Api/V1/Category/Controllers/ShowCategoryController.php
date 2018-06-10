<?php

namespace App\ACME\Api\V1\Category\Controllers;

use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\ACME\Api\V1\Category\Resource\CategoryResource;
use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Auth;
use Vinkla\Hashids\Facades\Hashids;

class ShowCategoryController extends ApiResponseController
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
     * @apiName            showCategory
     * @api                {get} /api/category/{id}/show Show Category
     * @apiDescription     Retrieve the category information
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {int} id the category id
     */
    public function run($id)
    {
        $id       = Hashids::decode($id);
        $category = $this->categoryRepository->find($id);
        $category = collect(new CategoryResource($category));
        
        return $this->responseWithResource($category->toArray());
    }
}