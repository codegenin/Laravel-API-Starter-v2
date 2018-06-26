<?php

namespace App\ACME\Api\V1\User\Controllers;

use App\ACME\Api\V1\User\Repositories\UserRepository;
use App\ACME\Api\V1\User\Resource\UserResource;
use App\Http\Controllers\ApiResponseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Psr\Log\InvalidArgumentException;
use Vinkla\Hashids\Facades\Hashids;

class ViewUserController extends ApiResponseController
{
    private $userRepository;
    
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('jwt.auth', []);
        $this->userRepository = $userRepository;
    }
    
    /**
     * @apiGroup           User
     * @apiName            viewUser
     * @api                {get} /api/user/{id}/show View User
     * @apiDescription     Retrieve the user information
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {int} id the encoded user id
     * @apiSuccessExample {json} Success-Response:
     * {"status":true,"id":"Yx3WVBlkw697rJjZznqg2oab","name":"The First Patron","email":"patron@patron.com","role":"patron","contact_email":"","about":"Ut accusamus sequi molestiae deleniti aut qui. Repellendus blanditiis facere sed non vel. Corrupti alias et magni et unde et.","birthday":"1981-03-17","website":"https:\/\/abshire.com\/sed-sed-fugit-autem-eum-blanditiis-nihil-tempora-magnam.html","phone":"","location":"","remarks":"","avatar":{"original":"https:\/\/yyg-test-collections.s3.amazonaws.com\/1\/sample.jpg","large":"https:\/\/yyg-test-collections.s3.amazonaws.com\/1\/conversions\/sample-large.jpg","medium":"https:\/\/yyg-test-collections.s3.amazonaws.com\/1\/conversions\/sample-medium.jpg","small":"https:\/\/yyg-test-collections.s3.amazonaws.com\/1\/conversions\/sample-small.jpg"}}
     */
    public function run($id)
    {
        try {
            $user = $this->userRepository->find( Hashids::decode($id));
        } catch (\Exception $e) {
            throw new InvalidArgumentException(trans('common.not.found'));
        }
        
        $user = collect(new UserResource($user));
        
        return $this->responseWithResource($user->toArray());
    }
}
