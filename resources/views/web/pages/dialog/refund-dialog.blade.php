<!-- Modal Structure -->
<div id="refund-dialog" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog-centered modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ localize('request_refund')}}</h5>
            </div>
            <div class="modal-body">
                <!-- Hidden input to store order_id -->
                <input type="hidden" name="order_id" id="refund-order-id-input" value="">
                <h4 id="refund-title">{{ localize('request_refund_title') }}</h4>

                <div class="text-center" id="refund-loader" style="display: none">
                    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                </div>
                <div class="text-center" id="refund-pdf-message" style="display: none">
                    <h4 id="refund-pdf-status-message"></h4>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="button is-ghost" id="refund-cancel-btn">{{ localize('no') }}</button>
                <button type="button" class="button is-primary" id="refund-accept-btn">{{ localize('yes') }}</button>
            </div>
        </div>
    </div>
</div>
