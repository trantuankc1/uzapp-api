@extends('admin::dashboard.base')

@section('library-head')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@stop

@section('title', 'Tomosia')

@section('content')
    <div class="container-fluid">
        <div class="box">
            <div class="header-layer">
                <form action="{{ route('admin::product.index') }}" method="get">
                    <div class="row">
                        <div class="col">
                            <h2>{{ __('admin::template.product.title') }}</h2>
                            <hr>
                        </div>
                        <div class="col-12">
                            <div class="filter-form">
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <label for="product_id">{{ __('admin::template.product.form_search.product_ID') }}</label>
                                        <input type="text" class="form-control" id="product_id" name="product_id" style="color: black"
                                               value="{{ request()->get('product_id') ?? '' }}">
                                    </div>
                                    <div class="form-group col-1"></div>
                                    <div class="form-group col-2">
                                        <label for="product_name">{{ __('admin::template.product.form_search.product_name') }}</label>
                                        <input type="text" class="form-control" id="product_name" name="product_name" style="color: black"
                                               value="{{ request()->get('product_name') ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="actions">
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <button class="btn btn-square btn-color-default btn-action w-100" type="submit" style="background-color: #3ab6ba; border-radius: 4px">
                                            {{ __('admin::template.product.form_search.btn_search') }}
                                        </button>
                                    </div>
                                    <div class="form-group col-1"></div>
                                    <div class="form-group col-2">
                                        <a class="btn btn-square btn-color-default btn-action w-100"
                                           href="{{ route('admin::product.exportCSV', request()->getQueryString()) }}"
                                           role="button" style="background-color: #3ab6ba; border-radius: 4px">{{ __('admin::template.product.form_search.btn_download') }}</a>
                                    </div>
                                    <div class="form-group col-1"></div>
                                    <div class="form-group col-2">
                                        <a href="{{ route('admin::product.create') }}"
                                           class="btn btn-square btn-color-default btn-action w-100" style="background-color: #3ab6ba; border-radius: 4px">{{ __('admin::template.product.form_search.btn_create') }}
                                        </a>
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
                            <th scope="col">{{ __('admin::template.product.table.product_ID') }}</th>
                            <th scope="col">{{ __('admin::template.product.table.product_code') }}</th>
                            <th scope="col">{{ __('admin::template.product.table.product_name') }}</th>
                            <th scope="col">{{ __('admin::template.product.table.product_price') }}</th>
                            <th scope="col">{{ __('admin::template.product.table.product_amount') }}</th>
                            <th scope="col">{{ __('admin::template.product.table.product_category') }}</th>
                            <th scope="col">{{ __('admin::template.product.table.product_action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td class="line" style="display: table-cell; vertical-align: middle"><a class="showDetail text-info text-decoration-underline cursor-pointer"
                                       href="{{ route('admin::product.edit', $item->id) }}">{{ $item->id }}</a></td>
                                <td style="display: table-cell; vertical-align: middle">{{ $item->code }}</td>
                                <td style="width: 27%; display: table-cell; vertical-align: middle">{{ $item->name }}</td>
                                <td style="display: table-cell; vertical-align: middle">{{ $item->price }}</td>
                                <td style="display: table-cell; vertical-align: middle">{{ $item->quantity }}</td>
                                <td style="display: table-cell; vertical-align: middle">{{ $item->category->category_name }}</td>
                                <td style="display: table-cell; vertical-align: middle"><label class="c-switch c-switch-pill c-switch-dark">
                                        <input type="checkbox" class="c-switch-input switch-status" name="status"
                                               data-id="{{ $item->id }}"
                                               @if($item->status == 1) checked @endif>
                                        <span class="c-switch-slider"></span>
                                    </label>
                                </td>
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
            </div>
        </div>
    </div>
@endsection
@section('library-footer')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        @if(session()->has('notify'))
        toastr.success('{{ session()->get('notify') }}');
        @endif

        $(document).ready(function () {
            $('#summernote').summernote({
                height: 150
            });

            $('.table-box').on('change', '.switch-status', function () {
                let val = $(this).is(':checked');
                let id = $(this).attr('data-id');
                $.ajax({
                    type: 'GET',
                    url: '/api/admin/products/change-status/' + id,
                    data: {"status": val ? 1 : 0},
                    success: (response) => {
                        if (response.meta.code === 200) {
                            toastr.success('{{ __('admin::messages.product.change_status_success') }}');
                        }
                    },
                });
            });
        });
    </script>
@stop

