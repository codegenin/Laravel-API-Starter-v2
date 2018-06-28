<?php

namespace App\ACME\Admin\Category\Controllers;

use App\ACME\Admin\Category\Requests\StoreCategoryRequest;
use App\ACME\Admin\Category\Resource\AdminCategoryResource;
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
     * @return $this
     */
    public function index()
    {
        $categories    = Category::orderBy('seq', 'desc')
                                 ->paginate(10);
        $allCategories = Category::orderBy('seq')
                                 ->where('parent_id', 0)
                                 ->get();
        
        return view('admin.category.index')->with([
            'categories'         => $categories,
            'categoriesDropDown' => $allCategories
        ]);
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        $category = $this->categoryRepository->find(request()->id);
        
        $this->categoryRepository->delete(request()->id);
        $category->clearMediaCollection('category');
        
        // Delete collection images
        if ($category->collections->count() > 0) {
            foreach ($category->collections as $collection) {
                $collection->delete();
                $collection->clearMediaCollection($category->slug);
            }
        }
        
        return redirect()
            ->back()
            ->with('success', 'Request successfully processed!');
    }
    
    /**
     * @param StoreCategoryRequest $request
     * @return array
     */
    private function prepareFields(StoreCategoryRequest $request)
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
