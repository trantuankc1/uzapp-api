@extends('admin::dashboard.base')
@section('title', 'Tomosia')

@section('content')
    <div class="container-fluid">
        <div class="box">
            <div class="header-layer">
                <form action="{{ route('changeStatus') }}" method="post">
                    @csrf
                    <table class="table table-bordered text-center th-vertical-align-middle">
                        <tbody>
                        <tr>
                            <th width="500">{{ __('admin::template.order.list.table.order_ID') }}</th>
                            <td class="text-center">{{ $transaction->id }}</td>
                        </tr>
                        <tr>
                            <th width="500">{{ __('admin::template.order.list.table.order_start_date') }}</th>
                            <td>
                                {{ $transaction->created_at }}
                            </td>
                        </tr>
                        <tr>
                            <th width="500">{{ __('admin::template.order.list.table.status') }}</th>
                            <td>
                                <input type="hidden" name="orderId" value="{{ $transaction->id}}">
                                @if($transaction->trans_status == \Modules\Admin\Constants\OrderDetail::PENDING)
                                    <label>
                                        <select name="typeStatus">
                                            <option value="1">{{ \Modules\Admin\Constants\OrderDetail::MESSAGE_PENDING }}</option>
                                            <option
                                                value="2">{{ \Modules\Admin\Constants\OrderDetail::MESSAGE_SUCCESS}}</option>
                                            <option
                                                value="3">{{ \Modules\Admin\Constants\OrderDetail::MESSAGE_CANCELED}}</option>
                                        </select>
                                    </label>
                                @endif
                                @if($transaction->trans_status == \Modules\Admin\Constants\OrderDetail::SUCCESS)
                                    {{ \Modules\Admin\Constants\OrderDetail::MESSAGE_SUCCESS }}
                                @endif
                                @if($transaction->trans_status == \Modules\Admin\Constants\OrderDetail::CANCEL)
                                    {{ \Modules\Admin\Constants\OrderDetail::MESSAGE_CANCELED }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th width="500">{{ __('admin::template.order.list.table.customer_name') }}</th>
                            <td>{{ $transaction->user->person_name }}</td>
                        </tr>
                        <tr>
                            <th width="500">Total Money</th>
                            <td>{{ number_format($transaction->trans_pay_amount)}}</td>
                        </tr>

                        </tbody>
                    </table>
                    <table class="table table-bordered text-center">
                        <tr>
                            <th>{{ __('admin::template.order.detail.product_ID') }}</th>
                            <th>{{ __('admin::template.order.detail.product_name') }}</th>
                            <th>{{ __('admin::template.order.detail.quantity') }}</th>
                            <th>{{ __('admin::template.order.detail.price') }}</th>
                        </tr>
                        <tbody>
                        @foreach($transaction->transactionProduct as $key => $transactionProduct)
                            <tr>
                                <td>{{ $transactionProduct->product_id }}</td>
                                <td>{{ $transactionProduct->product_name }}</td>
                                <td>{{ $transactionProduct->product_quantity }}</td>
                                <td>{{ number_format($transactionProduct->product_origin_amount)}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    @if($transaction->transactionProduct == 'delivery')
                    <table class="table table-bordered text-center">
                        <tr>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                        </tr>
                        <tbody>
                        @foreach($transaction->transactionProduct as $value)
                            <tr>
                                <td>{{ $value->user->person_name }}</td>
                                <td>{{ $value->transaction->mobile_phone }}</td>
                                <td>{{ $value->transaction->city }}, {{ $value->transaction->address }}
                                    , {{ $value->transaction->town }}, {{ $value->transaction->zipcode }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                    <div class="button">
                        <div class="footer-layer text-center" id="footerLayerShow">
                            @if($transaction->trans_status == \Modules\Admin\Constants\OrderDetail::PENDING)
                            <button id="btnEdit" class="btn btn-color-default btn-submit" type="submit"
                                    data-toggle="modal" data-target="#popupConfirm" style="background-color: #3ab6ba">
                                Update
                            </button>
                            @endif
                            <a class="btn btn-cancel-default d-inline-flex justify-content-center align-items-center"
                               href="{{ route('order') }}">{{ __('admin::template.general.btn_cancel') }}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

