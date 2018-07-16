<?php

namespace App\ACME\Admin\Collection\Controllers;

use App\ACME\Admin\Collection\Requests\StoreCollectionRequest;
use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\Http\Controllers\Controller;
use App\Traits\MediaTraits;

class UpdateCollectionController extends Controller
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
    
    public function run(StoreCollectionRequest $request)
    {
        $collection = $this->collectionRepository->find($request->id);
        
        $collection->translateOrNew('en')->title       = $request->title;
        $collection->translateOrNew('fr')->title       = $request->fr_title;
        $collection->translateOrNew('en')->description = $request->description;
        $collection->translateOrNew('fr')->description = $request->fr_description;
        $collection->translateOrNew('en')->time_period = $request->time_period;
        $collection->translateOrNew('fr')->time_period = $request->fr_time_period;
        
        $collection->category_id = $request->category_id;
        $collection->slug        = $request->title;
        $collection->artist      = $request->artist;
        $collection->points      = $request->points;
        $collection->save();
        
        if ($request->has('file')) {
            $this->associateMedia($collection, $request, 'collection');
            sleep(2);
        }
        
        return redirect()
            ->back()
            ->with('success', 'Request successfully processed!');
    }
}
