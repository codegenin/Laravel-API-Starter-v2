<?php

namespace App\ACME\Api\V1\Category\Controllers;

use App\ACME\Api\V1\Category\Repositories\CategoryRepository;
use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\ACME\Api\V1\Collection\Resource\CollectionResourceCollection;
use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\Controller;
use App\Models\Collection;
use Auth;
use Psr\Log\InvalidArgumentException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Vinkla\Hashids\Facades\Hashids;

class ListCollectionsController extends ApiResponseController
{
    /**
     * @var CollectionRepository
     */
    private $collectionRepository;
    
    /**
     * CategoryListsController constructor.
     * @param CollectionRepository $collectionRepository
     */
    public function __construct(CollectionRepository $collectionRepository)
    {
        $this->middleware('jwt.auth', []);
        $this->collectionRepository = $collectionRepository;
    }
    
    /**
     * @apiGroup           Category
     * @apiName            listCollections
     * @api                {get} /api/category/{id}/collections List Collections
     * @apiDescription     Retrieve all collections of a category
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {string} id the encoded category id
     * @apiParam {int} [page] the page number
     */
    public function run($id)
    {
        try {
            $collections = $this->collectionRepository->getPublicCollectionsOfCategory($id)->paginate();
        } catch (\Exception $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
        
        return new CollectionResourceCollection($collections);
    }
}