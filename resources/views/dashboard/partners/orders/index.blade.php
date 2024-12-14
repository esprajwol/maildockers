@extends('dashboard.layouts.main')

@section('title', ' - Order Lists')

@push('extra-styles')
    <style>
        .card-title-holder {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .card-title-holder .card-title {
            margin-bottom: 0px;
        }

        .table img.img-holder {
            border-radius: unset;
            width: 8mm;
            height: 8mm;
            box-sizing: border-box;
        }

        .update-section {
            border-radius: 3px;
            background: #f3f3f3;
            padding: 10px;
        }

        .update-section > p {
            font-size: 12px;
            line-height: 18px;
            font-weight: 600;
            color: #555;
            padding: 10px;
            background: #fff;
            border-radius: 3px;
        }

        .update-section span {
            font-weight: 700;
            color: #333;
        }

        .top-infos {
            display: flex;
            justify-content: flex-start;
            align-content: center;
        }

        .info-data {
            flex: 3;
        }

        .qr-holder {
            flex: 1;
            overflow: hidden;
            padding: 5px;
            background: #fff;
            border-radius: 3px;
            margin-right: 10px;
        }

        .qr-holder > img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .informations > h4 {
            margin-top: 20px;
            text-indent: 20px;
        }

        .show-card {
            background: #fff;
            box-shadow: 0px 14px 80px rgba(34, 35, 58, 0.5);
            max-width: 100%;
            display: flex;
            flex-direction: row;
            border-radius: 6px;
            position: relative;
            overflow: hidden;
        }

        .show-card h2 {
            margin: 0;
            padding: 0 1rem;
        }

        .show-card .title {
            padding: 1rem;
            text-align: right;
            font-weight: bold;
            font-size: 12px;
        }

        .show-card .desc {
            padding: 0.5rem 1rem;
            font-size: 12px;
        }

        .show-card .actions {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            align-items: center;
            padding: 0.5rem 1rem;
        }

        .show-card svg {
            width: 85px;
            height: 85px;
            margin: 0 auto;
        }

        .img-avatar {
            width: 60px;
            height: 60px;
            position: absolute;
            border-radius: 50%;
            border: 2px solid rgb(255, 255, 255);
            background-image: linear-gradient(-60deg, #16a085 0%, #f4d03f 100%);
            top: 15px;
            left: 129px;
            overflow: hidden;
        }

        .img-avatar > img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .show-card-text {
            display: grid;
            grid-template-columns: 1fr 2fr;
        }

        .title-total {
            padding: 2.5em 1.5em 1.5em 1.5em;
        }

        path {
            fill: white;
        }

        .img-portada {
            width: 100%;
        }

        .portada {
            width: 100%;
            height: 100%;
            background-position: bottom center;
            background-size: cover;
        }

        button {
            border: none;
            background: none;
            font-size: 24px;
            color: #8bc34a;
            cursor: pointer;
            transition: 0.5s;
        }

        button:hover {
            color: #4CAF50;
            transform: rotate(22deg);
        }

        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
        }
        /* General styling for the container */
        .dt-length, .dt-search {
            display: flex;
            align-items: center;
        }

        /* Styling the label */
        .dt-length .form-label, .dt-search .form-label {
            margin-right: 8px;
            color: #0039a2;
            font-weight: bold;
        }

        /* Styling the select and input elements */
        .dt-length select, .dt-search input {
            outline: 1px solid #0039a2;
            color: #000000;
            padding: 4px 8px;
            border-radius: 4px;
        }

        /* Styling the select box */
        .dt-length select {
            margin-left: 4px;
        }

        /* Additional margin for the search input */
        .dt-search input {
            margin-left: 4px;
        }

        /* Responsive adjustments */
        @media (max-width: 767px) {
            .dt-length, .dt-search {
                flex-direction: column;
                align-items: flex-start;
            }

            .dt-length .form-label, .dt-search .form-label {
                margin-bottom: 4px;
            }

            .dt-length select, .dt-search input {
                margin-left: 0;
            }
        }

    </style>
    {{--per page and search box desgn--}}

@endpush

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h6>total documents......... <span class="text-danger totalDocuments">{{$orderCount->count()}}</span></h6>
                            <h6>total pages.................. <span
                                    class="text-danger totalMessages">{{$orderCount->sum('total_messages')}}</span></h6>
                            <h6>total income................ £
                                <span class="text-danger totalAmounts"> {{round_value($orderCount->sum('paid_amount'))}}</span></h6>
                        </div>
                        <div class="col-md-6 ">
                            <div class="search-section float-end">
                                <select name="date_search" id="date_search" class="form-select form-select-sm"
                                        style="outline: 1px solid #0039a2; color: #000000;">
                                    <option value="1"
                                            data-start="{{ getStartAndEndDate(0)[0] }}"
                                            data-end="{{ getStartAndEndDate(0)[1] }}">
                                        Today
                                    </option>
                                    <option value="1"
                                            data-start="{{ getStartAndEndDate(1)[0] }}"
                                            data-end="{{ getStartAndEndDate(1)[1] }}">
                                        Yesterday
                                    </option>
                                    <option value="1"
                                            data-start="{{ getStartAndEndDate(7)[0] }}"
                                            data-end="{{ getStartAndEndDate(7)[1] }}">
                                        Last 7 days
                                    </option>
                                    <option value="1"
                                            data-start="{{ \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d') }}"
                                            data-end="{{ getStartAndEndDate(1,2)[1] }}">
                                        This Month
                                    </option>

                                    <option value="1"
                                            data-start="{{ \Carbon\Carbon::now()->subMonth(12)->format("Y-m-d") }}"
                                            data-end="{{ getStartAndEndDate(12,2)[1] }}">
                                        Last 12 Month
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="row mt-2 justify-content-between">
                            <div class="col-md-auto me-auto">
                                <div class="dt-length">
                                    <label for="perPage" class="">per page:</label>
                                    <select name="per_page" id="perPage" class="form-select form-select-sm" onchange="per_page()">
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="200">200</option>
                                        <option value="400">400</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">

                        </div>
                        <div class="col-md-10"></div>
                    </div>

                    <div class="order-container">
                        <div class="table-responsive">
                            <table class="table" id="orderTable">
                                <thead>
                                <tr>
                                    <th> {{localize('SL')}} </th>
                                    <th> {{localize('Date')}} </th>
                                    <th> {{localize('Order by')}} </th>
                                    <th> {{localize('Target')}} </th>
                                    <th> {{localize('Pages')}} </th>
                                    <th> {{localize('Price')}} </th>
                                </tr>
                                </thead>
                                <tbody class="orderTbody">
                                @include("dashboard.partners.orders.orders_table")
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@stop

@push('extra-scripts')
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">

        function ajaxLoader(){
            return `<tr>
                <td colspan="7">
                    <h2 class="text-center"><div class="spinner-border text-success"></div> Data Fetching.....</h2>
                </td>
            </tr>`;
        }

        $(document).ready(function () {


            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();

                let pageHref = $(this).attr("href");

                console.log("Page inside : ", $(this).attr("href"))

                var page = $(this).attr('href').split('page=')[1];

                console.log("Page : ", page)
                fetchPosts(pageHref);
            });

            function fetchPosts(pageHref) {
                $('.orderTbody').html(ajaxLoader());

                $.ajax({
                    method: "get",
                    url: pageHref,
                    dataType: "JSON",
                    success: function (response) {
                        console.log("Response", response.data);
                        $('.orderTbody').html(response.data);
                        // $('.totalDocuments').html(response.optional.totalDocuments);
                        // $('.totalMessages').html(response.optional.totalMessages);
                        // $('.totalAmounts').html(response.optional.totalAmounts);
                    }
                });
            }
        });

        $('#date_search').change(function () {
            var selectedOption = $(this).find('option:selected');
            var startDate = selectedOption.data('start');
            var endDate = selectedOption.data('end');

            $('.orderTbody').html(ajaxLoader());

            $.ajax({
                method: "get",
                url: "{{route('partner.orders')}}?per_page=50&start_date=" + startDate + "&end_date=" + endDate,
                dataType: "JSON",
                success: function (response) {
                    console.log("Response", response.data);
                    $('.orderTbody').html(response.data);
                    $('.totalDocuments').html(response.optional.totalDocuments);
                    $('.totalMessages').html(response.optional.totalMessages);
                    $('.totalAmounts').html(response.optional.totalAmounts);
                }
            });
        });

        function per_page() {
            let page = $('#perPage').val();
            var selectedOption = $('#date_search').find('option:selected');
            var startDate = selectedOption.data('start');
            var endDate = selectedOption.data('end');

            $('.orderTbody').html(ajaxLoader());
            $.ajax({
                method: "get",
                url: "{{route('partner.orders')}}?per_page=" + page + "&start_date=" + startDate + "&end_date=" + endDate,
                dataType: "JSON",
                success: function (response) {
                    console.log("Response", response.data);
                    $('.orderTbody').html(response.data);
                    // $('.totalDocuments').html(response.optional.totalDocuments);
                    // $('.totalMessages').html(response.optional.totalMessages);
                    // $('.totalAmounts').html(response.optional.totalAmounts);
                }
            });
        }

        $(document).ready(function () {

            $('#orderTable').on('click', '.viewdetails', function () {
                var orderId = $(this).attr('data-id');

                if (orderId > 0) {

                    // AJAX request
                    {{--                    var url = "{{ route('admin.order.show', [':orderId']) }}";--}}
                        url = url.replace(':orderId', orderId);

                    // Empty modal data
                    $('#showData').empty();

                    $.ajax({
                        url: url,
                        dataType: 'json',
                        success: function (response) {

                            // Add employee details
                            $('#showData').html(response.html);

                            // Display Modal
                            $('#showModal').modal('show');
                        }
                    });
                }
            });

        });
    </script>
@endpush
