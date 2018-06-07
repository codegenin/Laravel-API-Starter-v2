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
                                 ->get();
        
        return view('admin.category.index')->with([
            'categories'         => $categories,
            'categoriesDropDown' => $allCategories
        ]);
    }
    
    /**
     * @param StoreCategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCategoryRequest $request)
    {
        $this->categoryRepository->create([
            'name'        => $request->name,
            'slug'        => $request->name,
            'description' => $request->description,
            'is_public'   => $request->is_public,
            'parent_id'   => $request->parent_id,
            'image_path'  => $request->image_path
        ]);
        
        return redirect()->back();
    }
    
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy()
    {
        $this->categoryRepository->delete(request()->id);
        
        return redirect()
            ->back()
            ->with('success');
    }
}
