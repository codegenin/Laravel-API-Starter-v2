<?php

namespace App\ACME\Api\V1\Report\Controllers;

use App\ACME\Api\V1\Media\Repositories\MediaRepository;
use App\ACME\Api\V1\User\Repositories\UserRepository;
use App\Http\Controllers\ApiResponseController;
use App\Models\Admin;
use App\Models\Report;
use App\Notifications\Report\MediaReported;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
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
        
        if(!$media) {
            return $this->responseWithError(trans('report.record_not_found'));
        }
        
        // Checks if the media has been liked already
        if (Report::where('reportable_id', $media->id)->exists()) {
            return $this->responseWithSuccess(trans('report.success_already'));
        }
    
        auth()
            ->user()
            ->addReport($media);
    
        // Notify support
        Notification::route('mail', 'support@arture.app')
                    ->notify(new MediaReported($media, auth()->user()));
        
        return $this->responseWithSuccess(trans('report.success'));
    }
}
