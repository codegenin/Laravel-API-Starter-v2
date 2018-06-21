<?php

namespace App\ACME\Api\V1\Media\Controllers;

use App\ACME\Api\V1\Media\Resource\MediaResource;
use App\ACME\Api\V1\User\Repositories\UserRepository;
use App\Http\Controllers\ApiResponseController;
use App\Models\Media;
use App\Traits\MediaTraits;
use Vinkla\Hashids\Facades\Hashids;

class ListUserImagesController extends ApiResponseController
{
    use MediaTraits;
    /**
     * @var UserRepository
     */
    private $userRepository;
    
    /**
     * CreateCollectionController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('jwt.auth', []);
        $this->userRepository = $userRepository;
    }
    
    /**
     * @apiGroup           Media
     * @apiName            listUserImages
     * @api                {get} /api/media/user/{id}/images List User Images
     * @apiDescription     List all images uploaded by the user
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     *
     */
    public function run($id)
    {
        $images = Media::where('user_id', Hashids::decode($id))
                       ->sortable(['order_column' => 'desc'])
                       ->paginate();
        
        return MediaResource::collection($images);
    }
}
