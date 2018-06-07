<?php

namespace App\ACME\Api\V1\Category\Controllers;

use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\ACME\Api\V1\Category\Resource\CategoryResource;
use App\ACME\Api\V1\Category\Resource\CategoryResourceCollection;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Auth;

class CategoryListsController extends Controller
{
    /**
     * @var CategoryRepository
     */
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
     * @apiName            listAllCategories
     * @api                {get} /api/category/list-all List All Categories
     * @apiDescription     List all available categories sorted by order field
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     *
     */
    public function listAll()
    {
        $categories = Category::nested()->sortable('seq')->get();
        
        return response()->json([
            'status' => 'ok',
            'data' => $categories
        ]);
    }
}