<?php

namespace App\ACME\Api\V1\Category\Controllers;

use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\ACME\Api\V1\Category\Resource\AdminCategoryResource;
use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Auth;
use Vinkla\Hashids\Facades\Hashids;

class IsUserFavoriteController extends ApiResponseController
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
     * @apiName            isUserFavorite
     * @api                {get} /api/category/{id}/is-user-favorite Is User Favorite
     * @apiDescription     Check if a category is favorite of a user
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {int} id the encoded category id
     */
    public function run($id)
    {
        $category = $this->categoryRepository->find(Hashids::decode($id));
        
        return response()->json([
            'status'     => true,
            'isFavorite' => $category->isFavorited(auth()->user()->id)
        ]);
    }
}