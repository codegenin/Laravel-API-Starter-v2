<?php

namespace App\ACME\Api\V1\Collection\Controllers;


use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\ACME\Api\V1\Collection\Resource\CollectionResource;
use App\ACME\Api\V1\Media\Repositories\MediaRepository;
use App\ACME\Api\V1\Media\Resource\MediaResource;
use App\ACME\Api\V1\Media\Resource\MediaResourceCollection;
use App\ACME\Api\V1\Media\Resource\MediaResourceLimited;
use App\Http\Controllers\ApiResponseController;
use App\Models\Media;
use App\Traits\MediaTraits;
use Vinkla\Hashids\Facades\Hashids;

class ListImagesAndIsBookedController extends ApiResponseController
{
    use MediaTraits;
    
    /**
     * @var MediaRepository
     */
    private $collectionRepository;
    /**
     * @var MediaRepository
     */
    private $mediaRepository;
    
    /**
     * CreateCollectionController constructor.
     * @param CollectionRepository $collectionRepository
     * @param MediaRepository      $mediaRepository
     */
    public function __construct(CollectionRepository $collectionRepository, MediaRepository $mediaRepository)
    {
        $this->middleware('jwt.auth', []);
        $this->collectionRepository = $collectionRepository;
        $this->mediaRepository      = $mediaRepository;
    }
    
    /**
     * @apiGroup           Collection
     * @apiName            listImagesAndIsBooked
     * @api                {post} /api/collection/{id}/info/{image}/booked Collection Info and Image Is Booked
     * @apiDescription     Retrieve collection information and verify if image is booked
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {varchar} id the encoded collection id of a collection
     * @apiParam {varchar} image the encoded image id of a image
     *
     */
    public function run($id, $media)
    {
        if (!$collection = $this->collectionRepository->find(Hashids::decode($id))) {
            return $this->responseWithError(trans('common.not.found'));
        }
        
        if (!$media = $this->mediaRepository->find(Hashids::decode($media))) {
            return $this->responseWithError(trans('common.not.found'));
        }
        
        $images = $this->getImages($collection);
        
        //return new MediaResourceCollection($images);
        return response()->json([
            'status'            => true,
            'collection_info'   => new CollectionResource($collection),
            'collection_images' => MediaResourceLimited::collection($images),
            'is_booked'         => auth()
                ->user()
                ->isBooked($media)
        ]);
    }
    
    /**
     * @param $collection
     * @return mixed
     */
    private function getImages($collection)
    {
        $isPurchased = auth()
            ->user()
            ->hasPurchased($collection);
        
        $paginate = (!$isPurchased ? 1 : 1000);
        
        $mainImages = Media::with([
            'collection',
            'translations'
        ])
                           ->where('collection_name', $collection->slug)
                           ->orderBy('created_at', 'desc')
                           ->remember(1400)
                           ->take((!$isPurchased) ? 1 : '')
                           ->paginate($paginate);
        
        $relatedImages = $this->getRelatedImages($collection, $mainImages, $isPurchased);
        
        return ($relatedImages->count() > 0) ? $mainImages->merge($relatedImages) : $mainImages;
    }
    
    /**
     * @param $collection
     * @param $mainImages
     * @param $isPurchased
     * @return mixed
     */
    private function getRelatedImages($collection, $mainImages, $isPurchased)
    {
        $relatedImages = collect();
        
        if (!$isPurchased AND $mainImages->count() > 0) {
            
            $relatedImages = Media::with([
                'collection',
                'translations'
            ])
                                  ->where('collection_name', '!=', $collection->slug)
                                  ->where('model_type', '!=', 'App\Models\Category')
                                  ->whereHas('collection.translations', function ($query) use ($mainImages) {
                                      $query->whereOr('time_period', $mainImages[0]->collection->time_period);
                                  })
                                  ->whereHas('translations', function ($query) use ($mainImages) {
                                      $query->where('location', $mainImages[0]->location);
                                  })
                                  ->inRandomOrder()
                                  ->take(3)
                                  ->get();
        }
        
        return $relatedImages;
    }
    
}