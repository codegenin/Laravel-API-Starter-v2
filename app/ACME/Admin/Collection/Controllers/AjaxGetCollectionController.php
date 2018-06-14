<?php

namespace App\ACME\Admin\Collection\Controllers;

use App\ACME\Admin\Collection\Requests\StoreCollectionRequest;
use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Traits\MediaTraits;

class AjaxGetCollectionController extends Controller
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
    
    public function run($id)
    {
        $collection = Collection::findOrFail($id);
        $covers     = $this->getMedialUrls($collection, 'collection');
        
        return response()->json([
            'collection' => $collection,
            'covers'     => $covers
        ]);
    }
}
