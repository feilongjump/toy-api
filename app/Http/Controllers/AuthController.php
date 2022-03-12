<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\AuthRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(AuthRequest $request): JsonResponse
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

        $user->sendActiveMail();

        return $this->respondWithToken($user, []);
    }

    public function login(AuthRequest $request)
    {
        $username = $request->username;

        filter_var($username, FILTER_VALIDATE_EMAIL) ?
            $credentials['email'] = $username :
            $credentials['name'] = $username;

        $credentials['password'] = $request->password;

        if (!Auth::attempt($credentials)) {
            throw new AuthenticationException('用户名或密码错误');
        }

        $user = Auth::user();
        $abilities = $user->isActivated ? ['*'] : [];

        return $this->respondWithToken($user, $abilities)->setStatusCode(201);
    }

    /**
     * Get the token array structure.
     *
     * @param User $user
     * @param array $abilities
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken(User $user, array $abilities = ['*'])
    {
        return response()->json([
            'access_token' => $user->createToken(config('app.name'), $abilities)->plainTextToken,
            'token_type' => 'Bearer',
            'expires_in' => Carbon::now()->addSeconds(config('sanctum.expiration') ?? 604800)->timestamp
        ]);
    }
}
