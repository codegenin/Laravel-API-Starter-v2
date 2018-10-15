<?php

namespace App\ACME\Api\V1\Authentication\Controllers;

use App\ACME\Api\V1\Authentication\Requests\ForgotPasswordRequest;
use App\Jobs\SendVerificationEmail;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ResendEmailConfirmationController extends Controller
{
    /**
     * @apiGroup           Authentication
     * @apiName            resendConfirmation
     * @api                {post} /api/auth/resend-confirmation Resend Confirmation
     * @apiDescription     Resend user email confirmation
     * @apiVersion         1.0.0
     *
     * @apiParam {String} email unique email of the user
     *
     * @apiSuccessExample {json} Success-Response:
     *
     * {
     * "status": true,
     * "message": "A verification mail has been sent into your email account!"
     * }
     */
    public function resendConfirmationEmail(ForgotPasswordRequest $request)
    {
        $user = User::where('email', '=', $request->get('email'))
                    ->where('verification_token', '<>', '')
                    ->first();
        
        if (!$user) {
            throw new NotFoundHttpException();
        }
        
        // Send verification email
        dispatch(new SendVerificationEmail($user));
        
        return response()->json([
            'status'  => true,
            'message' => 'A verification mail has been sent into your email account!'
        ], 201);
        
    }
}
