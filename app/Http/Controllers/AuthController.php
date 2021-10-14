<?php

namespace App\Http\Controllers;

use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    private $loginFailAttempt = 0;

    public function register(Request $request)
    {
        # code...
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Only accept JSON request']);
        }


        $this->validate($request, [
            'username' => 'required|unique:users|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:2'
        ]);

        $data = [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'address' => $request->input('address')
        ];

        $register = User::query()->create($data);

        return response()->json([
            'message' => 'Register Success!',
            'code' => 200,
            'data' => $register
        ]);
    }

    public function login(Request $request)
    {
        # code...
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:8'
        ]);

        $user = User::query()->where(['username' => $request->input('username')])->first();
        if (empty($user)) {
            $this->loginFailAttempt++;
            return response()->json([
                'fail_attempt' => $this->loginFailAttempt,
                'error' => 'Username not found!'
            ], 404);
        }

        if (!Hash::check($request->input('password'), $user->password)) {
            $this->loginFailAttempt++;
            return response()->json([
                'fail_attempt' => $this->loginFailAttempt,
                'error' => 'Invalid password!'
            ], 401);
        }

        // check if token exsist or create it
        $token = $this->accessToken($user->id, $request->ip());

        if ($token->status == 'blocked') {
            return response()->json(['error' => 'The current user is blocked']);
        }

        // Create pair User - Token Here

        User::setUserToken($user->id, $token->id);

        // User::query()->find($user->id)->update(['token_id' => $token->id]);

        return response()->json([
            'message' => 'Authenticate success',
            'code' => 200,
            'secret' => $token->token
        ]);
    }

    private function accessToken($userId, $ip)
    {
        /* $userToken = Token::query()->firstOrCreate(['user_id' => $userId], [
            'user_id' => $userId,
            'token' => $this->generateKey(),
            'ip_address' => ip2long($ip),
            'status' => 'allowed'
        ]); */

        $userToken = Token::getUsersTokenOrCreate($userId, [
            'token' => $this->generateKey(),
            'ip_address' => ip2long($ip),
            'status' => 'allowed'
        ]);

        return $userToken;
    }

    private function generateKey()
    {
        # code...
        return base64_encode(random_bytes(40));
    }
}
