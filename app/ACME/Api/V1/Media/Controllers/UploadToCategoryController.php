<?php

namespace App\ACME\Api\V1\Media\Controllers;


use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\ACME\Api\V1\Category\Requests\AddMediaToCategoryRequest;
use App\ACME\Api\V1\Collection\Repositories\MediaRepository;
use App\ACME\Api\V1\Collection\Requests\AddMediaToCollectionRequest;
use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\Controller;
use App\Traits\MediaTraits;
use Vinkla\Hashids\Facades\Hashids;

class UploadToCategoryController extends ApiResponseController
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
     * @apiGroup           Media
     * @apiName            uploadImage
     * @api                {post} /api/media/upload-image Upload Image
     * @apiDescription     Upload a image to a category
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {String} category_id the encoded id of a category
     * @apiParam {String} title the collection title
     * @apiParam {String} description about the image
     * @apiParam {File} file the image to be uploaded
     * @apiParam {String} location the country or location where the image come from
     * @apiParam {String} tags list of tags separated with comma e.g. Tag1, Tag2, Tag3
     *
     */
    public function run(AddMediaToCategoryRequest $request)
    {
        $id       = Hashids::decode($request->category_id);
        $category = $this->categoryRepository->find($id);
        
        if ($request->has('file')) {
            $media = $this->associateMedia($category, $request, $category->name);
            if (!$this->addMediaInformation($media, $request, $category->id)) {
                return $this->responseWithError(trans('common.media.information.error'));
            }
        }
        
        return $this->responseWithSuccess(trans('category.add.media.success'));
    }
}
