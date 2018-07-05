<?php

namespace App\ACME\Api\V1\Like\Controllers;

use App\ACME\Api\V1\Media\Repositories\MediaRepository;
use App\Http\Controllers\ApiResponseController;
use App\Models\User;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;

class LikeMediaController extends ApiResponseController
{
    /**
     * @var MediaRepository
     */
    private $mediaRepository;
    
    /**
     * LikeMediaController constructor.
     * @param MediaRepository $mediaRepository
     */
    public function __construct(MediaRepository $mediaRepository)
    {
        $this->middleware('jwt.auth');
        $this->mediaRepository = $mediaRepository;
    }
    
    /**
     * @apiGroup           Like
     * @apiName            likeImage
     * @api                {get} /api/like/{id}/image Like A Image
     * @apiDescription     Like an image to earn points
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {String} id the encoded media id
     *
     */
    public function run($id)
    {
        $media = $this->mediaRepository->find(Hashids::decode($id));
        
        // Checks if the media has been liked already
        if(auth()->user()->hasLiked($media)) {
            auth()
                ->user()
                ->addBook($media);
            return $this->responseWithSuccess(trans('like.success'));
        }
    
        auth()
            ->user()
            ->addLike($media);
    
        // Add user points
        $user = User::find(auth()->user()->id);
        $user->points = $user->points + 1;
        $user->save();
        
        return $this->responseWithSuccess(trans('like.success'));
        
    }
}