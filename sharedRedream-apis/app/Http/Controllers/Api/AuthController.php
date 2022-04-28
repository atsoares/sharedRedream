<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Exceptions\AuthenticationException;
use Auth;
use App\Services\UserService;

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
        dd($request);

        $validated = $request->validated();


        if (!Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']]))
            throw new AuthenticationException();

        $user = $this->userService->findUserByEmail($validated['email']);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['message' => 'Hi '.$user->name.', welcome to sharedRedream','access_token' => $token, 'token_type' => 'Bearer', ], 200);
    }

}
