<?php

namespace App\ACME\Api\V1\Category\Controllers;

use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\ACME\Api\V1\Category\Resource\CategoryResource;
use App\ACME\Api\V1\Category\Resource\CategoryResourceCollection;
use App\Http\Controllers\Controller;
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
     * @apiGroup           User
     * @apiName            updateUserRole
     * @api                {post} /api/user/role-update Update Role
     * @apiDescription     Update user role
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {String} role choose between artist or patron role only
     * @apiParam {String} role choose between artist or patron role only
     *
     *
     * @apiSuccessExample {json} Success-Response:
     *                     {
     * "status": "ok",
     * "message": "Role has been updated successfully!"
     * }
     *
     */
    public function all()
    {
        $categories = $this->categoryRepository->all();
    
        return CategoryResource::collection($categories);
    }
}