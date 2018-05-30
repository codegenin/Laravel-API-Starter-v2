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
