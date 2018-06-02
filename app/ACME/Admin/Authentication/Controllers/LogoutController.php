<?php

namespace App\ACME\Admin\Authentication\Controllers;

use App\Http\Controllers\Controller;
use Auth;

class LogoutController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::guard('admin')
            ->logout();
        
        return redirect()->route('admin.auth.get.login');
    }
}
