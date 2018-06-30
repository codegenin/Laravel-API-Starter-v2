<?php

namespace App\ACME\Admin\Category\Controllers;

use App\ACME\Admin\Category\Requests\StoreTagRequest;
use App\Models\Category;
use App\Traits\CategoryTraits;
use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\Traits\MediaTraits;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DestroyCategoryController extends Controller
{
    use CategoryTraits, MediaTraits;
    
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    
    /**
     * StoreCategoryController constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->middleware('auth:admin');
        $this->categoryRepository = $categoryRepository;
    }
    
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function run()
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
}
