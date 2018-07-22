<?php

namespace App\ACME\Admin\User\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Tags\Tag;

class IndexUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function run()
    {
        $users = User::paginate();
        
        return view('admin.user.index', compact('users'));
    }
}
