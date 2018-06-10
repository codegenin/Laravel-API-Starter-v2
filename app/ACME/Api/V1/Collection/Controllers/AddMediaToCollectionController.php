<?php

namespace App\ACME\Api\V1\Collection\Controllers;


use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\ACME\Api\V1\Collection\Requests\AddMediaToCollectionRequest;
use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\Controller;
use App\Traits\MediaTraits;
use Vinkla\Hashids\Facades\Hashids;

class AddMediaToCollectionController extends ApiResponseController
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
     * @apiName            uploadImage
     * @api                {post} /api/collection/upload-image Upload Image
     * @apiDescription     Upload a image to a collection
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {String} collection_id the encoded id of a collection
     * @apiParam {String} title the collection title
     * @apiParam {String} during the year range of the image taken
     * @apiParam {File} file the image to be uploaded
     * @apiParam {String} location the country or location where the image come from
     *
     */
    public function run(AddMediaToCollectionRequest $request)
    {
        $id         = Hashids::decode($request->collection_id);
        $collection = $this->collectionRepository->find($id);
        
        if ($request->has('file')) {
            $media               = $this->associateMedia($collection, $request, $collection->slug);
            $media->title        = $request->title;
            $media->location     = $request->location;
            $media->during       = $request->during;
            $media->order_column = 1;
            $media->save();
        }
        
        return $this->responseWithSuccess(trans('collection.add.media.success'));
    }
}
