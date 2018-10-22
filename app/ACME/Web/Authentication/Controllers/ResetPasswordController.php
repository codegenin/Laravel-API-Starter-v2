<?php


namespace App\ACME\Web\Authentication\Controllers;

use App\ACME\Api\V1\Authentication\Requests\ResetPasswordRequest;
use Config;
use App\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    
    use ResetsPasswords;
    
    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/reset/success';
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function showResetForm(Request $request, $token = null)
    {
        return view('web.authentication.reset-password')->with(
            [
                'token' => $token,
                'email' => $request->email
            ]
        );
    }
    
    public function resetSuccess()
    {
        return view('web.authentication.reset-success');
    }
}
