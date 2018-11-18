<?php

namespace App\ACME\Admin\User\Controllers;

use App\ACME\Search\User\UserSearch;
use App\Http\Controllers\Controller;

class SearchUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function __invoke()
    {
        $users = UserSearch::apply(\request());
        
        return view('admin.user.index', compact('users'));
    }
}
