<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Contracts\Services\UserService;
use Modules\Admin\Http\Requests\User\UserUpdateRequest;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        //Get all users
        $items = $this->userService->getList($request);

        return view('admin::pages.user.index', compact('items'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function show($id)
    {
        //find user
        $user = $this->userService->findByField($id);

        return response()->json([
            'status' => true,
            'user' => $user
        ]);
    }

    /**
     * @param UserUpdateRequest $request
     * @return void
     */
    public function update(UserUpdateRequest $request)
    {
        $user = $this->userService->update($request->all());
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function search(Request $request)
    {
        $users = $this->userService->findWhere($request->customer_id);

        return view('admin::users.list', compact('users'));
    }

    /**
     * @return BinaryFileResponse
     */
    public function exportCSV(Request $request)
    {
        return $this->userService->exportCSV($request);
    }

    public function profileUser(int $id)
    {
        $showProfile = $this->userService->showProfile($id);

        return view('admin::pages.user.profile', compact('showProfile'));
    }
}
