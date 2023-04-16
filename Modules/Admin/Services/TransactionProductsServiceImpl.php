<?php

namespace Modules\Admin\Services;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Admin\Contracts\Repositories\Mysql\TransactionProductsRepository;
use Modules\Admin\Contracts\Services\TransactionProductsService;

class TransactionProductsServiceImpl implements TransactionProductsService
{
    /**
     * @var TransactionProductsRepository
     */
    protected TransactionProductsRepository $orderDetailRepository;

    /**
     * @param TransactionProductsRepository $orderDetailRepository
     */
    public function __construct(TransactionProductsRepository $orderDetailRepository)
    {
        $this->orderDetailRepository = $orderDetailRepository;
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function getOrderDetail(int $id)
    {
        return $this->orderDetailRepository->getOrderDetail($id);
    }

    public function exportCsv()
    {
        return Excel::download(new \App\Exports\OrderDetailExport(), 'order.csv');
    }
}
