<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\DiInterfaces\UserAuthDiInterface;

use App\Http\Requests\SignUpValidateRequest;

class UserAuthController extends Controller
{
    protected $userAuthRetriever = null;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UserAuthDiInterface $userAuthDiInterface)
    {
        $this->userAuthRetriever = $userAuthDiInterface;
        $this->middleware('JWT', ['except' => ['login', 'signup']]);
    }


    public function signup(SignUpValidateRequest $request)
    {
        return $this->userAuthRetriever->signup($request);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        return $this->userAuthRetriever->login();
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return $this->userAuthRetriever->me();
    }
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        return $this->userAuthRetriever->logout();
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->userAuthRetriever->refresh();
    }

    public function getAllUsers()
    {
        return $this->userAuthRetriever->getAllUsers();
    }
}

