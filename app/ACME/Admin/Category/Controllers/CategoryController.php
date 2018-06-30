<?php

namespace App\ACME\Admin\Category\Controllers;

use App\ACME\Admin\Category\Requests\StoreTagRequest;
use App\ACME\Admin\Category\Resource\AdminCategoryResource;
use App\ACME\Admin\Category\Resource\AdminCollectionResource;
use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\MediaTraits;
use Symfony\Component\Debug\Exception\FatalErrorException;

class CategoryController extends Controller
{
    use MediaTraits;
    
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    
    /**
     * Create a new AuthController instance.
     *
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->middleware('auth:admin');
        $this->categoryRepository = $categoryRepository;
    }
    
    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($id)
    {
        $category = $this->categoryRepository->find($id);
        
        return response()->json([
            'status'   => true,
            'category' => new AdminCategoryResource($category)
        ]);
    }
    
    /**
     * @param StoreTagRequest $request
     * @return array
     */
    private function prepareFields(StoreTagRequest $request)
    {
        return [
            'name'        => $request->name,
            'slug'        => str_slug($request->name),
            'description' => $request->description,
            'is_public'   => $request->is_public,
            'parent_id'   => $request->parent_id,
        ];
    }
}
