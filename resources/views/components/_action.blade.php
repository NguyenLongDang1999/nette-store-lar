<div class="modal fade" id="action-dialog" tabindex="-1" style="display: none" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            {{ html()->form('POST', '')->id('form-action')->open() }}

            <div class="modal-header">
                <h5 class="modal-title text-capitalize">{{ __('trans.action.confirm') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">{{ __('trans.confirm.delete') }}</div>

            <div class="modal-footer">
                {{ html()->submit(__('trans.action.delete'))->class('btn btn-sm btn-primary')->id('btn-action') }}
                {{ html()->button(__('trans.action.cancel'))->type('button')->class('btn btn-sm btn-label-secondary text-capitalize')->attribute('data-bs-dismiss', 'modal') }}
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
</div>
