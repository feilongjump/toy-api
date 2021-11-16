<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\Welcome;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(
            ['activate']
        );
    }

    public function sendActiveMail(Request $request): JsonResponse
    {
        $request->user()->sendActiveMail();

        return response()->json([
            'message' => '激活邮件已发送，请注意查收！',
        ]);
    }

    public function activate(Request $request)
    {
        $params = [
            'active-success' => 'no',
            'type' => 'register',
            'error' => 'overtime',
        ];
        if ($request->hasValidSignature()) {
            $user = User::whereEmail($request->email)->first();

            if ($user->isActivated) {
                // 已激活，勿重复操作
                $params['error'] = 'repeat';
            } else {
                $user->activate();
                $user->notify(new Welcome());
                $params['error'] = '';
            }

            $params['active-success'] = 'yes';
        }

        return redirect(config('app.site_url').'?'.http_build_query($params));
    }
}
