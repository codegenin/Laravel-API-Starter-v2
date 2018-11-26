<?php

namespace App\ACME\Admin\Role\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Tags\Tag;

class IndexRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function __invoke()
    {
        $roles = new Role();
        $roles->with('users', 'permissions')
            ->orderBy('id', 'asc')
            ->paginate(25);
        
        dd($roles);
        return view('admin.user.index')->withRoles($roles);
    }
}
