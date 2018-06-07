<?php

namespace App\ACME\Admin\Category\Controllers;

use App\ACME\Admin\Category\Requests\StoreCategoryRequest;
use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Symfony\Component\Debug\Exception\FatalErrorException;

class CategoryController extends Controller
{
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
        $categories    = Category::orderBy('seq')
                                 ->renderAsArray();
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
            'category' => $category
        ]);
    }
    
    public function update(StoreCategoryRequest $request)
    {
        $this->categoryRepository->update($request->id, $this->prepareFields($request));
        
        return redirect()
            ->back()
            ->with('success', 'Request successfully processed!');;
    }
    
    /**
     * @param StoreCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCategoryRequest $request)
    {
        $this->categoryRepository->create($this->prepareFields($request));
        
        return redirect()
            ->back()
            ->with('success', 'Request successfully processed!');;
    }
    
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        $this->categoryRepository->delete(request()->id);
        
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
            'slug'        => $request->name,
            'description' => $request->description,
            'is_public'   => $request->is_public,
            'parent_id'   => $request->parent_id,
            'image_path'  => $request->image_path
        ];
    }
}
