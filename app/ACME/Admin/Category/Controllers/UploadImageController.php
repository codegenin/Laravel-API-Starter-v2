<?php

namespace App\ACME\Admin\Category\Controllers;

use App\ACME\Admin\Category\Requests\StoreCategoryRequest;
use App\ACME\Admin\Category\Requests\UploadImageRequest;
use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\Http\Controllers\Controller;
use App\Traits\MediaTraits;

class UploadImageController extends Controller
{
    use MediaTraits;
    /**
     * @var CategoryRepository
     */
    private $collectionRepository;
    
    /**
     * StoreController constructor.
     * @param CategoryRepository $collectionRepository
     */
    public function __construct(CategoryRepository $collectionRepository)
    {
        $this->middleware('auth:admin');
        $this->collectionRepository = $collectionRepository;
    }
    
    public function run(UploadImageRequest $request)
    {
        $collection = $this->collectionRepository->find($request->id);
        
        if ($request->has('file')) {
            $media              = $this->associateMedia($collection, $request, $collection->slug);
            $media->category_id = $collection->category_id;
            $media->user_id     = 0;
            $media->title       = $request->title;
            $media->description = $request->description;
            $media->location    = $request->location;
            $media->syncTags($request->tags);
            $media->save();
        }
        
        sleep(2); // delay 5secs the redirect so queue system can work first :D
        
        return redirect()
            ->back()
            ->with('success', 'Request successfully processed!');
    }
}
