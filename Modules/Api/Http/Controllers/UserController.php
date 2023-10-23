<?php

namespace Modules\Api\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Api\Contracts\Services\UserService;
use Modules\Api\Http\Requests\AuthLoginRequest;
use Modules\Api\Http\Requests\UserRequest;
use Modules\Api\Http\Requests\UserUpdateRequest;
use Modules\Api\Repositories\Parameters\AuthLoginParam;
use Modules\Api\Services\UserServiceImpl;
use Modules\Api\Transformers\AuthResource;
use App\Transformers\SuccessResource;

class UserController extends BaseController
{
    /**
     * @var UserServiceImpl
     */
    public UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * User login
     *
     * @OA\Post(
     *     path="/v1/login",
     *     tags={"AUTH"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/AuthLoginRequest")ll
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
     * @return AuthResource
     */
    public function login(AuthLoginRequest $request): AuthResource
    {
        $params = new AuthLoginParam($request->input('email'), $request->input('password'));
        $auth = $this->authService->login($params);

        return AuthResource::make($auth);
    }

    /**
     * @return SuccessResource
     */
    public function testAuth(): SuccessResource
    {
        return new SuccessResource();
    }

    /**
     * @param UserRequest $request
     * @return SuccessResource
     */
    public function register(UserRequest $request)
    {
        $register = $this->userService->save($request);
        $token = Auth::guard('api')->login($register);

        return SuccessResource::make($token);
    }

    /**
     * @param $id
     * @return SuccessResource
     */
    public function show(): SuccessResource
    {
        $showDetail = $this->userService->showProfile();

        return SuccessResource::make($showDetail);
    }

    /**
     * @param UserUpdateRequest $request
     * @return SuccessResource
     */
    public function update(UserUpdateRequest $request)
    {
        $edit = $this->userService->updateUser($request);

        return SuccessResource::make($edit);
    }
}
