<!-- Modal -->
<div class="modal fade popup-confirm" id="popupConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="popupConfirmDelete" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="box">
                    <div id="popupConfirmDeleteTitle">
                        <i class="cil-warning color-warning"></i>
                        <span> {{ __('admin::messages.category.delete_confirm') }}</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <div class="footer-layer btn-confirm text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('admin::template.general.btn_no') }}</button>
                    <a href="{{ route('admin::categoryDelete', $category->id) }}" class="btn btn-submit-color-default">{{ __('admin::template.general.btn_yes') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
