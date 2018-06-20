<?php

namespace App\ACME\Api\V1\Category\Controllers;

use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\ACME\Api\V1\Category\Resource\CategoryResource;
use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Auth;
use Vinkla\Hashids\Facades\Hashids;

class ViewCategoryController extends ApiResponseController
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
     * @apiName            viewCategory
     * @api                {get} /api/category/{id}/show View Category
     * @apiDescription     Retrieve the category information
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {int} id the encoded category id
     */
    public function run($id)
    {
        $category = $this->categoryRepository->find(Hashids::decode($id));
        $category = collect(new CategoryResource($category));
        
        return $this->responseWithResource($category->toArray());
    }
}