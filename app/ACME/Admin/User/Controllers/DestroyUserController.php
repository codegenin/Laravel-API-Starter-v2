<?php

namespace App\ACME\Admin\User\Controllers;

use App\ACME\Admin\User\Requests\DeleteUserRequest;
use App\Http\Controllers\Controller;
use App\Models\User;

class DestroyUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function run(DeleteUserRequest $request)
    {
        $user = User::find($request->id);
        $user->delete();
        
        return redirect()
            ->back()
            ->with('success', 'Request successfully processed!');
    }
}
