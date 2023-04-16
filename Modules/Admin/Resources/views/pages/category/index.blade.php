@extends('admin::dashboard.base')
@section('title', 'Tomosia')

@section('content')
    <div class="container-fluid">
        <div class="box">
            <div class="header-layer">
                <form action="" method="get">
                    <div class="row">
                        <div class="col">
                            <h2>{{ __('admin::template.category.title') }}</h2>
                            <hr>
                        </div>
                        <div class="col-12">
                            <div class="filter-form">
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <label for="product_id">{{ __('admin::template.category.form_search.category_ID') }}</label>
                                        <input type="text" class="form-control" id="product_id" name="category_id" style="color: black"
                                               value="{{ request()->get('category_id') ?? '' }}">
                                    </div>
                                    <div class="form-group col-1"></div>
                                    <div class="form-group col-2">
                                        <label for="product_name">{{ __('admin::template.category.form_search.category_name') }}</label>
                                        <input type="text" class="form-control" id="category_name" name="category_name" style="color: black"
                                               value="{{ request()->get('category_name') ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="actions">
                                <div class="form-row">
                                    <div class="form-group col-2">
                                        <button class="btn btn-square btn-color-default btn-action w-100"
                                                style="background-color: #3ab6ba; border-radius: 4px" type="submit">
                                            {{ __('admin::template.category.form_search.btn_search') }}
                                        </button>
                                    </div>
                                    <div class="form-group col-1"></div>
                                    <div class="form-group col-2">
                                        <a class="btn btn-square btn-color-default btn-action w-100"
                                           href="{{ route('create') }}"
                                           role="button" style="background-color: #3ab6ba; border-radius: 4px">{{ __('admin::template.category.form_search.btn_create') }}</a>
                                    </div>
                                    <div class="form-group col-1"></div>
                                    <div class="form-group col-2">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


            <div class="body-layer" style="margin-top: 10px">
                <div class="table-box">
                    <table class="table table-bordered text-center th-vertical-align-middle">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('admin::template.category.table.category_ID') }}</th>
                            <th scope="col">{{ __('admin::template.category.table.category_name') }}</th>
                            <th scope="col">{{ __('admin::template.category.table.create_date') }}</th>
                            <th scope="col">{{ __('admin::template.category.table.category_action') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td style="display: table-cell; vertical-align: middle"><a class="text-info text-decoration-underline cursor-pointer"
                                       href="{{ route('edit', $category->id) }}"
                                    >{{ $category->id }}</a></td>
                                <td style="width: 27%; display: table-cell; vertical-align: middle;">{{ $category->category_name }}</td>
                                <td style="display: table-cell; vertical-align: middle">{{ $category->created_at ? $category->created_at->format('d-m-Y') : '' }}</td>
                                <td style="display: table-cell; vertical-align: middle"><label class="c-switch c-switch-pill c-switch-dark">
                                        <input type="checkbox" class="c-switch-input switch-status" name="status"
                                               data-id="{{ $category->id }}"
                                               @if($category->status == 1) checked @endif>
                                        <span class="c-switch-slider"></span>
                                    </label>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="text-center">
                <p>{{ __('admin::pagination.showing') }} {{$categories->firstItem() ?? 0 . __('admin::pagination.showing_to') . $categories->lastItem()}}
                    {{  __('admin::pagination.showing_of') }} {{$categories->total()}} {{  __('admin::pagination.showing_record') }}</p>
                {{ $categories->render('admin::vendor.pagination.default') }}
            </div>
        </div>
    </div>
@endsection
@section('library-footer')
    <script>
        @if(session()->has('notify'))
        toastr.success('{{ session()->get('notify') }}');
        @endif

        @if(session()->has('notify-error'))
        toastr.error('{{ session()->get('notify-error') }}');
        @endif

        $(document).ready(function () {
            $('.table-box').on('change', '.switch-status', function () {
                let val = $(this).is(':checked');
                let id = $(this).attr('data-id');
                console.log('val', val, id)
                $.ajax({
                    type: 'GET',
                    url: '/api/admin/category/change-status/' + id,
                    data: {"status": val ? 1 : 0},
                    success: (response) => {
                        if (response.meta.code === 200) {
                            toastr.success('{{ __('admin::messages.category.change_status_success') }}');
                        }
                    },
                });
            });
        });
    </script>
@endsection
<style>
    .table-bordered th, .table-bordered td{

    }
</style>
