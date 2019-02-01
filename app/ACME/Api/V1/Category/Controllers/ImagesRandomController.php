<?php

namespace App\ACME\Api\V1\Category\Controllers;

use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\ACME\Api\V1\Category\Requests\ImagesRandomRequest;
use App\ACME\Api\V1\Category\Resource\AdminCategoryResource;
use App\ACME\Api\V1\Category\Resource\CategoryResourceCollection;
use App\ACME\Api\V1\Collection\Resource\CollectionResource;
use App\ACME\Api\V1\Collection\Resource\CollectionResourceCollection;
use App\ACME\Api\V1\Media\Resource\MediaResource;
use App\ACME\Api\V1\Media\Resource\MediaResourceCollection;
use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Media;
use App\Traits\CustomPaginationTrait;
use Auth;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Vinkla\Hashids\Facades\Hashids;

class ImagesRandomController extends ApiResponseController
{
    use CustomPaginationTrait;
    
    protected $items = 50;
    
    private $categoryRepository;
    
    /**
     * CategoryListsController constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    
    /**
     * @apiGroup           Category
     * @apiName            imagesRandom
     * @api                {get} /api/category/{id}/random-images List Random Images
     * @apiDescription     Retrieve random images in the category
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {string} id the encoded category id
     * @apiParam {int} [page] the page number
     * @param ImagesRandomRequest $request
     * @param                     $id
     * @return MediaResourceCollection|mixed
     */
    public function run(ImagesRandomRequest $request, $id)
    {
        if (!$category = $this->categoryRepository->find(Hashids::decode($id))) {
            return $this->responseWithError(trans('common.not.found'));
        }
        
        $hideIds = !empty($request->hideIds) ? $request->hideIds : 0;
        
        /*$images = Media::whereHas('collection', function ($query) use ($category) {
            $query->where('category_id', $category->id);
        })->where('category_id', $category->id)
            ->visible()
            ->where('model_type', 'App\\Models\\Collection')
            ->whereNotIn('media.id', explode(",", $hideIds))
            ->inRandomOrder()
            ->paginate($this->items);*/
        
        $images = Media::whereHas('collection', function ($query) use ($category) {
            $query->where('category_id', $category->id);
        })->where('category_id', $category->id)
            ->visible()
            ->where('model_type', 'App\\Models\\Collection');
        
        $total = $images->count();
        
        $paginatedItems = $images
            ->whereNotIn('media.id', explode(",", $hideIds))
            ->inRandomOrder()->take($this->items)->get();
        
        //return new MediaResourceCollection($images);
        
        return response()->json([
            'status' => true,
            'data'   => MediaResource::collection($paginatedItems),
            'meta'   => [
                'current_page' => intval($request->page),
                'last_page'    => ceil($total / $this->items)
            ]
        ]);
        //return new MediaResourceCollection($paginator);
        
    }
}