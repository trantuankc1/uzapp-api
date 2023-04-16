@extends('admin::dashboard.base')

@section('library-head')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        .table tbody tr td {
            padding: 1.2rem 1rem;
            position: relative;
        }
        .table tbody tr th {
            text-align: center;
        }
    </style>
@stop

@section('title', 'Product Edit')

@section('content')
    <div class="container">
        <div class="box" style="background-color: #ffffff; padding: 1rem">
            <form class="el-form" action="{{ route('admin::product.update', $item->id) }}" method="post">
                @csrf
                <div class="header-layer">
                </div>
                <div class="body-layer">

                    <table class="table table-bordered th-vertical-align-middle">
                        <tbody>
                        <tr>
                            <th width="150">{{ __('admin::template.product.table.product_ID') }}</th>
                            <td class="text-center">{{ $item->id }}</td>
                        </tr>
                        <tr>
                            <th width="150">{{ __('admin::template.product.table.product_code') }}</th>
                            <td colspan="3">
                                <div class="el-form-item margin-left: 0px; is-required">
                                    <div class="showInfo">{{ $item->code }}</div>
                                    <div class="el-form-item__content">
                                        <div class="el-input">
                                            <label for="code" hidden></label>
                                            <input type="text"
                                                   class="form-control @if($errors->first('code') != "") errors @endif"
                                                   id="code" name="code" autocomplete="off"
                                                   value="{{ $errors->first('code') != "" ? old('code') : old('code') ?? $item->code }}" style="color: black">
                                        </div>
                                        @if($errors->first('code') != "")
                                            <div class="error-block col-12 position-absolute">{{ $errors->first('code') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th width="150"><span class="style_red">*</span>{{ __('admin::template.product.table.product_name') }}</th>
                            <td colspan="3">
                                <div class="el-form-item margin-left: 0px; is-required">
                                    <div class="showInfo">{{ $item->name }}</div>
                                    <div class="el-form-item__content">
                                        <div class="el-input">
                                            <label for="productName" hidden></label>
                                            <input type="text" id="productName"
                                                   class="form-control @if($errors->first('productName') != "") errors @endif"
                                                   name="productName" autocomplete="off"
                                                   value="{{ $errors->first('productName') != "" ? old('productName') : old('productName') ?? $item->name }}" style="color: black">
                                        </div>
                                        @if($errors->first('productName') != "")
                                            <div class="error-block col-12 position-absolute">{{ $errors->first('productName') }}</div>
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
                                        <div class="showInfo">{{ $item->category->category_name }}</div>
                                        <div class="el-input">
                                            <label for="categoryId" hidden></label>
                                            <select id="categoryId" name="categoryId" style="color: black"
                                                    class="form-control @if($errors->first('categoryId') != "") errors @endif"
                                            >
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                            @if($category->id == $item->category_id) selected @endif>{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if($errors->first('categoryId') != "")
                                            <div
                                                class="error-block col-12 position-absolute">{{ $errors->first('categoryId') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th width="150"><span class="style_red">*</span>{{ __('admin::template.product.table.product_price') }}</th>
                            <td colspan="3">
                                <div class="el-form-item margin-left: 0px; is-required">
                                    <div class="showInfo">{{ $item->price }}</div>
                                    <div class="el-form-item__content">
                                        <div class="el-input">
                                            <label for="productPrice" hidden></label>
                                            <input type="text" id="productPrice"
                                                   class="form-control @if($errors->first('productPrice') != "") errors @endif"
                                                   name="productPrice" autocomplete="off"
                                                   value="{{ $errors->first('productPrice') != "" ? old('productPrice') : old('productPrice') ?? $item->price }}" style="color: black">
                                        </div>
                                        @if($errors->first('productPrice') != "")
                                            <div class="error-block col-12 position-absolute">{{ $errors->first('productPrice') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th width="150"><span class="style_red">*</span>{{ __('admin::template.product.table.product_amount') }}</th>
                            <td colspan="3">
                                <div class="el-form-item margin-left: 0px; is-required">
                                    <div class="showInfo">{{ $item->quantity }}</div>
                                    <div class="el-form-item__content">
                                        <div class="el-input">
                                            <label for="amount" hidden></label>
                                            <input type="text"
                                                   class="form-control @if($errors->first('amount') != "") errors @endif"
                                                   id="amount" name="amount" autocomplete="off"
                                                   value="{{ $errors->first('amount') != "" ? old('amount') : old('amount') ?? $item->quantity }}" style="color: black">
                                        </div>
                                        @if($errors->first('amount') != "")
                                            <div class="error-block col-12 position-absolute">{{ $errors->first('amount') }}</div>
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
                                        <div class="showInfo">{!! $item->description !!}</div>
                                        <div class="el-input">
                                            <label for="summernote" hidden></label>
                                            <textarea id="summernote" name="description"
                                                      rows="5">{{ old('description') ?? $item->description }}</textarea>
                                        </div>
                                        @if($errors->first('description') != "")
                                            <div class="error-block col-12 position-absolute">{{ $errors->first('description') }}</div>
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
                                            <div class="box-show-upload @if(!$item->thumbnail) d-none @endif">
                                                <img src="{{ $item->thumbnail }}" alt="">
                                                <span class="box-show-upload_item-action d-none">
                                                <span class="item-delete"><i class="cil-trash"></i></span>
                                            </span>
                                                <label for="image" hidden></label>
                                                <input type="text" id="image" name="imageFile" hidden>
                                            </div>
                                            <div class="box-upload d-none @if($item->thumbnail) invisible @endif justify-content-center align-items-center cursor-pointer"
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
                <div class="footer-layer text-center" id="footerLayerShow">
                    <div class="mb-4">
                        <a href="{{ route('admin::product.index') }}"
                           class="btn btn-secondary d-inline-flex justify-content-center align-items-center">{{ __('admin::template.general.btn_cancel') }}</a>
                    </div>
                    <button id="btnEdit" type="button"
                            class="btn btn-color-default btn-submit d-inline-flex justify-content-center align-items-center" style="background-color: #3ab6ba">
                        {{ __('admin::template.general.btn_edit') }}
                    </button>
                    <button type="button" class="btn btn-color-default btn-submit" id="btnDelete"
                            data-action="{{ route('admin::api.product.delete', $item->id) }}" style="background-color: #3ab6ba">{{ __('admin::template.general.btn_delete') }}
                    </button>
                </div>
                <div class="footer-layer text-center d-none" id="footerLayerEdit">
                    <a href="{{ route('admin::product.index') }}"
                       class="btn btn-secondary d-inline-flex justify-content-center align-items-center">{{ __('admin::template.general.btn_cancel') }}</a>
                    <button type="button" class="btn btn-color-default btn-submit"
                            data-toggle="modal" data-target="#popupConfirm">{{ __('admin::template.general.btn_update') }}
                    </button>
                </div>
                @include('admin::pages.product.layouts.popup')
                @include('admin::pages.product.layouts.popup-delete')
            </form>
        </div>
    </div>
@endsection
@section('library-footer')
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/upload-image.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        @if(session()->has('notify'))
        toastr.success('{{ session()->get('notify') }}');
        @endif

        let popupConfirm = new coreui.Modal(document.getElementById('popupConfirm'), {});
        let popupConfirmDelete = new coreui.Modal(document.getElementById('popupConfirmDelete'), {});

        $(document).ready(function () {
            @if($errors->all())
            $('.showInfo').addClass('d-none');
            @else
            $('.el-input').addClass('d-none');
            @endif

            $('#summernote').summernote({
                height: 150
            });

            $('#btnEdit').on('click', function () {
                $('.showInfo').css('display', 'none');
                $('.el-input').removeClass('d-none');
                $('#footerLayerShow').addClass('d-none');
                $('#footerLayerEdit').removeClass('d-none');
                $('#popupConfirmTitle span').html('{{ __('admin::messages.product.update_confirm') }}');
                $('.box-show-upload_item-action').removeClass('d-none');
                $('.box-upload').removeClass('d-none').addClass('d-flex ');
            });

            $('#btnDelete').on('click', function () {
                popupConfirmDelete.show();
            })

            $('.btn-yes').on('click', function () {
                $('form').submit();
            });
        });
    </script>
@stop
