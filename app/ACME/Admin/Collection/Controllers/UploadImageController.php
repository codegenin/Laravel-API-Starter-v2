<?php

namespace App\ACME\Admin\Collection\Controllers;

use App\ACME\Admin\Collection\Requests\StoreCollectionRequest;
use App\ACME\Admin\Collection\Requests\UploadImageRequest;
use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\Http\Controllers\Controller;
use App\Traits\MediaTraits;

class UploadImageController extends Controller
{
    use MediaTraits;
    /**
     * @var CollectionRepository
     */
    private $collectionRepository;
    
    /**
     * StoreController constructor.
     * @param CollectionRepository $collectionRepository
     */
    public function __construct(CollectionRepository $collectionRepository)
    {
        $this->middleware('auth:admin');
        $this->collectionRepository = $collectionRepository;
    }
    
    public function run(UploadImageRequest $request)
    {
        $collection = $this->collectionRepository->find($request->id);
        
        if ($request->has('file')) {
            $media = $this->associateMedia($collection, $request, $collection->slug);
            $media->user_id     = 0;
            $media->title       = $request->title;
            $media->description = $request->description;
            $media->location    = $request->location;
            $media->attachTags(explode(',', $request->tags));
            $media->save();
        }
        
        return redirect()
            ->back()
            ->with('success', 'Request successfully processed!');
    }
}
