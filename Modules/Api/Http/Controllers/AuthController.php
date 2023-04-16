<?php

namespace Modules\Api\Http\Controllers;

use App\Models\User;
use App\Transformers\ErrorResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Api\Contracts\Services\AuthService;
use Modules\Api\Http\Requests\AuthLoginRequest;
use Modules\Api\Repositories\Parameters\AuthLoginParam;
use Modules\Api\Transformers\AuthResource;
use App\Transformers\SuccessResource;

class AuthController extends BaseController
{
    /** @var AuthService */
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * User login
     *
     * @OA\Post(
     *     path="/v1/login",
     *     tags={"AUTH"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AuthLoginRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful",
     *         @OA\JsonContent(ref="#/components/schemas/SuccessResource")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request",
     *         @OA\JsonContent(ref="#/components/schemas/ErrorResource"),
     *     )
     * )
     * @param AuthLoginRequest $request
     * @return ErrorResource|AuthResource
     */
    public function login(AuthLoginRequest $request): ErrorResource|AuthResource
    {
        $user = User::query()->where('open_id', $request->input('openId'))->first();
        if (!$user) {
            return ErrorResource::make(404, 'User does not exist!');
        }
        $params = new AuthLoginParam($user->email, 'tms@123456');
        $auth = $this->authService->login($params);

        return AuthResource::make($auth);
    }

    public function register(Request $request)
    {
        $request->validate([
            'openId' => 'required|string|max:64',
            'name' => 'required|string|max:255',
            'phone' => 'required|max:10',
            'email' => 'required|string|email|max:255|unique:users',
            'birthday' => 'required',
            'gender' => 'required'

//            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'open_id' => $request->openId,
            'person_name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'password' => Hash::make('tms@123456'),
        ]);

        $token = Auth::guard('api')->login($user);

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function testAuth(): SuccessResource
    {
        return new SuccessResource();
    }
}
