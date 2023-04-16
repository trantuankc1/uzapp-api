<?php

namespace Modules\Admin\Services;

use App\Exports\ProductExport;
use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Admin\Contracts\Repositories\Mysql\UserRepository;
use Modules\Admin\Contracts\Services\UserService;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class UserServiceImpl implements UserService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getList(Request $request): LengthAwarePaginator
    {
        $filters = [];
        if ($request->filled('customer_id')) {
            $filters[] = ['id', $request->input('customer_id')];
        }

        if ($request->filled('customer_name')) {
            $filters[] = ['person_name', 'LIKE', '%' . $request->input('customer_name') . '%'];
        }

        return $this->userRepository->getListWithFilter($filters);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findByField($id)
    {
        $user = $this->userRepository->findByField($id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'messages' => 'Data does not exist !'
            ]);
        }

        return $user;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function findWhere($customerId)
    {
        if(!$customerId){
           return $this->getAllUsers();
        }

        return $this->userRepository->findWhere($customerId);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function update($params)
    {
        return $this->userRepository->update($params);
    }

    /**
     * @return BinaryFileResponse
     */
    public function exportCSV(Request $request)
    {
        $filters = [];
        if ($request->filled('customer_id')) {
            $filters[] = ['id', $request->input('customer_id')];
        }
        if ($request->filled('customer_name')) {
            $filters[] = ['person_name', 'LIKE', '%' . $request->input('customer_name') . '%'];
        }

        return Excel::download(new UsersExport($filters), 'user.csv');
    }

    /**
     * @param int $id
     * @return Builder[]|Collection
     */
    public function showProfile(int $id)
    {
        return $this->userRepository->showProfile($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getOrderUser(int $id)
    {
        return $this->userRepository->getOrderUser($id);
    }
}
