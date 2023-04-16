<?php

namespace Modules\Api\Contracts\Services;

use Illuminate\Http\Request;
use Modules\Api\Http\Requests\UserRequest;
use Modules\Api\Http\Requests\UserUpdateRequest;

interface UserService
{
    /**
     * @param UserRequest $request
     * @return mixed
     */
    public function save(UserRequest $request);

    /**
     * @return mixed
     */
    public function showProfile();

    /**
     * @return mixed
     */
    public function edit(Request $request);

    /**
     * @param UserUpdateRequest $request
     * @return mixed
     */
    public function updateUser(UserUpdateRequest $request);
}
