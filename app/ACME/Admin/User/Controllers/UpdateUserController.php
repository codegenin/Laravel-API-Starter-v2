<?php

namespace App\ACME\Admin\User\Controllers;

use App\ACME\Admin\Tag\Requests\StoreTagRequest;
use App\ACME\Admin\User\Requests\UpdateUserRequest;
use App\Http\Controllers\Controller;
use App\Models\User;

class UpdateUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function run(UpdateUserRequest $request)
    {
        $user           = User::find($request->id);
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->verified = $request->verified;
        $user->points   = $request->points;
        $user->save();
        
        return redirect()
            ->back()
            ->with('success', 'Request successfully processed!');
    }
}
