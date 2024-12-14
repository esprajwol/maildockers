@extends('dashboard.layouts.main')

@section('title', dashboardPrefix())
@section('top-header', localize('Welcome to Partner Dashboard'))


@section('content')
    <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="{{asset('dashboard/assets/images/dashboard/circle.svg')}}" class="card-img-absolute"
                        alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">{{localize('Total Orders')}} <i
                            class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">{{ $orderCounts->total_orders }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="{{asset('dashboard/assets/images/dashboard/circle.svg')}}" class="card-img-absolute"
                        alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">{{localize('Last 30 Day\'s Orders')}} <i
                            class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">{{ $orderCounts->last_30_days_orders }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="{{asset('dashboard/assets/images/dashboard/circle.svg')}}" class="card-img-absolute"
                        alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">{{localize('Today\'s Orders')}} <i
                            class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">{{ $orderCounts->today_orders }}</h2>
                </div>
            </div>
        </div>


        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="{{asset('dashboard/assets/images/dashboard/circle.svg')}}" class="card-img-absolute"
                        alt="circle-image" />
                    <h4 class="font-weight-normal mb-3 ">{{localize('Total Documents')}} <i
                            class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5 totalDocuments">{{ $orderCount->count() }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="{{asset('dashboard/assets/images/dashboard/circle.svg')}}" class="card-img-absolute"
                        alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">{{localize('Total Pages')}} <i
                            class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5 totalMessages">{{ $orderCount->sum('total_messages') }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="{{asset('dashboard/assets/images/dashboard/circle.svg')}}" class="card-img-absolute"
                        alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">{{localize('Total Income')}} <i
                            class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5 totalAmounts">{{ round_value($orderCount->sum('paid_amount')) }}</h2>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="dt-length w-25">
                                <label for="perPage" class="">Per Page:</label>
                                <select name="per_page" id="perPage" class="form-select form-select-sm" onchange="per_page()">
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                    <option value="400">400</option>
                                </select>
                            </div>
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

@push('extra-styles')
<style>
table td.img-holder img {
    width: 39px;
    height: 39px;
    padding: 2px;
    border: 1px solid #333;
    border-radius: unset;
}
</style>
@endpush

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
