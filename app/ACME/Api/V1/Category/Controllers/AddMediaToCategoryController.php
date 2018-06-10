<?php

namespace App\ACME\Api\V1\Category\Controllers;


use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\ACME\Api\V1\Category\Requests\AddMediaToCategoryRequest;
use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\ACME\Api\V1\Collection\Requests\AddMediaToCollectionRequest;
use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\Controller;
use App\Traits\MediaTraits;
use Vinkla\Hashids\Facades\Hashids;

class AddMediaToCategoryController extends ApiResponseController
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
     * @apiName            uploadImage
     * @api                {post} /api/category/upload-image Upload Image
     * @apiDescription     Upload a image to a category
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {String} category_id the encoded id of a category
     * @apiParam {String} title the collection title
     * @apiParam {String} during the year range of the image taken
     * @apiParam {File} file the image to be uploaded
     * @apiParam {String} location the country or location where the image come from
     *
     */
    public function run(AddMediaToCategoryRequest $request)
    {
        $id       = Hashids::decode($request->category_id);
        $category = $this->categoryRepository->find($id);
        
        if ($request->has('file')) {
            $media = $this->associateMedia($category, $request, $category->slug);
            if (!$this->addMediaInformation($media, $request)) {
                return $this->responseWithError(trans('common.media.information.error'));
            }
        }
        
        return $this->responseWithSuccess(trans('category.add.media.success'));
    }
}
