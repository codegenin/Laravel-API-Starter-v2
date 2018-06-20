<?php

namespace App\ACME\Api\V1\Media\Controllers;

use App\ACME\Api\V1\Media\Repositories\MediaRepository;
use App\ACME\Api\V1\Media\Resource\MediaResource;
use App\Http\Controllers\ApiResponseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;

class ViewImageController extends ApiResponseController
{
    private $mediaRepository;
    
    /**
     * MediaListsController constructor.
     * @param MediaRepository $mediaRepository
     */
    public function __construct(MediaRepository $mediaRepository)
    {
        $this->middleware('jwt.auth', []);
        $this->mediaRepository = $mediaRepository;
    }
    
    /**
     * @apiGroup           Media
     * @apiName            viewMedia
     * @api                {get} /api/media/{id}/show View Media
     * @apiDescription     Retrieve the media information
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {int} id the encoded media id
     */
    public function run($id)
    {
        $media = $this->mediaRepository->find(Hashids::decode($id));
        $media = collect(new MediaResource($media));
        
        return $this->responseWithResource($media->toArray());
    }
}
