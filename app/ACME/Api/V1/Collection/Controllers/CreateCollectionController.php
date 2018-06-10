<?php

namespace App\ACME\Api\V1\Collection\Controllers;


use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\ACME\Api\V1\Collection\Requests\CreateCollectionRequest;
use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Vinkla\Hashids\Facades\Hashids;

class CreateCollectionController extends ApiResponseController
{
    /**
     * @var CollectionRepository
     */
    private $collectionRepository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    
    /**
     * CreateCollectionController constructor.
     * @param CollectionRepository $collectionRepository
     * @param CategoryRepository   $categoryRepository
     */
    public function __construct(CollectionRepository $collectionRepository,
        CategoryRepository $categoryRepository)
    {
        $this->middleware('jwt.auth', []);
        $this->collectionRepository = $collectionRepository;
        $this->categoryRepository   = $categoryRepository;
    }
    
    /**
     * @apiGroup           Collection
     * @apiName            newCollection
     * @api                {post} /api/collection/new New Collection
     * @apiDescription     Store a new collection
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {int} category_id the encoded id of the category
     * @apiParam {String} title the collection title
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
            'description' => $request->description,
        ]);
        
        return $this->responseWithSuccess(trans('collection.store.success'));
    }
}
