<?php

namespace App\ACME\Api\V1\User\Controllers;

use App\ACME\Api\V1\User\Repositories\UserRepository;
use App\ACME\Api\V1\User\Requests\UpdateUserRoleRequest;
use App\Http\Controllers\Controller;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Auth;

class RoleController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    
    /**
     * UserRoleController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('jwt.auth', []);
        $this->userRepository = $userRepository;
    }
    
    /**
     * @apiGroup           User
     * @apiName            updateUserRole
     * @api                {post} /api/user/role-update Update Role
     * @apiDescription     Update user role
     * @apiVersion         1.0.0
     *
     * @apiHeader {String} Authorization =Bearer+access-token} Users unique access-token.
     *
     * @apiParam {String} role choose between artist or patron role only
     * @apiParam {String} role choose between artist or patron role only
     *
     *
     * @apiSuccessExample {json} Success-Response:
     *                     {
     * "status": "ok",
     * "message": "Role has been updated successfully!"
     * }
     *
     */
    public function updateUserRole(UpdateUserRoleRequest $request)
    {
        $userId = Auth::guard()
                      ->user()->id;
        
        if (!$this->userRepository->update($userId, [
            'role' => $request->role
        ])) {
            throw new ResourceNotFoundException();
        }
        
        return response()->json([
            'status'  => 'ok',
            'message' => 'Role has been updated successfully!'
        ]);
        
    }
}