<?php

namespace App\ACME\Api\V1\Report\Controllers;

use App\ACME\Api\V1\Media\Repositories\MediaRepository;
use App\ACME\Api\V1\User\Repositories\UserRepository;
use App\Http\Controllers\ApiResponseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;

class ReportMediaController extends ApiResponseController
{
    /**
     * @var MediaRepository
     */
    private $mediaRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    
    /**
     * ReportMediaController constructor.
     * @param MediaRepository $mediaRepository
     * @param UserRepository  $userRepository
     */
    public function __construct(MediaRepository $mediaRepository, UserRepository $userRepository)
    {
        $this->mediaRepository = $mediaRepository;
        $this->userRepository = $userRepository;
    }
    
    /**
     * @apiGroup           Report
     * @apiName            ReportImage
     * @api                {get} /api/report/{id}/image Report A Image
     * @apiDescription     Report a offensive image
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {String} id the encoded media id
     *
     */
    public function run($id)
    {
        $media = $this->mediaRepository->findOrFail(Hashids::decode($id));
    
        // Checks if the media has been liked already
        if (auth()
            ->user()
            ->hasReported($media)) {
        
            return $this->responseWithSuccess(trans('report.success'));
        }
    
        auth()
            ->user()
            ->addReport($media);
        
    
        return $this->responseWithSuccess(trans('report.success'));
    }
}
