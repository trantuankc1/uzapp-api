<?php

namespace Modules\Api\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class DebugController extends BaseController
{

    public function __construct()
    {
    }

    public function debug()
    {
        $transaction = new Transaction();
        $transaction->open_id = 'abc1233';
        $transaction->trans_confirm_no = 23;
        $transaction->con_no = 23;
        $transaction->save();

        return "OK";
    }
}
