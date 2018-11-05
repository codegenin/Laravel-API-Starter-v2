<?php

namespace App\ACME\Api\V1\Collection\Controllers;


use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\ACME\Api\V1\Media\Repositories\MediaRepository;
use App\ACME\Api\V1\Media\Resource\MediaResourceCollection;
use App\Http\Controllers\ApiResponseController;
use App\Models\Media;
use App\Traits\MediaTraits;
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
     * @param CollectionRepository $collectionRepository
     */
    public function __construct(CollectionRepository $collectionRepository)
    {
        $this->middleware('jwt.auth', []);
        $this->collectionRepository = $collectionRepository;
    }
    
    /**
     * @apiGroup           Collection
     * @apiName            listImages
     * @api                {post} /api/collection/{id}/images List Images
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
        
        $images = $this->getImages($collection);
        
        return new MediaResourceCollection($images);
    }
    
    /**
     * @param $collection
     * @return mixed
     */
    private function getImages($collection)
    {
        $mainImages = Media::with([
            'collection',
            'translations'
        ])
                           ->where('collection_name', $collection->slug)
                           ->orderBy('created_at', 'desc')
                           ->remember(1400)
                           ->take(1);
        
        $relatedImages = $this->getRelatedImages($collection, $mainImages);
        
        return ($relatedImages->count() > 0) ? $mainImages->merge($relatedImages) : $mainImages;
    }
    
    /**
     * @param $collection
     * @param $mainImages
     * @param $isPurchased
     * @return mixed
     */
    private function getRelatedImages($collection, $mainImages)
    {
        $relatedImages = collect();
        
        if ($mainImages->count() > 0) {
            $relatedImages = Media::with([
                'collection',
                'translations'
            ])
                                  ->where('collection_name', '!=', $collection->slug)
                                  ->where('model_type', '!=', 'App\Models\Category')
                                  ->whereHas('translations', function ($query) use ($mainImages) {
                                      $query->orWhere('location', $mainImages[0]->location);
                                  })
                                  ->whereHas('collection.translations', function ($query) use ($mainImages) {
                                      $query->orWhere('time_period', $mainImages[0]->collection->time_period);
                                  })
                                  ->whereHas('collection', function ($query) use ($collection) {
                                      $query->orWhere('category_id', $collection->category_id);
                                  })
                                  ->inRandomOrder()
                                  ->remember(1400)
                                  ->take(3)
                                  ->get();
        }
        
        return $relatedImages;
    }
    
}
