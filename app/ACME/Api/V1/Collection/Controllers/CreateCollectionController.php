<?php

namespace App\ACME\Api\V1\Collection\Controllers;


use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\ACME\Api\V1\Collection\Repositories\MediaRepository;
use App\ACME\Api\V1\Collection\Requests\CreateCollectionRequest;
use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Vinkla\Hashids\Facades\Hashids;

class CreateCollectionController extends ApiResponseController
{
    /**
     * @var MediaRepository
     */
    private $collectionRepository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    
    /**
     * CreateCollectionController constructor.
     * @param MediaRepository    $collectionRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(MediaRepository $collectionRepository,
        CategoryRepository $categoryRepository)
    {
        $this->middleware('jwt.auth', []);
        $this->collectionRepository = $collectionRepository;
        $this->categoryRepository   = $categoryRepository;
    }
    
    /**
     * @apiGroup           Collection
     * @apiName            createCollection
     * @api                {post} /api/collection/new Create Collection
     * @apiDescription     Store a new collection
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {int} category_id the encoded id of the category
     * @apiParam {String} title the collection title
     * @apiParam {String} description all about the collection
     * @apiParam {int} year_start the year the collection started
     * @apiParam {int} year_end the year the collection ended
     * @apiParam {String} description all about the collection
     *
     */
    public function run(CreateCollectionRequest $request)
    {
        // Make sure category exist in the table
        try {
            $category = $this->categoryRepository->find(Hashids::decode($request->category_id));
        } catch (\Exception $e) {
            return $this->responseWithError(trans('category.not.found.error'));
        }
        
        if ($this->collectionRepository->findByColumnsFirst([
            'slug'    => str_slug($request->title),
            'user_id' => auth()->user()->id
        ])) {
            return $this->responseWithError(trans('collection.store.exists'));
        }
        
        $this->collectionRepository->create([
            'user_id'     => auth()->user()->id,
            'category_id' => $category->id,
            'title'       => $request->title,
            'slug'        => $request->title,
            'year_start'  => $request->year_start,
            'year_end'    => $request->year_end,
            'description' => $request->description,
        ]);
        
        return $this->responseWithSuccess(trans('collection.store.success'));
    }
}
