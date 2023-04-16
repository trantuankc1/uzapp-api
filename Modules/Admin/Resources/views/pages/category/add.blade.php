@extends('admin::dashboard.base')
@section('title', 'Tomosia')
@section('library-head')
    <style>
        .table tbody tr td {
            position: relative;
        }
    </style>
@stop
@section('content')
    <div class="container">
        <div class="box">
            <form action="{{ route('create') }}" name="" method="post">
                @csrf
                <table class="table table-bordered text-center th-vertical-align-middle">
                    <tr>
                        <th width="150">{{ __('admin::template.category.table.ID') }}</th>
                        <td class="text-center">---</td>
                    </tr>
                    <tr>
                        <th width="150">{{ __('admin::template.category.table.category_name') }}</th>
                        <td>
                            <div>
                                <input type="text"
                                       class="input_form form-control @if($errors->first('note') != "") errors @endif"
                                       name="category_name"
                                       value="{{ old('category_name') }}" style="color: black">
                                @if($errors->first('category_name') != "")
                                    <div class="error-block col-12 position-absolute"
                                         style="text-align: initial;margin-left: -15px">{{ $errors->first('category_name') }}</div>
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th width="150">{{ __('admin::template.category.table.category_note') }}</th>
                        <td>
                            <textarea type="text"
                                      class="input_form form-control @if($errors->first('note') != "") errors @endif"
                                      name="note"
                             style="color: black">{{ old('note') }}</textarea>
                            @if($errors->first('note') != "")
                                <div class="error-block col-12 position-absolute">{{ $errors->first('note') }}</div>
                            @endif
                        </td>

                    </tr>
                </table>

                <div class="footer-layer text-center">
                    <a class="btn btn-cancel-default d-inline-flex justify-content-center align-items-center"
                       href="{{ route('category') }}" style="color: white">{{ __('admin::template.general.btn_cancel') }}</a>
                    <button id="btnCreate" class="btn" type="button" style="background-color: #3ab6ba; color: white;"
                            data-toggle="modal" data-target="#popupConfirm">
                        {{ __('admin::template.general.btn_create') }}
                    </button>
                </div>
                @include('admin::pages.category.layouts.popup')
            </form>
        </div>
    </div>

@endsection
@section('library-footer')
    <script>
        $(document).ready(function () {
            $('#btnCreate').on('click', function () {
                $('#popupConfirmTitle span').html('{{ __('admin::messages.category.create_confirm') }}');
            });

            $('.btn-yes').on('click', function () {
                $('form').submit();
            });
        });
    </script>
@endsection
