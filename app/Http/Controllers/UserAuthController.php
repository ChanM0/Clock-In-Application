<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\DiInterfaces\UserAuthDiInterface;
use App\Http\Requests\SignUpValidateRequest;

class UserAuthController extends Controller
{
    protected $userAuthRetriever;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UserAuthDiInterface $userAuthDiInterface)
    {
        $this->userAuthRetriever = $userAuthDiInterface;
        $this->middleware('JWTAuthMiddleWare', ['except' => ['login', 'signup']]);
    }


    public function signup(SignUpValidateRequest $request)
    {

        $dataArray['first_name'] = $request->first_name;
        $dataArray['last_name'] = $request->last_name;
        $dataArray['email'] = $request->email;
        $dataArray['password'] = bcrypt($request->password);

        $response = $this->userAuthRetriever->signup($dataArray);

        //TRY Catch $response;

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
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}