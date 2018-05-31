<?php

namespace App\ACME\Admin\Authentication\Controllers;

use App\ACME\Api\V1\Authentication\Repositories\UserRepository;
use Config;
use App\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Http\Controllers\Controller;
class LoginController extends Controller
{
    public function __construct()
    {
    }
    
    public function login()
    {
        return view('admin.authentication.login');
    }
}
