<?php

namespace App\ACME\Api\V1\Collection\Controllers;


use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\ACME\Api\V1\Collection\Requests\CreateCollectionRequest;
use App\Http\Controllers\Controller;

class CreateCollectionController extends Controller
{
    /**
     * @var CollectionRepository
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
     * @apiName            newCollection
     * @api                {post} /api/collection/new Add A New Collection
     * @apiDescription     Store a new collection
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {int} category_id the id of the category the collection belongs
     * @apiParam {String} title the collection title
     * @apiParam {String} description all about the collection
     *
     */
    public function store(CreateCollectionRequest $request)
    {
        $collection = $this->collectionRepository->findByColumnsFirst([
            'slug'    => str_slug($request->title),
            'user_id' => auth()->user()->id
        ]);
        
        if ($collection) {
            return response()->json([
                'status'  => 'error',
                'message' => trans('collection.store.exists')
            ]);
        }
        
        $this->collectionRepository->create([
            'user_id'     => auth()->user()->id,
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'slug'        => $request->title,
            'description' => $request->description,
        ]);
        
        return response()->json([
            'status'  => 'ok',
            'message' => trans('collection.store.success')
        ]);
    }
}
