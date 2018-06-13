<?php

namespace App\ACME\Api\V1\Collection\Controllers;


use App\ACME\Api\V1\Collection\Repositories\MediaRepository;
use App\ACME\Api\V1\Collection\Requests\CreateCollectionRequest;
use App\ACME\Api\V1\Media\Resource\MediaCollectionResource;
use App\ACME\Api\V1\Media\Resource\MediaResource;
use App\ACME\Api\V1\Media\Resource\MediaResourceCollection;
use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Traits\MediaTraits;
use Spatie\MediaLibrary\MediaCollection\MediaCollection;
use Vinkla\Hashids\Facades\Hashids;

class ListImagesController extends ApiResponseController
{
    use MediaTraits;
    
    /**
     * @var MediaRepository
     */
    private $collectionRepository;
    
    /**
     * CreateCollectionController constructor.
     * @param MediaRepository $collectionRepository
     */
    public function __construct(MediaRepository $collectionRepository)
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
        if (!$collection = $this->collectionRepository->find(Hashids::decode($id))) {
            return $this->responseWithError(trans('common.not.found'));
        }
        
        $images = Media::where('collection_name', $collection->slug)
                       ->sortable(['order_column' => 'desc'])
                       ->paginate();
        
        return MediaCollectionResource::collection($images);
    }
}
