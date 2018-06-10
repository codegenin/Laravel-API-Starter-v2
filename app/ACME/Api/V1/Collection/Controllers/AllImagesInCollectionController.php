<?php

namespace App\ACME\Api\V1\Collection\Controllers;


use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\ACME\Api\V1\Collection\Requests\CreateCollectionRequest;
use App\ACME\Api\V1\Media\Resource\MediaResourceCollection;
use App\Http\Controllers\Controller;
use App\Traits\MediaTraits;
use Vinkla\Hashids\Facades\Hashids;

class AllImagesInCollectionController extends Controller
{
    use MediaTraits;
    
    /**
     * @var CollectionRepository
     */
    private $collectionRepository;
    
    /**
     * CreateCollectionController constructor.
     * @param CollectionRepository $collectionRepository
     */
    public function __construct(CollectionRepository $collectionRepository)
    {
        $this->middleware('jwt.auth', []);
        $this->collectionRepository = $collectionRepository;
    }
    
    /**
     * @apiGroup           Collection
     * @apiName            collectionImages
     * @api                {post} /api/collection/{id}/images Collection Images
     * @apiDescription     Retrieve all images of a collection
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {int} collection_id the encoded id of a collection
     *
     */
    public function run($id)
    {
        $id         = Hashids::decode($id);
        $collection = $this->collectionRepository->find($id);
        $images     = $collection->getMedia($collection->slug);
        $media      = [];
        
        foreach ($images as $key => $image) {
            $media[$key]['id']       = Hashids::encode($image->id);
            $media[$key]['title']    = $image->title;
            $media[$key]['location'] = $image->location;
            $media[$key]['during']   = $image->during;
            $media[$key]['images']   = $this->getMedialUrls($collection, $image->collection_name);
        }
        
        return response()->json([
            'data'   => $media,
            'status' => 'ok'
        ]);
    }
}