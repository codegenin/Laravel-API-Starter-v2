<?php

namespace App\ACME\Api\V1\Category\Controllers;


use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\ACME\Api\V1\Collection\Repositories\MediaRepository;
use App\ACME\Api\V1\Collection\Requests\CreateCollectionRequest;
use App\ACME\Api\V1\Media\Resource\MediaCategoryResource;
use App\ACME\Api\V1\Media\Resource\MediaResource;
use App\ACME\Api\V1\Media\Resource\MediaResourceCollection;
use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Traits\MediaTraits;
use Vinkla\Hashids\Facades\Hashids;

class ListImagesController extends ApiResponseController
{
    use MediaTraits;
    
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    
    /**
     * CreateCollectionController constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->middleware('jwt.auth', []);
        $this->categoryRepository = $categoryRepository;
    }
    
    /**
     * @apiGroup           Category
     * @apiName            listImages
     * @api                {get} /api/category/{id}/images List Images
     * @apiDescription     Retrieve all images of a category
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {int} category_id the encoded id of a category
     *
     */
    public function run($id)
    {
        if (!$category = $this->categoryRepository->find(Hashids::decode($id))) {
            return $this->responseWithError(trans('common.not.found'));
        }
        
        $images = Media::where('category_id', $category->id)
                       ->where('model_type', 'App\\Models\\Collection')
                       ->inRandomOrder()
                       ->paginate();
        
        return new MediaResourceCollection($images);
    }
}
