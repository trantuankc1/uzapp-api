@extends('admin::dashboard.base')

@section('library-head')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        .table tbody tr td {
            padding: 1.2rem 1rem;
            position: relative;
        }
    </style>
@stop

@section('title', 'Tomosia')

@section('content')
    <div class="container">
        <div class="box" style="background-color: #ffffff; padding: 1rem">
            <form class="el-form" action="{{ route('admin::product.store') }}" method="post">
                @csrf
                <div class="header-layer">
                </div>
                <div class="body-layer">

                    <table class="table table-bordered th-vertical-align-middle">
                        <tbody>
                        <tr>
                            <th width="150">{{ __('admin::template.product.table.product_ID') }}</th>
                            <td class="text-center">--</td>
                        </tr>
                        <tr>
                            <th width="150">{{ __('admin::template.product.table.product_code') }}</th>
                            <td colspan="3">
                                <div class="el-form-item margin-left: 0px; is-required">
                                    <div class="el-form-item__content">
                                        <div class="el-input">
                                            <label for="code" hidden></label>
                                            <input type="text"
                                                   class="form-control @if($errors->first('code') != "") errors @endif"
                                                   id="code" name="code" autocomplete="off"
                                                   value="{{ old('code') ?? '' }}" style="color: black">
                                        </div>
                                        @if($errors->first('code') != "")
                                            <div class="error-block col-12 position-absolute"
                                                 style="left: 0">{{ $errors->first('code') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th width="150"><span class="style_red">*</span>{{ __('admin::template.product.table.product_name') }}</th>
                            <td colspan="3">
                                <div class="el-form-item margin-left: 0px; is-required">
                                    <div class="el-form-item__content">
                                        <div class="el-input">
                                            <label for="productName" hidden></label>
                                            <input type="text" id="productName"
                                                   class="form-control @if($errors->first('productName') != "") errors @endif"
                                                   name="productName" autocomplete="off"
                                                   value="{{ old('productName') ?? '' }}" style="color: black">
                                        </div>
                                        @if($errors->first('productName') != "")
                                            <div class="error-block col-12 position-absolute"
                                                 style="left: 0">{{ $errors->first('productName') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th width="150"><label for="categoryId"><span class="style_red">*</span>{{ __('admin::template.product.table.product_category') }}</label>
                            </th>
                            <td colspan="3">
                                <div class="el-form-item">
                                    <div class="el-form-item__content">
                                        <div class="el-input">
                                            <label for="categoryId" hidden></label>
                                            <select id="categoryId" name="categoryId" style="color: black"
                                                    class="form-control @if($errors->first('categoryId') != "") errors @endif"
                                            >
                                                @foreach($categories as $category)
                                                    <option
                                                            value="{{ $category->id }}">{{$category->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if($errors->first('categoryId') != "")
                                            <div class="error-block col-12 position-absolute"
                                                 style="left: 0">{{ $errors->first('categoryId') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th width="150"><span class="style_red">*</span>{{ __('admin::template.product.table.product_price') }}</th>
                            <td colspan="3">
                                <div class="el-form-item margin-left: 0px; is-required">
                                    <div class="el-form-item__content">
                                        <div class="el-input">
                                            <label for="productPrice" hidden></label>
                                            <input type="text" id="productPrice"
                                                   class="form-control @if($errors->first('productPrice') != "") errors @endif"
                                                   name="productPrice" autocomplete="off"
                                                   value="{{ old('productPrice') ?? '' }}" style="color: black">
                                        </div>
                                        @if($errors->first('productPrice') != "")
                                            <div class="error-block col-12 position-absolute"
                                                 style="left: 0">{{ $errors->first('productPrice') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th width="150"><span class="style_red">*</span>{{ __('admin::template.product.table.product_amount') }}</th>
                            <td colspan="3">
                                <div class="el-form-item margin-left: 0px; is-required">
                                    <div class="el-form-item__content">
                                        <div class="el-input">
                                            <label for="amount" hidden></label>
                                            <input type="text"
                                                   class="form-control @if($errors->first('amount') != "") errors @endif"
                                                   id="amount" name="amount"
                                                   autocomplete="off" value="{{ old('amount') ?? '' }}" style="color: black">
                                        </div>
                                        @if($errors->first('amount') != "")
                                            <div class="error-block col-12 position-absolute"
                                                 style="left: 0">{{ $errors->first('amount') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th width="150"><span class="style_red">*</span>{{ __('admin::template.product.table.product_description') }}</th>
                            <td colspan="3">
                                <div class="el-form-item margin-left: 0px; is-required">
                                    <div class="el-form-item__content">
                                        <div class="el-input">
                                            <label for="summernote" hidden></label>
                                            <textarea id="summernote" name="description"
                                                      rows="5">{{ old('description') ?? '' }}</textarea>
                                        </div>
                                        @if($errors->first('description') != "")
                                            <div class="error-block col-12 position-absolute"
                                                 style="left: 0">{{ $errors->first('description') }}</div>
                                        @endif

                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered mt-5">
                        <tbody>
                        <tr>
                            <th class="text-center" style="background-color: #e0e0e0">{{ __('admin::template.product.table.image_product') }}</th>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <div class="box p-0">
                                        <div class="error-block image col-12"></div>
                                        <div class="layer-upload">
                                            <div class="box-show-upload d-none">
                                                <img src="" alt="">
                                                <span class="box-show-upload_item-action">
                                                <span class="item-delete"><i class="cil-trash"></i></span>
                                            </span>
                                                <label for="image" hidden></label>
                                                <input type="text" id="image" name="imageFile" hidden>
                                            </div>
                                            <div class="box-upload d-flex justify-content-center align-items-center cursor-pointer"
                                                 for="choseImg">
                                                <i class="cil-plus"></i>
                                                <input type="file" id="choseImg" hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="footer-layer text-center">
                    <a href="{{ route('admin::product.index') }}"
                       class="btn btn-cancel-default d-inline-flex justify-content-center align-items-center">{{ __('admin::template.general.btn_cancel') }}</a>
                    <button type="button" class="btn btn-color-default btn-submit" id="btnCreate"
                            data-toggle="modal" data-target="#popupConfirm" style="background-color: #3ab6ba">{{ __('admin::template.general.btn_create') }}
                    </button>
                </div>
                @include('admin::pages.product.layouts.popup')
            </form>
        </div>
    </div>
@endsection
@section('library-footer')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/upload-image.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                height: 150
            });

            $('#btnCreate').on('click', function () {
                $('#popupConfirmTitle span').html('{{ __('admin::messages.product.create_confirm') }}');
            });

            $('.btn-yes').on('click', function () {
                $('form').submit();
            });
        });
    </script>
@stop
