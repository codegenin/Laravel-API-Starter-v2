<?php

namespace App\Api\V1\Authentication\Controllers;

use App\Api\V1\Authentication\Requests\LoginRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Auth;

class LoginController extends Controller
{
    /**
     * Log the user in
     *
     * @param LoginRequest $request
     * @param JWTAuth      $JWTAuth
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request, JWTAuth $JWTAuth)
    {
        $credentials = $request->only([
            'email',
            'password'
        ]);
        
        try {
            $token = Auth::guard()
                         ->attempt($credentials);
            
            if (!$token) {
                throw new AccessDeniedHttpException();
            }
            
        } catch (JWTException $e) {
            throw new HttpException(500);
        }
        
        // Checks if user is active
        $user = Auth::guard()
                    ->authenticate($token);
        
        if (!$user->is_active) {
            throw new AccessDeniedHttpException();
        }
        
        return response()
            ->json([
                'status' => 'ok',
                'data'   => [
                    'token' => $token,
                    'expires_in' => Auth::guard()
                                        ->factory()
                                        ->getTTL() * 60
                ]
            ]);
    }
}
