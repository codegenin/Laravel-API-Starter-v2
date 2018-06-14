<?php

namespace App\ACME\Admin\Collection\Controllers;

use App\ACME\Admin\Collection\Requests\StoreCollectionRequest;
use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\Http\Controllers\Controller;
use App\Traits\MediaTraits;

class UpdateController extends Controller
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
        $this->collectionRepository->update($request->id, [
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'slug'        => $request->title,
            'description' => $request->description,
            'time_period' => $request->time_period
        ]);
        
        if ($request->has('file')) {
            $this->associateMedia($collection, $request, 'collection');
        }
        
        return redirect()
            ->back()
            ->with('success', 'Request successfully processed!');
    }
}
