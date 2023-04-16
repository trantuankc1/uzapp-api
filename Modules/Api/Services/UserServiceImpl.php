<?php

namespace Modules\Api\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Api\Contracts\Repositories\Mysql\UserRepository;
use Modules\Api\Contracts\Services\UserService;
use Modules\Api\Http\Requests\UserRequest;
use Modules\Api\Http\Requests\UserUpdateRequest;

class UserServiceImpl implements UserService
{
    /**
     * @var UserRepository
     */
    public UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UserRequest $request
     * @return User
     */
    public function save(UserRequest $request)
    {
        $user = new User();
        $user->open_id = $request->get('open_id');
        $user->person_name = $request->get('person_name');
        $user->phone = $request->get('phone');
        $user->email = $request->get('email');
        $user->birthday = $request->get('birthday');
        $user->gender = $request->get('gender');
        $user->status = $request->get('status', 1);
        $user->created_at = $request->get('created_at');
        $user->updated_at = $request->get('updated_at');

        $register = $this->userRepository->save($user);

        return $register;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function showProfile()
    {
        $openId = Auth::guard('api')->user()->open_id;

        return $this->userRepository->findByOpenId($openId);
    }

    /**
     * @return mixed|void
     */
    public function edit(Request $request)
    {
        $openId = Auth::guard('api')->user()->open_id;

        return $this->userRepository->edit($openId);
    }

    /**
     * //     * @return User
     */
    public function updateUser(UserUpdateRequest $request)
    {
        $openId = Auth::guard('api')->user()->open_id;
        $user = $this->userRepository->findByOpenId($openId);
        $user->person_name = $request->get('person_name');
        $user->phone = $request->get('phone');
        $user->birthday = $request->get('birthday');
        $user->gender = $request->get('gender');
        $user->status = $request->get('status', 1);

        return $this->userRepository->save($user);
    }
}
