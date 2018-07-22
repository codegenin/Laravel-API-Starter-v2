<?php

namespace App\ACME\Admin\User\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class AjaxGetUserController extends Controller
{
    public function run($id)
    {
        $user = User::find($id);
        
        return response()->json([
            'status' => true,
            'user'   => [
                'id'       => $user->id,
                'name'     => $user->name,
                'email'    => $user->email,
                'role'     => $user->role,
                'verified' => $user->verified,
            ]
        ]);
    }
}
