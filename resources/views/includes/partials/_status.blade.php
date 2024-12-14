<style>
    td {
        font-size: 1.2rem;
    }
    .text-right{
        text-align: right;
    }
    .border-bottom{
        border-bottom: 1px solid #ccc;
    }

    .status-bar.failed .failed-options {
    list-style-type: none;  /* Removes the bullet points */
    padding-left: 0;        /* Removes the default padding */
}

.status-bar.failed .failed-options li {
    margin-left: 0;         /* Ensures the list items have no left margin */
    padding-left: 0;        /* Ensures the list items have no left padding */
}

.status-bar.failed .failed-options a {
    color: inherit;         /* Keeps the link color consistent with the surrounding text */
}

.status-bar.failed .failed-options a {
    text-decoration: underline;  /* Optional: Add underline on hover if desired */
}

</style>
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div style="width: 50%;float:left">
                    <h3 class=""><b>{{ localize('downloads_page') }}</b></h3>
                </div>
                <div style="width: 50%;float:left">
                    <div id="loading" style="display:none; z-index: 1000;">
                        <h3>Loading...</h3>
                    </div>
                </div>

                <div style="clear: both" class="table-responsive">

                    <table class="table table-bordered table-hover" id="priceTable">
                        <tbody id="orderTableBody">
                            <!-- Orders will be loaded here via AJAX -->
                        </tbody>
                    </table>
                    <!-- Pagination links will be loaded here -->
                    <div id="paginationLinks" class="d-flex justify-content-center"></div>
                </div>
            </div>
        </div>
    </div>
</div>
