<?php

namespace App\ACME\Api\V1\Media\Controllers;

use App\ACME\Api\V1\Media\Resource\MediaResource;
use App\Http\Controllers\ApiResponseController;
use App\Models\Media;
use App\Traits\MediaTraits;
use Vinkla\Hashids\Facades\Hashids;

class ListUserImagesController extends ApiResponseController
{
    use MediaTraits;
    
    /**
     * CreateCollectionController constructor.
     */
    public function __construct()
    {
        $this->middleware('jwt.auth', []);
    }
    
    /**
     * @apiGroup           Media
     * @apiName            listUserImages
     * @api                {get} /api/media/user-images List User Images
     * @apiDescription     List all images uploaded by the user
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     *
     */
    public function run()
    {
        $images = Media::where('user_id', auth()->user()->id)
                       ->sortable(['order_column' => 'desc'])
                       ->paginate();
        
        return MediaResource::collection($images);
    }
}
