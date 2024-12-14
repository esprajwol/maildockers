

<script type="text/javascript">

    {{--document.addEventListener('DOMContentLoaded', function () {--}}
    {{--    var options2 = {--}}
    {{--        chart: {--}}
    {{--            type: 'bar',--}}
    {{--            height: 280--}}
    {{--        },--}}
    {{--        series: [{--}}
    {{--            name: 'LastMonthOrders',--}}
    {{--            data: @json($chartOrders->pluck('orders'))--}}
    {{--        }, {--}}
    {{--            name: 'prevMonth',--}}
    {{--            data: @json($chartOrders->pluck('prevOrders')),--}}
    {{--            color:'#00ff22'--}}
    {{--            // Set the color for previous month bars--}}

    {{--        }],--}}
    {{--        xaxis: {--}}
    {{--            categories: @json($chartOrders->pluck('day')),--}}
    {{--            title: {--}}
    {{--                text: 'Days'--}}
    {{--            }--}}
    {{--        },--}}
    {{--        yaxis: {--}}
    {{--            title: {--}}
    {{--                text: 'Number of Orders'--}}
    {{--            }--}}
    {{--        },--}}
    {{--        dataLabels: {--}}
    {{--            offsetY: -20,--}}
    {{--            style: {--}}
    {{--                fontSize: '12px',--}}
    {{--                colors: ["#fff"]--}}
    {{--            }--}}
    {{--        },--}}
    {{--        plotOptions: {--}}
    {{--            bar: {--}}
    {{--                dataLabels: {--}}
    {{--                    position: 'top' // Position the label at the top--}}
    {{--                }--}}
    {{--            }--}}
    {{--        },--}}
    {{--        colors: ['#0feaaf'] // Default bar color for other series--}}
    {{--    };--}}

    {{--    var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);--}}
    {{--    chart2.render();--}}

    {{--    /*total report or chart1*/--}}
    {{--    --}}{{--var options1 = {--}}
    {{--    --}}{{--    series: [{--}}
    {{--    --}}{{--        name: 'thisYearOrders',--}}
    {{--    --}}{{--        data: @json($yearlyTotalReport->toArray())--}}
    {{--    --}}{{--    }],--}}
    {{--    --}}{{--    chart: {--}}
    {{--    --}}{{--        type: 'area',--}}
    {{--    --}}{{--        height: 200--}}
    {{--    --}}{{--    },--}}
    {{--    --}}{{--    xaxis: {--}}
    {{--    --}}{{--        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],--}}
    {{--    --}}{{--        title: {--}}
    {{--    --}}{{--            text: 'Months'--}}
    {{--    --}}{{--        }--}}
    {{--    --}}{{--    },--}}
    {{--    --}}{{--    yaxis: {--}}
    {{--    --}}{{--        title: {--}}
    {{--    --}}{{--            text: 'Number of Orders'--}}
    {{--    --}}{{--        }--}}
    {{--    --}}{{--    },--}}
    {{--    --}}{{--    title: {--}}
    {{--    --}}{{--        text: 'Monthly Orders Report for ' + new Date().getFullYear(),--}}
    {{--    --}}{{--        align: 'left'--}}
    {{--    --}}{{--    },--}}
    {{--    --}}{{--    fill: {--}}
    {{--    --}}{{--        type: 'gradient',--}}
    {{--    --}}{{--        gradient: {--}}
    {{--    --}}{{--            shadeIntensity: 1,--}}
    {{--    --}}{{--            inverseColors: false,--}}
    {{--    --}}{{--            opacityFrom: 0.5,--}}
    {{--    --}}{{--            opacityTo: 0--}}
    {{--    --}}{{--        }--}}
    {{--    --}}{{--    }--}}
    {{--    --}}{{--};--}}

    {{--    --}}{{--var chart1 = new ApexCharts(document.querySelector("#chart1"), options1);--}}
    {{--    --}}{{--chart1.render();--}}

    {{--    // New--}}

    {{--}); // Document Content Loaded Close Here--}}

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
            }
        });
    }

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
