<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserResource;
use App\Exceptions\AuthenticationException;

/**
 * @group Auth endpoints
 */
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
     * Registration request
     *
     * @response 200 {
     *    "data": {
     *        "id": 2,
     *        "name": "Demo",
     *        "email": "demo@demo.com",
     *        "balance": "0.00"
     *    }
     *    "token": "3|tA8Ouhh1CWXJORVPHvUQvN0SFNZVGwvVbx2F3prb",
     *    "token_type": "Bearer"
     * }
     * @response status=422 scenario="Validation error" { 
     *    "message": "The given data was invalid.",
     *    "errors": {
     *        "email": [
     *            "The email field is required."
     *        ]
     *    }
     * }
     *
     * @param  RegisterUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterUserRequest $request)
    {
        $user = $this->userService->create($request->validated());

        $token = $user->createToken('auth_token')->plainTextToken;

        $data = new UserResource($user);

        return response()
            ->json(['data' => $data,'access_token' => $token, 'token_type' => 'Bearer', ], 201);
    }

    /**
     * Login request
     * 
     * @response status=422 scenario="Validation error" {
     *    "message": "The given data was invalid.",
     *    "errors": {
     *        "email": [
     *            "The email field is required."
     *        ]
     *    }
     * }
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
     * Show authenticated user info
     *
     * @authenticated
     * 
     * @response 200 {
     *     "id": 2,
     *     "name": "Demo",
     *     "email": "demo@demo.com",
     *     "balance": "150.00"
     * }
     * @response status=404 scenario="Not Found" {
     *     "message": "Not Found"
     * }
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {   
        return new UserResource(Auth::user());
    }

}
