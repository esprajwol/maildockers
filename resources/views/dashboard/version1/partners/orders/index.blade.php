@extends('dashboard.version1.layouts.main')

@section('title', ' - Order Lists')


@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header">
                    {{-- <h3>{{ localize('payments') }}</h3> --}}
                </div>
                <div class="card-body">
                    <div class="mb-3 d-flex align-items-start justify-content-between">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card custom-card">
                                    <div class="top-left"></div>
                                    <div class="top-right"></div>
                                    <div class="bottom-left"></div>
                                    <div class="bottom-right"></div>
                                    <div class="card-body">
                                        <span class="text-fixed-white fs-11">{{ localize('todays') }}</span>
                                        <h4 class="text-fixed-white mb-0">
                                            {{ number_format($totalIncomeofToday) }} {{$currencyCode}}
                                        </h4>
                                        <p>
                                            @if ($dayBenchMarkWithPaidAmount < 0)
                                                <span class="text-danger fs-12 ms-2 fw-semibold">
                                                    <i class="ti ti-trending-down align-middle me-1 d-inline-block"></i>
                                                    {{ number_format($dayBenchMarkWithPaidAmount * -1, 2) }}% {{ localize('from_yesterday') }}
                                                </span>
                                            @else
                                                <span class="text-success fs-12 fw-semibold d-inline-block">
                                                    <i class="ti ti-trending-up align-middle me-1 d-inline-block"></i>
                                                    {{ number_format($dayBenchMarkWithPaidAmount, 2) }}% {{ localize('from_yesterday') }}
                                                </span>
                                            @endif
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card custom-card">
                                    <div class="top-left"></div>
                                    <div class="top-right"></div>
                                    <div class="bottom-left"></div>
                                    <div class="bottom-right"></div>
                                    <div class="card-body">
                                        <span class="text-fixed-white fs-11">{{ 'yesterday' }}</span>
                                        <h4 class="text-fixed-white mb-0">
                                            {{ number_format($totalIncomeOfYesterday) }} {{$currencyCode}}
                                        </h4>
                                        <p>
                                            @if ($yesterdayBenchMarkWithPaidAmount < 0)
                                                <span class="text-danger fs-12 ms-2 fw-semibold">
                                                    <i class="ti ti-trending-down align-middle me-1 d-inline-block"></i>
                                                    {{ number_format($yesterdayBenchMarkWithPaidAmount * -1, 2) }}% {{ localize('from_day_before_yesterday') }}
                                                </span>
                                            @else
                                                <span class="text-success fs-12 fw-semibold d-inline-block">
                                                    <i class="ti ti-trending-up align-middle me-1 d-inline-block"></i>
                                                    {{ number_format($yesterdayBenchMarkWithPaidAmount, 2) }}% {{ localize('from_day_before_yesterday') }}
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card custom-card">
                                    <div class="top-left"></div>
                                    <div class="top-right"></div>
                                    <div class="bottom-left"></div>
                                    <div class="bottom-right"></div>
                                    <div class="card-body">
                                        <span class="text-fixed-white fs-11">{{ localize('last_week') }}</span>
                                        <h4 class="text-fixed-white mb-0">
                                            {{ number_format($totalIncomeOfLastWeek) }} {{$currencyCode}}
                                        </h4>
                                        <p>
                                            @if ($weekBenchMarkWithPaidAmount < 0)
                                                <span class="text-danger fs-12 ms-2 fw-semibold">
                                                    <i class="ti ti-trending-down align-middle me-1 d-inline-block"></i>
                                                    {{ number_format($weekBenchMarkWithPaidAmount * -1, 2) }}% {{ localize('from_previous_week') }}
                                                </span>
                                            @else
                                                <span class="text-success fs-12 fw-semibold d-inline-block">
                                                    <i class="ti ti-trending-up align-middle me-1 d-inline-block"></i>
                                                    {{ number_format($weekBenchMarkWithPaidAmount, 2) }}% {{ localize('from_previous_week') }}
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                           <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                               <div class="card custom-card">
                                   <div class="top-left"></div>
                                   <div class="top-right"></div>
                                   <div class="bottom-left"></div>
                                   <div class="bottom-right"></div>
                                   <div class="card-body">
                                       <span class="text-fixed-white fs-11">{{ localize('this_month') }}</span>
                                       <h4 class="text-fixed-white mb-0">
                                           {{ number_format($totalIncomeOfThisMonth) }} {{$currencyCode}}
                                       </h4>
                                       <p>
                                           @if ($monthBenchMarkWithPaidAmount < 0)
                                               <span class="text-danger fs-12 ms-2 fw-semibold">
                                                   <i class="ti ti-trending-down align-middle me-1 d-inline-block"></i>
                                                   {{ number_format($monthBenchMarkWithPaidAmount * -1, 2) }}% {{ localize('from_last_month') }}
                                               </span>
                                           @else
                                               <span class="text-success fs-12 fw-semibold d-inline-block">
                                                   <i class="ti ti-trending-up align-middle me-1 d-inline-block"></i>
                                                   {{ number_format($monthBenchMarkWithPaidAmount, 2) }}% {{ localize('from_last_month') }}
                                               </span>
                                           @endif
                                       </p>
                                   </div>
                               </div>
                           </div>

                            {{-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card custom-card">
                                    <div class="top-left"></div>
                                    <div class="top-right"></div>
                                    <div class="bottom-left"></div>
                                    <div class="bottom-right"></div>
                                    <div class="card-body">
                                        <span class="text-fixed-white fs-11">{{ localize('last_12_months') }}</span>
                                        <h4 class="text-fixed-white mb-0">
                                            {{number_format($currentYearBenchMarkWithOrderTotal['5'])}} {{$currencyCode}}
                                        </h4>
                                        <p>
                                            @if ($currentYearBenchMarkWithOrderTotal[2] < 0)
                                                <span class="text-danger fs-12 ms-2 fw-semibold">
                                                    <i class="ti ti-trending-down align-middle me-1 d-inline-block"></i>
                                                    {{ number_format($currentYearBenchMarkWithOrderTotal[2] * -1, 2) }}% {{ localize('from_last_year') }}
                                                </span>
                                            @else
                                                <span class="text-success fs-12 fw-semibold d-inline-block">
                                                    <i class="ti ti-trending-up align-middle me-1 d-inline-block"></i>
                                                    {{ number_format($currentYearBenchMarkWithOrderTotal[2], 2) }}% {{ localize('from_last_year') }}
                                                </span>
                                            @endif
                                        </p>

                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card custom-card">
                <div class="card-body">
                    <h3 for="perPage" class="">{{ localize('payment_list') }}</h3>
                    <div class="row mb-3">
                        <div class="col-md-2 col-xl-2 col-lg-2 col-md-6 col-sm-6 col-12">
                            <div class="col-md-auto me-auto">
                                <div class="dt-length">
                                    <label for="perPage" class="">{{ localize('per_page_collon') }}</label>
                                    <select name="per_page" id="perPage" class="form-select form-select-sm"
                                        onchange="per_page()">
                                        <option value="50">{{ localize('50') }}</option>
                                        <option value="100">{{ localize('100') }}</option>
                                        <option value="200">{{ localize('200') }}</option>
                                        <option value="400">{{ localize('400') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-5 col-lg-5 col-md-6 col-sm-6 col-12 text-right ">
                            <div class="search-section">
                                <label>{{ localize('select_quick_type') }}</label>

                                <select name="date_search" id="date_search" class="form-select form-select-sm">
                                    <option value="1" data-start="{{ getStartAndEndDate(0)[0] }}"
                                        data-end="{{ getStartAndEndDate(0)[1] }}">
                                        {{ localize('today') }}
                                    </option>
                                    <option value="1" data-start="{{ getStartAndEndDate(1)[0] }}"
                                        data-end="{{ getStartAndEndDate(1)[1] }}">
                                        {{ localize('yesterday') }}
                                    </option>
                                    <option value="1" data-start="{{ getStartAndEndDate(7)[0] }}"
                                        data-end="{{ getStartAndEndDate(7)[1] }}">
                                        {{ localize('last_week') }}
                                    </option>
                                    <option value="1"
                                        data-start="{{ \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d') }}"
                                        data-end="{{ getStartAndEndDate(1, 2)[1] }}">
                                        {{ localize('this_month') }}
                                    </option>

                                    <option value="1"
                                        data-start="{{ \Carbon\Carbon::now()->subMonth(12)->format('Y-m-d') }}"
                                        data-end="{{ getStartAndEndDate(12, 2)[1] }}">
                                        {{ localize('last_12_months') }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-5 col-lg-5 col-md-6 col-sm-6 col-12 text-right ">
                            <label for="">{{ localize('select_date_range') }}</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text text-muted">
                                        <i class="ri-calendar-line"></i>
                                    </div>
                                    <input type="text" class="form-control flatpickr-input active" id="daterange"
                                        placeholder="Date range picker" readonly="readonly">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="order-container">
                        <div class="table-responsive">
                            <table class="table" id="orderTable">
                                <thead>
                                    <tr>
                                        <th> {{ localize('sl') }} </th>
                                        <th> {{ localize('date') }} </th>
                                        <th> {{ localize('order_by') }} </th>
                                        <th> {{ localize('target') }} </th>
                                        <th> {{ localize('messages') }} </th>
                                        <th> {{ localize('price') }} </th>
                                    </tr>
                                </thead>
                                <tbody class="orderTbody">
                                    @include('dashboard.partners.orders.orders_table')
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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script type="text/javascript">
        function ajaxLoader() {
            return `<tr>
                <td colspan="7">
                    <h2 class="text-center"><div class="spinner-border text-success"></div> {{ localize('data_fetching') }}</h2>
                </td>
            </tr>`;
        }

        $(document).ready(function() {
            /* For Date Range Picker */
            flatpickr("#daterange", {
                mode: "range",
                dateFormat: "Y-m-d",
                onClose: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length === 2) {
                        const startDate = instance.formatDate(selectedDates[0], "Y-m-d");
                        const endDate = instance.formatDate(selectedDates[1], "Y-m-d");

                        dateRangeOrders(startDate, endDate);
                    }
                }
            });

            $(document).on('click', '.pagination a', function(event) {
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
                    success: function(response) {
                        console.log("Response", response.data);
                        $('.orderTbody').html(response.data);
                        // $('.totalDocuments').html(response.optional.totalDocuments);
                        // $('.totalMessages').html(response.optional.totalMessages);
                        // $('.totalAmounts').html(response.optional.totalAmounts);
                    }
                });
            }
        });

        function dateRangeOrders(startDate, endDate) {

            $('.orderTbody').html(ajaxLoader());

            $.ajax({
                method: "get",
                url: "{{ route('partner.orders') }}?per_page=50&start_date=" + startDate + "&end_date=" + endDate,
                dataType: "JSON",
                success: function(response) {
                    console.log("Response", response.data);
                    $('.orderTbody').html(response.data);
                }
            });
        }

        $('#date_search').change(function() {
            var selectedOption = $(this).find('option:selected');
            var startDate = selectedOption.data('start');
            var endDate = selectedOption.data('end');

            $('.orderTbody').html(ajaxLoader());

            $.ajax({
                method: "get",
                url: "{{ route('partner.orders') }}?per_page=50&start_date=" + startDate + "&end_date=" +
                    endDate,
                dataType: "JSON",
                success: function(response) {
                    console.log("Response", response.data);
                    $('.orderTbody').html(response.data);
                    // $('.totalDocuments').html(response.optional.totalDocuments);
                    // $('.totalMessages').html(response.optional.totalMessages);
                    // $('.totalAmounts').html(response.optional.totalAmounts);
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
                url: "{{ route('partner.orders') }}?per_page=" + page + "&start_date=" + startDate + "&end_date=" +
                    endDate,
                dataType: "JSON",
                success: function(response) {
                    console.log("Response on load", response.data);
                    $('.orderTbody').html(response.data);
                    // $('.totalDocuments').html(response.optional.totalDocuments);
                    // $('.totalMessages').html(response.optional.totalMessages);
                    // $('.totalAmounts').html(response.optional.totalAmounts);
                }
            });
        }

        $(document).ready(function() {

            $('#orderTable').on('click', '.viewdetails', function() {
                var orderId = $(this).attr('data-id');

                if (orderId > 0) {

                    // AJAX request
                    {{--                    var url = "{{ route('admin.order.show', [':orderId']) }}"; --}}
                    url = url.replace(':orderId', orderId);

                    // Empty modal data
                    $('#showData').empty();

                    $.ajax({
                        url: url,
                        dataType: 'json',
                        success: function(response) {

                            // Add employee details
                            $('#showData').html(response.html);

                            // Display Modal
                            $('#showModal').modal('show');
                        }
                    });
                }
            });
            per_page();
        });
    </script>
@endpush
