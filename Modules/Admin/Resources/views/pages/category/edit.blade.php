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
            <form id="updateForm" action="{{ route('admin::categoryUpdate', $category->id) }}" name=""
                  method="post">
                @method('PUT')
                @csrf
                <table class="table table-bordered text-center th-vertical-align-middle">
                    <tr>
                        <th width="150">ID</th>
                        <td>{{ $category->id }}</td>
                    </tr>

                    <tr>
                        <th width="150">{{ __('admin::template.category.table.category_name') }}</th>
                        <td>
                            <div class="showInfo">{{ $category->category_name }}</div>
                            <div class="el-input" style="height: 45px">
                                <input type="text" class="input_form form-control" name="category_name"
                                       value="{{ $errors->first('category_name') != "" ? old('category_name') : old('category_name') ?? $category->category_name }}" style="color: black">
                                @if($errors->first('category_name') != "")
                                    <div
                                        class="error-block col-12 position-absolute"
                                        style="text-align: initial; margin-left: -15px;">{{ $errors->first('category_name') }}
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th width="150">{{ __('admin::template.category.table.category_note') }}</th>
                        <td>
                            <div class="showInfo">{!! $category->note !!}</div>
                            <div class="el-input">
                            <textarea type="text" class="input_form form-control" name="note" style="color: black"
                            >{{ $category->note }}</textarea>
                            </div>
                        </td>
                    </tr>

                </table>
                <div class="button">


                    <div class="footer-layer text-center" id="footerLayerShow">
                        <div class="mb-4">
                            <a href="{{ route('category') }}"
                               class="btn btn-secondary d-inline-flex justify-content-center align-items-center">{{ __('admin::template.general.btn_cancel') }}</a>
                        </div>
                        <button id="btnEdit" type="button"
                                class="btn btn-color-default btn-submit d-inline-flex justify-content-center align-items-center">
                            {{ __('admin::template.general.btn_edit') }}
                        </button>
                        <button type="button" id="btnDelete"
                                class="btn btn-color-default btn-submit"
                                data-id="{{$category->id}}">
                            {{ __('admin::template.general.btn_delete') }}
                        </button>
                    </div>
                    <div class="footer-layer text-center d-none" id="footerLayerEdit">
                        <a href="{{ route('category') }}"
                           class="btn btn-secondary d-inline-flex justify-content-center align-items-center">Cancel</a>
                        <button id="btnEdit" class="btn btn-color-default btn-submit" type="button"
                                data-toggle="modal" data-target="#popupConfirm">
                            {{ __('admin::template.general.btn_update') }}
                        </button>
                    </div>
                </div>
                @include('admin::pages.category.layouts.popup')
                @include('admin::pages.category.layouts.popup-delete')
            </form>
        </div>
    </div>
@endsection
@section('library-footer')
    <script>
        @if(session()->has('notify'))
        toastr.success('{{ session()->get('notify') }}');
        @endif

        let popupConfirmDelete = new coreui.Modal(document.getElementById('popupConfirmDelete'), {});


        $(document).ready(function () {
            @if($errors->all())
            $('.showInfo').addClass('d-none');
            @else
            $('.el-input').addClass('d-none');
            @endif
            // $('#btnEdit').on('click', function () {
            //     $('#popupConfirmTitle span').html('Do you want to update ?');
            // });

            $('#btnDelete').on('click', function () {
                popupConfirmDelete.show();
            })

            $('.btn-yes').on('click', function () {
                $('form').submit();
            });

            $('#btnEdit').on('click', function () {
                $('.showInfo').css('display', 'none');
                $('.el-input').removeClass('d-none');
                $('#footerLayerShow').addClass('d-none');
                $('#footerLayerEdit').removeClass('d-none');
                $('#popupConfirmTitle span').html('{{ __('admin::messages.category.update_confirm') }}');
            });
        });
    </script>
@endsection
