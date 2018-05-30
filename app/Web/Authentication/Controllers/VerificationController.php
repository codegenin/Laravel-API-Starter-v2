<?php

namespace App\Web\Authentication\Controllers;

use App\Api\V1\Authentication\Repositories\RegisterRepository;
use App\Api\V1\Authentication\Repositories\UserRepository;
use App\Api\V1\Authentication\Requests\SignUpRequest;
use App\Jobs\SendVerificationEmail;
use Config;
use App\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;

class VerificationController extends Controller
{
    /**
     * @apiGroup           Authentication
     * @apiName            VerifyUser
     * @api                {get} /api/auth/verify/{token} Verify User
     * @apiDescription     Verify a user registration
     *
     * @apiVersion         1.0.0
     * @apiPermission      none
     *
     * @apiParam {String} token the token that was sent to the user
     *
     * @apiSuccessExample {json} Success-Response:
     *                     { "status": "ok"}
     */
    public function verify($token)
    {
        $userRepo = new UserRepository();
        
        if (!$user = $userRepo->findByColumnsFirst([
            'is_active'          => 0,
            'verification_token' => $token
        ])) {
            throw new NotFoundHttpException();
        }
        
        // Update user record
        $userRepo->update($user->id, [
            'is_active'          => 1,
            'verification_token' => null
        ]);
    
        return view('Authentication.Views.Verification.EmailConfirmation');
        
    }
}
