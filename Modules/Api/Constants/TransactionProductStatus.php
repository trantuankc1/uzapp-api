<?php

namespace Modules\Api\Constants;

interface TransactionProductStatus
{
    const NEW = 'Pending';
    const PENDING = 1;

    const SUCCESS_NAME = 'Success';
    const SUCCESS = 2;

    const CANCEL_NAME = 'Cancel';
    const CANCEL = 3;
}
