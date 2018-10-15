<?php

namespace App\ACME\Api\V1\Authentication\Controllers;

use App\ACME\Api\V1\Authentication\Requests\ForgotPasswordRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ForgotPasswordController extends Controller
{
    /**
     * @apiGroup           Authentication
     * @apiName            forgetPassword
     * @api                {post} /api/auth/recovery Forgot Password
     * @apiDescription     Forgot user password
     * @apiVersion         1.0.0
     *
     * @apiParam {String} email unique email of the user
     *
     * @apiSuccessExample {json} Success-Response:
     *
     * {
     * "status": true
     * }
     */
    public function sendResetEmail(ForgotPasswordRequest $request)
    {
        $user = User::where('email', '=', $request->get('email'))->first();

        if(!$user) {
            throw new NotFoundHttpException();
        }

        $broker = $this->getPasswordBroker();
        $sendingResponse = $broker->sendResetLink($request->only('email'));

        if($sendingResponse !== Password::RESET_LINK_SENT) {
            throw new HttpException(500);
        }

        return response()->json([
            'status' => 'ok'
        ], 200);
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    private function getPasswordBroker()
    {
        return Password::broker();
    }
}
