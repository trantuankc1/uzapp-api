<!-- Modal -->
<div class="modal fade" id="showRecord" tabindex="-1" role="dialog" aria-labelledby="showRecord" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
{{--                <h2 class="modal-title" id="exampleModalLongTitle">Customer list/Customer detail</h2>--}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="modal-body">
                <div class="box">
                    <table class="table table-bordered text-center">
                        <tbody>
                        <tr>
                            <th width="150">{{ __('admin::template.customer.table.customer_ID') }}</th>
                            <td class="text-center" id="showId">--</td>
                        </tr>
                        <tr>
                            <th width="150">{{ __('admin::template.customer.table.customer_name') }}</th>
                            <td colspan="3" id="showName"></td>
                        </tr>
                        <tr>
                            <th width="150">{{ __('admin::template.customer.table.customer_gender') }}</th>
                            <td colspan="3" id="showGender">
                            </td>
                        </tr>
                        <tr>
                            <th width="150">{{ __('admin::template.customer.table.customer_phone') }}</th>
                            <td colspan="3" id="showPhone"></td>
                        </tr>
                        <tr>
                            <th width="150">{{ __('admin::template.customer.table.customer_birthday') }}</th>
                            <td colspan="3" id="showBirthday"></td>
                        </tr>
                        <tr>
                            <th width="150">{{ __('admin::template.customer.table.customer_email') }}</th>
                            <td colspan="3" id="showEmail"></td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <div class="footer-layer text-center">
                    <button type="button"
                            class="btn btn-cancel-default d-inline-flex justify-content-center align-items-center"
                            data-dismiss="modal">{{ __('admin::template.general.btn_cancel') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
