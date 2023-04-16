@extends('admin::dashboard.base')

@section('library-head')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@stop

@section('title', 'Tomosia')

@section('content')
    <div class="container-fluid">
        <div class="box">
            <div class="header-layer">
                <form action="{{ route('admin::users.index') }}" method="get">
                    <div class="row">
                        <div class="col">
                            <h2>{{ __('admin::template.customer.title') }}</h2>
                            <hr>
                        </div>
                        <div class="col-12">
                            <div class="filter-form">
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <label for="customer_id">{{ __('admin::template.customer.form_search.customer_ID') }}</label>
                                        <input type="text" class="form-control" id="customer_id" name="customer_id" style="color: black"
                                               value="{{ request()->get('customer_id') ?? '' }}">
                                    </div>
                                    <div class="form-group col-1"></div>
                                    <div class="form-group col-2">
                                        <label for="customer_id">{{ __('admin::template.customer.form_search.customer_name') }}</label>
                                        <input type="text" class="form-control" id="customer_id" name="customer_name" style="color: black"
                                               value="{{ request()->get('customer_name') ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="actions">
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <button class="btn btn-square btn-color-default btn-action w-100" type="submit"
                                                style="background-color: #3ab6ba; border-radius: 4px">
                                            {{ __('admin::template.customer.form_search.btn_search') }}
                                        </button>
                                    </div>
                                    <div class="form-group col-1"></div>
                                    <div class="form-group col-2">
                                        <a class="btn btn-square btn-color-default btn-action w-100"
                                           href="{{ route('admin::users.exportCSV', request()->getQueryString()) }}"
                                           role="button" style="background-color: #3ab6ba; border-radius: 4px">{{ __('admin::template.customer.form_search.btn_download') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="body-layer" style="margin-top: 10px">
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
                        @foreach($items as $item)
                            <tr>
                                <td><a class="btn-show text-info text-decoration-underline cursor-pointer"
                                       href="{{ route('admin::user.profile', $item->id) }}"
                                       data-id="{{$item->id}}">{{ $item->id }}</a></td>
                                <td>{{ $item->person_name }}</td>
                                <td>
                                    @switch($item->gender)
                                        @case(\Modules\Admin\Constants\UserStatus::GENDER_MALE)
                                            Male
                                            @break
                                        @case (\Modules\Admin\Constants\UserStatus::GENDER_FEMALE)
                                            Female
                                            @break
                                        @default
                                            Other
                                    @endswitch
                                </td>
                                <td>{{ $item->phone }}</td>
                                <td>{{date('d/m/Y', strtotime($item->birthday))}}</td>
                                <td>{{ $item->email }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    <p>{{ __('admin::pagination.showing') }} {{$items->firstItem() ?? 0 . __('admin::pagination.showing_to') . $items->lastItem()}}
                        {{  __('admin::pagination.showing_of') }} {{$items->total()}} {{  __('admin::pagination.showing_record') }}</p>
                    {{ $items->render('admin::vendor.pagination.default') }}
                </div>
                @include('admin::pages.user.layouts.show')
            </div>
        </div>
    </div>
@endsection
@section('library-footer')
    {{--    <script>--}}
    {{--        @if(session()->has('notify'))--}}
    {{--        toastr.success('{{ session()->get('notify') }}');--}}
    {{--        @endif--}}

    {{--        let showModal = new coreui.Modal(document.getElementById('showRecord'), {});--}}

    {{--        $(document).ready(function () {--}}
    {{--            $('.table-box').on('click', '.btn-show', function (e) {--}}
    {{--                e.preventDefault();--}}
    {{--                let id = $(this).attr('data-id');--}}
    {{--                $.ajax({--}}
    {{--                    type: 'GET',--}}
    {{--                    url: '/api/admin/users/show/' + id,--}}
    {{--                    contentType: false,--}}
    {{--                    processData: false,--}}
    {{--                    success: (response) => {--}}
    {{--                        if (response.status) {--}}
    {{--                            let res = response.user;--}}
    {{--                            let gender = res.gender === 1 ? 'Male' : (res.gender === 2 ? 'Female' : 'Other');--}}

    {{--                            $('#showId').html(res.id);--}}
    {{--                            $('#showName').html(res.person_name);--}}
    {{--                            $('#showGender').html(gender);--}}
    {{--                            $('#showPhone').html(res.phone);--}}
    {{--                            $('#showBirthday').html(res.birthday);--}}
    {{--                            $('#showEmail').html(res.email);--}}
    {{--                            showModal.show();--}}
    {{--                        }--}}
    {{--                    },--}}
    {{--                });--}}
    {{--            });--}}
    {{--        });--}}
    {{--    </script>--}}
@stop
