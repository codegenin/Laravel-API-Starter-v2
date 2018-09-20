<?php

namespace App\ACME\Api\V1\Like\Controllers;

use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\ACME\Api\V1\Collection\Resource\CollectionResource;
use App\ACME\Api\V1\Media\Resource\MediaResource;
use App\Http\Controllers\ApiResponseController;
use App\Models\Collection;
use App\Models\Media;
use App\Models\User;
use App\Traits\CustomPaginationTrait;
use Psr\Log\InvalidArgumentException;
use Vinkla\Hashids\Facades\Hashids;

class ListUserBooksController extends ApiResponseController
{
    use CustomPaginationTrait;
    
    /**
     */
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
    
    /**
     * @apiGroup           Like
     * @apiName            userBook
     * @api                {get} /api/like/user-book List User Book
     * @apiDescription     List All User Book Images
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     */
    public function run()
    {
        $media = MediaResource::collection(auth()
            ->user()
            ->book(Media::class));
        
        $total = auth()
            ->user()
            ->bookCount(Media::class);
        
        return response()->json([
            'status' => true,
            'media'  => $media,
            'links'  => [
                'next' => $this->nextPageUrl($total)
            ]
        ]);
    }
}