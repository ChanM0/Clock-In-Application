<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\SignUpValidateRequest;

class UserAuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['login', 'signup']]);
    }


    public function signup(SignUpValidateRequest $request)
    {

        // $dataArray['username'] = $request->username;
        // $dataArray['first_name'] = $request->first_name;
        // $dataArray['last_name'] = $request->last_name;
        // $dataArray['full_name'] = $dataArray['first_name'] . $dataArray['last_name'];
        // $dataArray['email'] = $request->email;
        // $dataArray['password'] = $request->password;

        // $user = new User([
        //     'username' => $dataArray['username'],
        //     'full_name' => $dataArray['full_name'],
        //     'first_name' => $dataArray['first_name'],
        //     'last_name' => $dataArray['last_name'],
        //     'email' => $dataArray['email'],
        //     'password' => bcrypt($dataArray['password']),
        // ]);
        // $user = new User();
        // $user->username = $dataArray['username'];
        // $user->full_name = $dataArray['full_name'];
        // $user->first_name = $dataArray['first_name'];
        // $user->last_name = $dataArray['last_name'];
        // $user->email = $dataArray['email'];
        // $user->password = bcrypt($dataArray['password']);
        // $user->save();

        User::create($request->all());
        return $this->login($request);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'first_name' => auth()->user()->username,
            'user_id' => auth()->user()->id
        ]);
    }
}

