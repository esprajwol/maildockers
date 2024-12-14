@extends('dashboard.version1.layouts.main')

@section('title', ' - Refund Requests')


@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header">
                    <h3>Failed Order Refund Requests</h3>
                </div>
            </div>
            <div class="card custom-card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-2 col-xl-2 col-lg-2 col-md-6 col-sm-6 col-12">
                            <div class="col-md-auto me-auto">
                                <div class="dt-length">
                                    <label for="perPage" class="">Per Page:</label>
                                    <select name="per_page" id="perPage" class="form-select form-select-sm"
                                        onchange="per_page()">
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="200">200</option>
                                        <option value="400">400</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-5 col-lg-5 col-md-6 col-sm-6 col-12 text-right ">
                            <div class="search-section">
                                <label>Select Status</label>

                                <select name="status" id="status_filter" class="form-select form-select-sm">
                                    <option value="" selected> All </option>
                                    @foreach($refund_status_list as $status)
                                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}> {{ $status }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="order-container">
                        <div class="table-responsive">
                            <table class="table" id="orderTable">
                                <thead>
                                    <tr>
                                        <th> {{ localize('sl') }} </th>
                                        <th> {{ localize('order_date') }} </th>
                                        <th> {{ localize('requested_date') }} </th>
                                        <th> {{ localize('requested_by') }} </th>
                                        <th> {{ localize('target') }} </th>
                                        <th> {{ localize('messages') }} </th>
                                        <th> {{ localize('status') }} </th>
                                        <th> {{ localize('action') }} </th>
                                    </tr>
                                </thead>
                                <tbody class="orderTbody">
                                    @include('dashboard.partners.order_refund.order_refund_table')
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
                    <h2 class="text-center"><div class="spinner-border text-success"></div> Data Fetching.....</h2>
                </td>
            </tr>`;
        }

        $(document).ready(function() {
            $(document).on('click', '.pagination a', function(event) {
                event.preventDefault();

                let pageHref = $(this).attr("href");

                console.log("Page inside : ", $(this).attr("href"))

                var page = $(this).attr('href').split('page=')[1];

                console.log("Page : ", page)
                fetchPosts(pageHref);
            });

            $('#status_filter').change(function () {
                var selectedOption = $(this).find('option:selected').val();
                if(!selectedOption || selectedOption.length == 0) selectedOption = "";
                let page = $('#perPage').val();
                $('.orderTbody').html(ajaxLoader());
                $.ajax({
                    method: "get",
                    url: "{{ route('partner.order_refund_requests') }}?per_page=" + page + "&status_filter=" + selectedOption,
                    dataType: "JSON",
                    success: function (response) {
                        console.log("Response", response.data);
                        $('.orderTbody').html(response.data);
                    }
                });

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
                    }
                });
            }
        });


        function per_page() {
            let page = $('#perPage').val();
            var selectedOption = $('#status_filter').find('option:selected');

            $('.orderTbody').html(ajaxLoader());
            $.ajax({
                method: "get",
                url: "{{ route('partner.order_refund_requests') }}?per_page=" + page + "&status=" + selectedOption,
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
