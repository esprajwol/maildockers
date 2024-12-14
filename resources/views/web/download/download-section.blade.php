<style>
        /* The popup (background) */
    .popup {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    /* Popup content */
    .popup-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 500px;
    }

    /* Close button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

</style>

<div class="container">
    <div class="row">
        <div class=" shadow">
            <div class="overlay-layout show-layer" id="overlay-layout">
                <div class="row success-dilog show-layer" id="success-dilog">
                    <div class="col">
                        <i class="fa-solid fa-circle-check fa-2xl text-orange"></i>
                        <p class="paragraph">Done!</p>
                        <h3 class="title">The document is ready</h3>
                        <h3 class="title">Total Message found ({{message_count()}})</h3>
                        {{--                        <button type="submit" class="btn text-button">--}}
                        {{--                            Pay £9.90 to Download PDF--}}
                        {{--                        </button>--}}
                        <button id="paymentButton" class="btn text-button">Pay £9.90 to Download PDF</button>

                        <!-- Popup Overlay -->
                        <div id="privacyPopup" class="popup">
                            <div class="popup-content">
                                <span class="close">&times;</span>
                                <h2>Privacy Policy</h2>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                    when an unknown printer took a galley of type and scrambled it to make a type
                                    specimen book.
                                    It has survived not only five centuries, but also the leap into electronic
                                    typesetting,
                                    remaining essentially unchanged.

                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                    when an unknown printer took a galley of type and scrambled it to make a type
                                    specimen book.
                                    It has survived not only five centuries, but also the leap into electronic
                                    typesetting,
                                    remaining essentially unchanged.

                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                    when an unknown printer took a galley of type and scrambled it to make a type
                                    specimen book.
                                    It has survived not only five centuries, but also the leap into electronic
                                    typesetting,
                                    remaining essentially unchanged.
                                </p>
                                <form action="{{ route('stripe.checkout.session') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                       Agree & Continue for Payment
                                    </button>
                                </form>
                            </div>
                        </div>
                        <br>
                        <a href="{{route('cancelSession')}}" class="text-link"
                           id="download-link-with-logout">Cancel</a>
                    </div>
                </div>

                <div class="row faild-dilog" id="faild-dilog">
                    <div class="col">
                        <h3 class="title-1" id="faild-dilog-msg">Incorrect
                            information for example@gmail.com</h3>
                        <h3 class="title-2">Please try again</h3>
                    </div>
                </div>
            </div>
            <div class="overlay-layout" id="outlook-overlay-layout">
                <div class="row loading-dilog" id="outlook-loading-dilog">
                    <div class="col">
                        <h3 class="title-1">We are creating the document -
                            please be patient, this may take some time.</h3>
                        <h3 class="title-2">Extract message number &nbsp;<span
                                id="outlook-data-count-value">0</span></h3>

                        <div class="loader"></div>
                    </div>
                </div>

                <div class="row success-dilog" id="outlook-success-dilog">
                    <div class="col">
                        <i class="fa-solid fa-circle-check fa-2xl text-orange"></i>
                        <p class="paragraph">Done!</p>
                        <h3 class="title">The document is ready</h3>

                        <a href="#" class="text-link" id="outlook-download-link"
                           data-download-url="https://proofspdf.com/download"
                           data-destroy-url="https://proofspdf.com/destroy">Download
                            &amp; Continue</a>
                        <br>
                        <a href="#" class="text-link"
                           id="outlook-download-link-with-logout"
                           data-download-url="https://proofspdf.com/download"
                           data-destroy-url="https://proofspdf.com/destroy"
                           data-user-logout="https://proofspdf.com/oauth/gmail/logout">Download
                            &amp; Logout</a>
                    </div>
                </div>

                <div class="row faild-dilog" id="outlook-faild-dilog">
                    <div class="col">
                        <h3 class="title-1" id="outlook-faild-dilog-msg">
                            Incorrect information for example@gmail.com</h3>
                        <h3 class="title-2">Please try again</h3>
                    </div>
                </div>
            </div>

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <div class="nav-link active" id="nav-google-tab"
                         data-bs-toggle="tab" data-bs-target="#nav-google"
                         type="button" role="tab" aria-controls="nav-google"
                         aria-selected="true">
                        <img
                            src="https://proofspdf.com/web/assets/img/gmail.png"
                            alt="gmail"> Gmail
                    </div>
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-google"
                     role="tabpanel" aria-labelledby="nav-google-tab">
                    <h1 class="heading">Email to pdf generator</h1>
                    <p class="form-paragraph">Enter the addresses of both
                        parties for correspondence</p>
                    <form
                        data-action="https://proofspdf.com/generate/gmail/extract"
                        id="filter-form" data-login-state="1"
                        data-auth-url="https://proofspdf.com/oauth/gmail">
                        <input type="hidden" name="_token"
                               value="67nkETtNauziLBuvatpXKhh2vL8GNbVYVgYIsRzR">
                        <input type="hidden" name="_method" value="POST">
                        <div class="row flex-column flex-md-row mb-3">
                            <div class="col col-md-4">
                                <input type="email" id="your_email"
                                       class="form-control " name="your_email"
                                       placeholder="Your Email (Any Google Suite)"
                                       value="maynuddinhsn@gmail.com"
                                       autocomplete="off" required="">
                                <small class="text-danger"></small>
                            </div>
                            <p class="col-auto form-paragraph mb-0 mt-3 mb-sm-0">
                                and</p>
                            <div class="col col-md-4">
                                <input type="email" id="email_from"
                                       class="form-control " name="email_from"
                                       placeholder="Your Colleague's Email (Any Email)"
                                       value="" autocomplete="off" required="">
                                <small class="text-danger"></small>
                            </div>
                        </div>

                        <p class="form-paragraph">Important reminder - We
                            support only with email boxes that works with Google
                            Suite(Gmail). For example: myemail@GMAIL.com or
                            name@ANYDOMAIN.com </p>

                        <div class="collapse-tabs mt-5">
                            <!-- Collapse Tabs 1 -->
                            <p class="collapse-title mt-5 mb-3"
                               data-bs-toggle="collapse"
                               href="#collapseKeyWords" role="button"
                               aria-expanded="false"
                               aria-controls="collapseKeyWords">
                                Keywords to search </p>
                            <div class="collapse" id="collapseKeyWords">
                                <div class="row flex-column">
                                    <div class="col col-md-4 mb-4">
                                        <label for="inc_keywords"
                                               class="form-labels">Separate
                                            keywords with commas</label>
                                        <input type="text" class="form-control "
                                               id="inc_keywords"
                                               name="inc_keywords"
                                               placeholder="keyword a, keyword b, keyword c"
                                               autocomplete="off">
                                        <small class="text-danger"></small>
                                    </div>
                                    <div class="col col-md-4 mb-4">
                                        <label for="exc_keywords"
                                               class="form-labels">Keywords to
                                            Exclude?</label>
                                        <input type="text" class="form-control "
                                               id="exc_keywords"
                                               name="exc_keywords"
                                               placeholder="keyword a, keyword b, keyword c"
                                               autocomplete="off">
                                        <small class="text-danger"></small>
                                    </div>
                                </div>
                            </div>

                            <!-- Collapse Tabs 2 -->
                            <p class="collapse-title mt-3"
                               data-bs-toggle="collapse"
                               href="#collapseTimeFrame" role="button"
                               aria-expanded="false"
                               aria-controls="collapseTimeFrame">
                                Search within a certain time frame </p>
                            <div class="collapse" id="collapseTimeFrame">
                                <div class="row mb-4">
                                    <p class="col-auto form-paragraph mb-0 mt-3">
                                        Starts</p>
                                    <div class="col col-md-2">
                                        <input type="text"
                                               class="form-control datepicker hasDatepicker"
                                               id="start_date" name="start_date"
                                               placeholder="yyyy-mm-dd"
                                               autocomplete="off">
                                        <small class="text-danger"></small>
                                    </div>
                                    <p class="col-auto form-paragraph mb-0 mt-3">
                                        ends</p>
                                    <div class="col col-md-2">
                                        <input type="text"
                                               class="form-control datepicker hasDatepicker"
                                               id="end_date" name="end_date"
                                               placeholder="yyyy-mm-dd"
                                               autocomplete="off">
                                        <small class="text-danger"></small>
                                    </div>
                                </div>
                            </div>

                     
  <!-- Collapse Tabs 3 -->
                            <p class="collapse-title mt-5"
                               data-bs-toggle="collapse"
                               href="#collapseLanguage" role="button"
                               aria-expanded="false"
                               aria-controls="collapseLanguage">
                                Document language </p>
                            <div class="collapse" id="collapseLanguage">
                                <div class="row mb-3">
                                    <div class="col col-md-2">
                                        <select
                                            class="form-select form-select-lg "
                                            name="language"
                                            aria-label=".form-select-lg example">
                                            <option selected="" value="en">
                                                English
                                            </option>
                                            <option value="heb">Hebrew</option>
                                        </select>
                                        <small class="text-danger"></small>
                                    </div>
                                </div>
                            </div>
                            
                        </div>


                        <div class="form-group">
                            <button class="form-btn" id="btn-generate"
                                    type="submit">Generate
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    /* The popup (background) */
    .popup {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    /* Popup content */
    .popup-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 500px;
    }

    /* Close button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        margin-top: -20px;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Show the popup when the payment button is clicked
        $("#paymentButton").click(function () {
            $("#privacyPopup").show();
        });

        // Hide the popup when the close button is clicked
        $(".close").click(function () {
            $("#privacyPopup").hide();
        });

        // Hide the popup when the "I Accept" button is clicked
        $("#acceptPrivacy").click(function () {
            $("#privacyPopup").hide();
            // Proceed with payment logic here
            alert("Proceeding with payment...");
        });

        // Hide the popup when clicking outside the popup content
        $(window).click(function (event) {
            if ($(event.target).is("#privacyPopup")) {
                $("#privacyPopup").hide();
            }
        });
    });
</script>
