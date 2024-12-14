<!-- Regenerate PDF Modal -->
<div id="regenerate-pdf-dialog" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog-centered modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ localize('regenerate_pdf') }}</h5>
            </div>
            <div class="modal-body">
                <!-- Loader -->
                <div class="text-center" id="regenerate-pdf-loader" style="display: none">
                    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                    <p>{{ localize('requesting_please_wait') }}</p>
                </div>
                <div class="text-center" id="regenerate-pdf-message" style="display: none">
                    <p id="regenerate-pdf-status-message-success">{{ localize('pdf_regeneration_success') }}</p>
                    <p id="regenerate-pdf-status-message-error">{{ localize('pdf_regeneration_error') }}</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="button is-ghost" id="regenerate-pdf-close-btn" style="display: none">{{ localize('close') }}</button>
            </div>
        </div>
    </div>
</div>
