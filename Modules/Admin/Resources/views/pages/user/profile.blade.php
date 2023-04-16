@extends('admin::dashboard.base')

@section('library-head')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@stop

@section('title', 'Tomosia')

@section('content')
    <div class="container-fluid">
        <div class="box">
            <div class="header-layer">
                <div class="table-box">
                    <table class="table table-bordered text-center">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('admin::template.customer.table.customer_ID') }}</th>
                            <th scope="col">{{ __('admin::template.customer.table.customer_name') }}</th>
                            <th scope="col">{{ __('admin::template.customer.table.customer_gender') }}</th>
                            <th scope="col">{{ __('admin::template.customer.table.customer_phone') }}</th>
                            <th scope="col">{{ __('admin::template.customer.table.customer_birthday') }}</th>
                            <th scope="col">{{ __('admin::template.customer.table.customer_email') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $showProfile->id }}</td>
                            <td>{{ $showProfile->person_name }}</td>
                            <td>
                                @if($showProfile->gender == \Modules\Admin\Constants\UserGender::MALE)
                                    {{ \Modules\Admin\Constants\UserGender::MESSAGE_MALE }}
                                @elseif($showProfile->gender == \Modules\Admin\Constants\UserGender::FEMALE)
                                    {{ \Modules\Admin\Constants\UserGender::MESSAGE_FEMALE }}
                                @elseif($showProfile->gender == \Modules\Admin\Constants\UserGender::OTHER)
                                    {{ \Modules\Admin\Constants\UserGender::MESSAGE_OTHER }}
                                @endif
                            </td>
                            <td>{{ $showProfile->phone}}</td>
                            <td>{{ $showProfile->birthday }}</td>
                            <td>{{ $showProfile->email }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered text-center">
                        <tr>
                            <th>Order start date</th>
                            <th>Order ID</th>
                            <th>Status</th>
                            <th>Payment Method</th>
                        </tr>
                        <tbody>
                        @if(count($showProfile->transaction))
                            @foreach($showProfile->transaction as $key => $value)
                                <tr>
                                    <td>{{ $value->created_at }}</td>
                                    <td>{{ $value->id }}</td>
                                    <td>
                                        @if($value->trans_status == \Modules\Admin\Constants\OrderDetail::PENDING)
                                            {{ \Modules\Admin\Constants\OrderDetail::MESSAGE_PENDING }}
                                        @elseif($value->trans_status == \Modules\Admin\Constants\OrderDetail::SUCCESS)
                                            {{ \Modules\Admin\Constants\OrderDetail::MESSAGE_SUCCESS }}
                                        @elseif($value->trans_status == \Modules\Admin\Constants\OrderDetail::CANCEL)
                                            {{ \Modules\Admin\Constants\OrderDetail::MESSAGE_CANCELED }}
                                        @endif
                                    </td>
                                    <td>{{ $value->pay_method }}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="footer-layer text-center">
                <a class="btn btn-cancel-default d-inline-flex justify-content-center align-items-center"
                   href="{{ route('admin::users.index') }}" style="color: white">Cancel</a>
            </div>
        </div>
    </div>
@endsection
@section('library-footer')
@stop
