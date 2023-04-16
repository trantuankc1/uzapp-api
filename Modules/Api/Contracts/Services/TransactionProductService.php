<?php

namespace Modules\Api\Contracts\Services;

interface TransactionProductService
{
    public function getTransactionDetail(string $transNo);
}
