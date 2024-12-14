<div class="modal fade modal-lg" id="downloadModal" style="overflow: hidden">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">PDF is downloading, don't close the tab</h4>
                <p>
                    If the document size is large, it may take some time to download
                </p>
            </div>
            <!-- Modal body -->
            <div class="modal-body ajaxModalBody text-center" style="overflow: hidden">
                {{--                <img id="download-loader" src="{{ asset('web/download.gif') }}" --}}
                {{--                     loading="lazy" --}}
                {{--                     alt="" --}}
                {{--                /> --}}

                <div class="progress" style="height: 24px; font-size: 1.5rem;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</div>
                </div>

                <h2 class="text-center mt-5">
                    <div class="spinner-border text-success"></div> Downloading...
                </h2>
            </div>
        </div>
    </div>
</div>



<div class="modal fade modal-lg" id="notificationModalForPdfGeneration" style="overflow: hidden">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Congratulations! Your document has started to generate. Please check the status.</h3><br>
            </div>
            <div class="modal-body">
                <h4>
                    If the document size is large, it may take some time to download
                </h4>
            </div>
            <!-- Modal body -->

        </div>
    </div>
</div>


<div class="modal fade modal-lg" id="downloadModalRedis" style="overflow: hidden">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">PDF is being genereated in the background, please check in the status.</h3><br>

            </div>
            <div class="modal-body">
                <h4>
                    If the document size is large, it may take some time to download
                </h4>
            </div>
            <!-- Modal body -->

        </div>
    </div>
</div>


<div class="modal fade modal-lg" id="ajaxModal" style="overflow: hidden">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body ajaxModalBody" style="overflow: hidden">
                <h2 class="text-center">
                    <button type="button" class="btn btn-block btn-success fireAjax">
                        Click to Download the pdf
                    </button>
                </h2>
            </div>
        </div>
    </div>
</div>
