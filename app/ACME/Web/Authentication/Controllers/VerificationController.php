<?php

namespace App\ACME\Web\Authentication\Controllers;

use App\ACME\Api\V1\Authentication\Repositories\UserRepository;
use Config;
use App\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Http\Controllers\Controller;
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
