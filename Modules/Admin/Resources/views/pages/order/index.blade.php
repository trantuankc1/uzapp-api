@extends('admin::dashboard.base')
@section('title', 'Tomosia')

@section('content')
    <div class="container-fluid">
        <div class="box">
            <div class="header-layer">
                <form action="{{ route('order') }}" method="get">
                    <div class="row">
                        <div class="col">
                            <h2>{{ __('admin::template.order.list.title') }}</h2>
                            <hr>
                        </div>
                        <div class="col-12">
                            <div class="filter-form">
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <label for="product_id">{{ __('admin::template.order.list.form_search.period') }}</label>
                                        <input type="date" class="form-control" id="period" name="period" style="color: black"
                                               value="{{ request()->get('period') ?? '' }}">
                                    </div>
                                    <div class="form-group col-1"></div>
                                    <div class="form-group col-2">
                                        <label for="product_name">{{ __('admin::template.order.list.form_search.order_ID') }}</label>
                                        <input type="text" class="form-control" id="order_id" name="order_id" style="color: black"
                                               value="{{ request()->get('order_id') ?? '' }}">
                                    </div>
                                    <div class="form-group col-1"></div>
                                    <div class="form-group col-2">
                                        <label for="product_name">{{ __('admin::template.order.list.form_search.customer_name') }}</label>
                                        <input type="text" class="form-control" id="customer_name" name="customer_name" style="color: black"
                                               value="{{ request()->get('customer_name') ?? '' }}">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="actions">
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <button class="btn btn-square btn-color-default btn-action w-100" type="submit" style="background-color: #3ab6ba;border-radius: 4px">
                                            {{ __('admin::template.order.list.form_search.btn_search') }}
                                        </button>
                                    </div>
                                    <div class="form-group col-1"></div>
                                    <div class="form-group col-2">
                                        <a class="btn btn-square btn-color-default btn-action w-100"
                                           href="{{ route('export-csv') }}"
                                           role="button" style="background-color: #3ab6ba; border-radius: 4px">{{ __('admin::template.order.list.form_search.btn_download_csv') }}</a>
                                    </div>
                                    <div class="form-group col-1"></div>
                                    <div class="form-group col-2">
                                    </div>
                                </div>
                            </div>

                            <h5>{{ __('admin::template.order.list.table.total_money') }}:  {{ number_format($totalMoney) }} </h5>

                        </div>
                    </div>
                </form>
            </div>

            <table class="table table-bordered table-hover text-center">
                <tr>
                    <td>{{ __('admin::template.order.list.table.order_ID') }}</td>
                    <td>{{ __('admin::template.order.list.table.order_start_date') }}</td>
                    <td>{{ __('admin::template.order.list.table.status') }}</td>
                    <td>Payment Method</td>
                    <td>{{ __('admin::template.order.list.table.customer_name') }}</td>
                </tr>
                <tbody>
                @foreach($orders as $key => $order)
                    <tr>
                        <td><a class="showDetail text-info text-decoration-underline cursor-pointer" href="{{ route('orderDetail', $order->id) }}">A{{ $order->trans_confirm_no }}</a></td>
                        <td>{{ $order->created_at}}</td>
                        <td>
                            @if($order->trans_status == \Modules\Admin\Constants\TransactionStatus::PENDING)
                                {{\Modules\Admin\Constants\TransactionStatus::MESSAGE_PENDING}}
                            @elseif($order->trans_status == \Modules\Admin\Constants\TransactionStatus::SUCCESS)
                                {{\Modules\Admin\Constants\TransactionStatus::MESSAGE_SUCCESS}}
                            @elseif($order->trans_status == \Modules\Admin\Constants\TransactionStatus::CANCEL)
                                {{\Modules\Admin\Constants\TransactionStatus::MESSAGE_CANCELED}}
                            @endif
                        </td>
                        <td>{{ $order->pay_method }}</td>
                        <td>{{ $order->user->person_name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">
                <p>{{ __('admin::pagination.showing') }} {{$orders->firstItem() ?? 0 . __('admin::pagination.showing_to') . $orders->lastItem()}}
                    {{  __('admin::pagination.showing_of') }} {{$orders->total()}} {{  __('admin::pagination.showing_record') }}</p>
                {{ $orders->render('admin::vendor.pagination.default') }}
            </div>
        </div>
    </div>

@endsection




