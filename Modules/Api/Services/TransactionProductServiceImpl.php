<?php

namespace Modules\Api\Services;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Modules\Api\Contracts\Repositories\Mysql\TransactionProductRepository;
use Modules\Api\Contracts\Services\TransactionProductService;

class TransactionProductServiceImpl implements TransactionProductService
{
    private StatefulGuard|Guard $auth;
    private TransactionProductRepository $transactionProductRepository;

    public function __construct(TransactionProductRepository $transactionProductRepository)
    {
        $this->auth = Auth::guard('api');
        $this->transactionProductRepository = $transactionProductRepository;
    }

    public function getTransactionDetail(string $transNo)
    {
        $openId = $this->auth->user()->open_id;

        return $this->transactionProductRepository->getAllByTransNoAndOpenId($transNo, $openId);
    }
}
