<?php

namespace App\ACME\Api\V1\Favorite\Controllers;

use App\ACME\Api\V1\Category\Resource\CategoryLimitedResource;
use App\ACME\Api\V1\Category\Resource\CategoryResource;
use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\ACME\Api\V1\Collection\Resource\CollectionLimitedResource;
use App\ACME\Api\V1\Collection\Resource\CollectionResource;
use App\ACME\Api\V1\Media\Resource\MediaResource;
use App\ACME\Api\V1\Media\Resource\MediaResourceCollection;
use App\ACME\Api\V1\User\Resource\UserResource;
use App\Http\Controllers\ApiResponseController;
use App\Models\Artist;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Media;
use App\Traits\MediaTraits;
use Spatie\MediaLibrary\MediaCollection\MediaCollection;

class ListCollectionFavoritesImagesController extends ApiResponseController
{
    use MediaTraits;
    
    /**
     * CollectionFavoriteController constructor.
     */
    public function __construct()
    {
        $this->middleware('jwt.auth', []);
    }
    
    /**
     * @apiGroup           Favorite
     * @apiName            listCollectionFavoriteImages
     * @api                {get} /api/favorite/collection-images List Collection Fav Images
     * @apiDescription     Get all images from all the collection favorites
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     *
     */
    public function run()
    {
        $favorites = CollectionLimitedResource::collection(auth()
            ->user()
            ->favorite(Collection::class));
        
        $images = [];
        
        
        if ($favorites->count() > 0) {
            
            $collections = [];
            
            foreach ($favorites as $favorite) {
                $collections[] = $favorite->id;
            }
            
            $images = Media::orWhereIn('model_id', $collections)
                           ->where('model_type', 'App\\Models\\Collection')
                           ->orderBy('created_at', 'desc')
                           ->paginate();
    
            return new MediaResourceCollection($images);
        }
        
        return response()->json([
            'status' => true,
            'images' => $images
        ]);
        
    }
}