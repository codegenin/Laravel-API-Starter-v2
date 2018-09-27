<?php

namespace App\ACME\Admin\Authentication\Controllers;

use App\ACME\Api\V1\Authentication\Requests\LoginRequest;
use App\ACME\Helpers\IPHelper;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }
    
    public function showLoginForm()
    {
        return view('admin.authentication.login');
    }
    
    public function login(LoginRequest $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required|min:6'
        ]);
        
        $credentials = $request->only([
            'email',
            'password'
        ]);
        
        if (Auth::guard('admin')
                ->attempt($credentials, $request->remember)
        ) {
            
            Log::info("LOGGED_ADMIN: {$request->email} IP: " . IPHelper::get_client_ip_server());
            
            return redirect()->intended(route('admin.dashboard'));
        }
        
        return redirect()
            ->back()
            ->withInput($request->only('email', 'password'));
        
    }
}
