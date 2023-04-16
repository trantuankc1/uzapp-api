<!-- Modal -->
<div class="modal fade popup-confirm" id="popupConfirm" tabindex="-1" role="dialog" aria-labelledby="popupConfirm" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="box">
                    <div id="popupConfirmTitle">
                        <span></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <div class="footer-layer btn-confirm text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin::template.general.btn_no') }}</button>
                    <button type="button" class="btn btn-submit-color-default btn-yes">{{ __('admin::template.general.btn_yes') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
