<?php

namespace App\ACME\Api\V1\Media\Controllers;

use App\ACME\Api\V1\Media\Resource\MediaResource;
use App\ACME\Api\V1\User\Repositories\UserRepository;
use App\Http\Controllers\ApiResponseController;
use App\Models\Media;
use App\Traits\MediaTraits;
use Vinkla\Hashids\Facades\Hashids;

class ListRelatedImagesController extends ApiResponseController
{
    use MediaTraits;
    
    public function __construct()
    {
        $this->middleware('jwt.auth', []);
    }
    
    /**
     * @apiGroup           Media
     * @apiName            ListRelatedImagesController
     * @api                {get} /api/media/user/{id}/images List User Images
     * @apiDescription     List all images uploaded by the user
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {string} location the image location
     */
    public function run($location)
    {
        $imageByLocation = Media::whereTranslation('location', $location)
                                ->first();
        
        if(empty($imageLocation)) {
        
        }
        
        return MediaResource::collection($images);
    }
    
    protected function imagesByLocation($location)
    {
    
    }
}
