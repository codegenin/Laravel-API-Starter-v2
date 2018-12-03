<?php

namespace App\ACME\Api\V1\Favorite\Controllers;

use App\ACME\Api\V1\Category\Resource\CategoryLimitedResource;
use App\ACME\Api\V1\Category\Resource\CategoryResource;
use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\ACME\Api\V1\Collection\Resource\CollectionResource;
use App\ACME\Api\V1\Media\Resource\MediaResource;
use App\ACME\Api\V1\Media\Resource\MediaResourceCollection;
use App\ACME\Api\V1\User\Resource\UserResource;
use App\Http\Controllers\ApiResponseController;
use App\Models\Artist;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Media;
use App\Traits\CustomPaginationTrait;
use App\Traits\MediaTraits;
use Spatie\MediaLibrary\MediaCollection\MediaCollection;

class ListCategoryFavoritesImagesController extends ApiResponseController
{
    use MediaTraits,
        CustomPaginationTrait;
    
    /**
     *
     */
    public function __construct()
    {
        $this->middleware('jwt.auth', []);
    }
    
    /**
     * @apiGroup           Favorite
     * @apiName            listCategoryFavoriteImages
     * @api                {get} /api/favorite/category-images List Category Fav Images
     * @apiDescription     Get all images from all the category favorites
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     *
     */
    public function run()
    {
        $favorites = CategoryLimitedResource::collection(auth()
            ->user()
            ->favorite(Category::class));
        
        $images = [];
        
        if ($favorites->count() > 0) {
            
            $categories = [];
            
            foreach ($favorites as $favorite) {
                $categories[] = $favorite->id;
            }
            
            $images = Media::orWhereIn('category_id', $categories)
                ->where('model_type', 'App\\Models\\Collection')
                ->visible()
                ->inRandomOrder()
                ->paginate((request()->has('perPage')) ? request('perPage') : 50);
            
            return new MediaResourceCollection($images);
            
        }
        
        return response()->json([
            'status' => true,
            'data'   => $images
        ]);
        
    }
}