<?php

namespace App\ACME\Admin\Collection\Controllers;

use App\ACME\Admin\Category\Requests\StoreCollectionRequest;
use App\ACME\Admin\Category\Requests\UploadCoverImageRequest;
use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Collection;
use App\Traits\MediaTraits;
use Psr\Log\InvalidArgumentException;
use Symfony\Component\Debug\Exception\FatalErrorException;

class IndexController extends Controller
{
    use MediaTraits;
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function run()
    {
        try {
            $collections = Collection::with('category')
                                     ->orderBy('created_at', 'desc')
                                     ->get();
            $categories  = Category::orderBy('seq')
                                   ->where('parent_id', 0)
                                   ->get();
        } catch (\Exception $e) {
            throw new InvalidArgumentException($e);
        }
        
        return view('admin.collection.index')->with([
            'categories'  => $categories,
            'collections' => $collections
        ]);
    }
}
