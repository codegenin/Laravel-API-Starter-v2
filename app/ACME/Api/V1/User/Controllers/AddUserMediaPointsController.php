<?php

namespace App\ACME\Api\V1\User\Controllers;

use App\ACME\Api\V1\Media\Repositories\MediaRepository;
use App\ACME\Api\V1\Media\Requests\AddMediaUserPointRequest;
use App\ACME\Api\V1\Media\Resource\MediaResource;
use App\ACME\Api\V1\User\Repositories\UserRepository;
use App\Http\Controllers\ApiResponseController;
use App\Models\Media;
use App\Models\User;
use App\Traits\MediaTraits;
use Vinkla\Hashids\Facades\Hashids;

class AddUserMediaPointsController extends ApiResponseController
{
    use MediaTraits;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var MediaRepository
     */
    private $mediaRepository;
    
    /**
     * CreateCollectionController constructor.
     * @param UserRepository  $userRepository
     * @param MediaRepository $mediaRepository
     */
    public function __construct(UserRepository $userRepository, MediaRepository $mediaRepository)
    {
        $this->middleware('jwt.auth', []);
        $this->userRepository  = $userRepository;
        $this->mediaRepository = $mediaRepository;
    }
    
    /**
     * @apiGroup           User
     * @apiName            addPoints
     * @api                {post} /api/user/add-points Add User Points
     * @apiDescription     Add a point to a user when media is viewed
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {string} media_id the encoded id of the media
     * @apiParam {string} amount the amount of points to add
     *
     * @param AddMediaUserPointRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function run(AddMediaUserPointRequest $request)
    {
        $image = $this->mediaRepository->find(Hashids::decode($request->media_id));
        
        if (empty($image)) {
            return $this->responseWithError(trans('common.not_found'));
        };
        
        // Add user points
        $this->userRepository->increment($request->amount);
        $user = $this->userRepository->find(auth()->user()->id);
        
        return response()->json([
            'status'          => true,
            'previous_points' => auth()->user()->points,
            'new_points'      => $user->points
        ]);
    }
}
