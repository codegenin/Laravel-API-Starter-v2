<?php

namespace App\ACME\Api\V1\Like\Controllers;

use App\ACME\Api\V1\Collection\Repositories\CollectionRepository;
use App\ACME\Api\V1\Collection\Resource\CollectionResource;
use App\ACME\Api\V1\Media\Resource\MediaResource;
use App\Http\Controllers\ApiResponseController;
use App\Models\Collection;
use App\Models\Media;
use App\Models\User;
use Psr\Log\InvalidArgumentException;
use Vinkla\Hashids\Facades\Hashids;

class ListUserLikesController extends ApiResponseController
{
    /**
     */
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
    
    /**
     * @apiGroup           Like
     * @apiName            userLikes
     * @api                {get} /api/like/user-likes List User Likes
     * @apiDescription     List All User Likes
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     */
    public function run()
    {
        $media = MediaResource::collection(auth()
            ->user()
            ->like(Media::class));
        
        return response()->json([
            'status'      => true,
            'media' => $media,
        ]);
    }
}