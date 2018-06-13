<?php

namespace App\ACME\Api\V1\Media\Controllers;


use App\ACME\Api\V1\Collection\Repositories\MediaRepository;
use App\ACME\Api\V1\Collection\Requests\AddMediaToCollectionRequest;
use App\ACME\Api\V1\Collection\Requests\IncrementDecrementScoreRequest;
use App\Http\Controllers\ApiResponseController;
use App\Http\Controllers\Controller;
use App\Traits\MediaTraits;
use Vinkla\Hashids\Facades\Hashids;

class SearchByTagController extends ApiResponseController
{
    /**
     * @var MediaRepository
     */
    private $mediaRepository;
    
    /**
     * CreateCollectionController constructor.
     * @param MediaRepository $mediaRepository
     */
    public function __construct(MediaRepository $mediaRepository)
    {
        $this->middleware('jwt.auth', []);
        $this->mediaRepository = $mediaRepository;
    }
    
    /**
     * @apiGroup           Media
     * @apiName            searchByTag
     * @api                {post} /api/media/search-by-tag Search By Tag
     * @apiDescription     Decrement a image score
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {String} media_id the encoded id of the image
     * @apiParam {Int} score score to decrement - between 1 to 10
     *
     */
    public function run(IncrementDecrementScoreRequest $request)
    {
        try {
            $this->mediaRepository->decrement($request->media_id, $request->score);
        } catch (\Exception $e) {
            return $this->responseWithError(trans('common.not.found'));
        }
        
        return $this->responseWithSuccess(trans('media.decrement.success'));
    }
}
