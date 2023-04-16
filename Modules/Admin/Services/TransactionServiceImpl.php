<?php

namespace Modules\Admin\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Admin\Contracts\Repositories\Mysql\TransactionRepository;
use Modules\Admin\Contracts\Services\TransactionService;

class TransactionServiceImpl implements TransactionService
{
    /**
     * @var TransactionRepository
     */
    protected TransactionRepository $orderRepository;

    /**
     * @param TransactionRepository $orderRepository
     */
    public function __construct(TransactionRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     */
    public function getAllOrder(Request $request)
    {
        $filters = [];
        if ($request->filled('order_id')) {
            $filters['order'][] = ['trans_confirm_no', $request->input('order_id')];
        }

        if ($request->filled('period')) {
            $filters['period'] = array_merge(['created_at', $request->input('period')]);
        }

        if ($request->filled('customer_name')) {
            $filters['person_name'][] = ['person_name', 'LIKE', '%' . $request->get('customer_name') . '%'];
        }

        $items = $this->orderRepository->getAllOrder($filters);
        $items->totalMoney = $this->totalMoney($filters);

        return $items;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->orderRepository->findId($id);
    }

    public function show(int $id): Model
    {
        return $this->orderRepository->findByIdWithTransactionProduct($id);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function update(int $id)
    {
        return $this->orderRepository->update($id);
    }

    /**
     * @param int $id
     * @return mixed|void
     */
    public function active(int $id)
    {
        return $this->orderRepository->active($id);
    }

    /**
     * @return mixed
     */
    public function totalMoney(array $filters)
    {
       return $this->orderRepository->getSumTotalMoneyWithFilter($filters);
    }
}
