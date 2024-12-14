<!-- Modal -->
<div class="modal fade" id="viewModal">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{localize('QR Results')}}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="viewData">

                </div>
                {{-- {!! DNS1D::getBarcodeSVG('4445645656', 'C128',1,33,'black', false) !!} --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{localize('Close')}}</button>
            </div>
        </div>
    </div>
</div>
