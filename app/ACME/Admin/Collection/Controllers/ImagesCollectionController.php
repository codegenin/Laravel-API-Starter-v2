<?php

namespace App\ACME\Admin\Collection\Controllers;

use App\ACME\Admin\Collection\Requests\StoreCollectionRequest;
use App\ACME\Admin\Tag\Resource\TagResource;
use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Traits\MediaTraits;
use Psr\Log\InvalidArgumentException;
use Spatie\Tags\Tag;

class ImagesCollectionController extends Controller
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
        try {
            $collection = $this->collectionRepository->find($id, ['category']);
            $images     = Media::where('collection_name', $collection->slug)
                               ->get();
            $tags       = Tag::ordered()
                             ->get();
            
        } catch (\Exception $e) {
            throw new InvalidArgumentException($e);
        }
        
        return view('admin.collection.images')->with([
            'collection' => $collection,
            'images'     => $images,
            'tags'       => $tags
        ]);
    }
}
