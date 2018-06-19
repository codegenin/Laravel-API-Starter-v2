<?php

namespace App\ACME\Api\V1\Favorite\Controllers;

use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\Http\Controllers\ApiResponseController;
use App\Models\Category;
use Psr\Log\InvalidArgumentException;
use Vinkla\Hashids\Facades\Hashids;

class SetCategoryAsFavoriteController extends ApiResponseController
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    
    /**
     * CategoryFavoriteController constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->middleware('jwt.auth', []);
        $this->categoryRepository = $categoryRepository;
    }
    
    /**
     * @apiGroup           Favorite
     * @apiName            setCategoryAsFavorite
     * @api                {get} /api/favorite/{id}/category Set Category As Favorite
     * @apiDescription     Set a category as user favorite
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {String} id the encoded category id
     *
     */
    public function run($id)
    {
        try {
            $category = $this->categoryRepository->find(Hashids::decode($id));
            auth()
                ->user()
                ->toggleFavorite($category);
        } catch (\Exception $e) {
            throw new InvalidArgumentException($e);
        }
        
        return $this->responseWithSuccess(trans('favorite.category.success'));
        
    }
}