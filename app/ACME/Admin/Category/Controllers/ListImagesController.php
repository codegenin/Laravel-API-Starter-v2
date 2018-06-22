<?php

namespace App\ACME\Admin\Category\Controllers;

use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psr\Log\InvalidArgumentException;
use Spatie\Tags\Tag;

class ListImagesController extends Controller
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
            $category = $this->categoryRepository->find($id);
            $images   = Media::where('category_id', $id)
                             ->sortable(['order_column' => 'desc'])
                             ->paginate();
            $tags     = Tag::ordered()
                           ->get();
        } catch (\Exception $e) {
            throw new InvalidArgumentException($e);
        }
        
        
        return view('admin.category.images')->with([
            'category' => $category,
            'images'   => $images,
            'tags'     => $tags
        ]);
        
    }
}
