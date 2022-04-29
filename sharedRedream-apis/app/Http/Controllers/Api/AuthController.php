<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserResource;
use App\Exceptions\AuthenticationException;

class AuthController extends Controller
{
    /**
     * Variable to hold injected dependency
     *
     * @var userService
     */
    protected $userService;
    
    /**
     * Constructor
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Register new account
     *
     * @param  RegisterUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterUserRequest $request)
    {
        $user = $this->userService->create($request->validated());

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['data' => $user,'access_token' => $token, 'token_type' => 'Bearer', ], 201);
    }

    /**
     * Login
     *
     * @param  LoginUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginUserRequest $request)
    {   
        $validated = $request->validated();

        if (!Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']]))
            throw new AuthenticationException();

        $user = $this->userService->findUserByEmail($validated['email']);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['message' => 'Hi '.$user->name.', welcome to sharedRedream','access_token' => $token, 'token_type' => 'Bearer', ], 200);
    }

    /**
     * Get Profile Info
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {   
        return new UserResource(Auth::user());
    }

}
