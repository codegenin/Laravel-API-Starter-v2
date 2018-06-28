<?php

namespace App\ACME\Admin\Collection\Controllers;

use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\Traits\MediaTraits;
use App\Http\Controllers\Controller;

class DestroyCollectionController extends Controller
{
    use MediaTraits;
    
    /**
     * @var CollectionRepository
     */
    private $collectionRepository;
    
    /**
     * @param CollectionRepository $collectionRepository
     */
    public function __construct(CollectionRepository $collectionRepository)
    {
        $this->middleware('auth:admin');
        $this->collectionRepository = $collectionRepository;
    }
    
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function run()
    {
        $collection = $this->collectionRepository->find(request()->id);
        
        $this->collectionRepository->delete(request()->id);
        $collection->clearMediaCollection($collection->slug);
        
        return redirect()
            ->back()
            ->with('success', 'Request successfully processed!');
    }
}
