<?php

namespace App\ACME\Admin\Category\Controllers;

use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psr\Log\InvalidArgumentException;
use Spatie\Tags\Tag;

class ListCollectionsController extends Controller
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    
    /**
     * ListImagesController constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->middleware('auth:admin');
        $this->categoryRepository = $categoryRepository;
    }
    
    public function run($id)
    {
        try {
            $collections = Collection::where('category_id', $id)
                                     ->orderBy('created_at', 'desc')
                                     ->paginate(10);
            
            $category   = Category::find($id);
            $categories = Category::orderBy('seq')
                                  ->where('parent_id', 0)
                                  ->get();
        } catch (\Exception $e) {
            throw new InvalidArgumentException($e);
        }
        
        return view('admin.collection.index')->with([
            'category'    => $category,
            'categories'  => $categories,
            'collections' => $collections
        ]);
        
    }
}
