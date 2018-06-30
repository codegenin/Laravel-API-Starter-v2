<?php

namespace App\ACME\Admin\Category\Controllers;

use App\ACME\Admin\Category\Requests\StoreTagRequest;
use App\Models\Category;
use App\Traits\CategoryTraits;
use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\Traits\MediaTraits;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UpdateCategoryController extends Controller
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
     * @param StoreTagRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function run(StoreTagRequest $request)
    {
        $category                                    = $this->categoryRepository->find($request->id);
        $category->translateOrNew('en')->name        = $request->name;
        $category->translateOrNew('fr')->name        = $request->fr_name;
        $category->translateOrNew('en')->description = $request->description;
        $category->translateOrNew('fr')->description = $request->fr_description;
        $category->slug                              = str_slug($request->name);
        $category->is_public                         = $request->is_public;
        $category->parent_id                         = $request->parent_id;
        $category->save();
        
        if ($request->has('file')) {
            $this->associateMedia($category, $request, 'category');
            /*$category->media_id = $category->getMedia('category')
                                           ->first()->id;
            $category->save();*/
            
            sleep(2);
        }
        
        return redirect()
            ->back()
            ->with('success', 'Request successfully processed!');
    }
}
