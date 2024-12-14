

<script>

    document.addEventListener('DOMContentLoaded', function() {
        var orders = @json($orders);
        var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var orderCounts = Array(12).fill(0);
        var paidAmounts = Array(12).fill(0);

        orders.forEach(order => {
            orderCounts[order.month - 1] = order.count;
            paidAmounts[order.month - 1] = order.total_paid;
        });

        var options = {
            chart: {
                type: 'area'
            },
            series: [{
                name: 'xaOrder Counts',
                data: orderCounts
            }, {
                name: 'xaTotal Paid Amount',
                data: paidAmounts
            }],
            xaxis: {
                categories: months
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart1"), options);
        chart.render();
    });

    {{--document.addEventListener('DOMContentLoaded', function() {--}}

    {{--    var earningsOptions = {--}}
    {{--        chart: {--}}
    {{--            type: 'bar',--}}
    {{--            height:280--}}
    {{--        },--}}
    {{--        series: [{--}}
    {{--            name: 'Earnings',--}}
    {{--            data: [{{ $currentYearBenchMarkWithOrderTotal[0] }}, {{ $currentYearBenchMarkWithOrderTotal[1] }}]--}}
    {{--        }],--}}
    {{--        xaxis: {--}}
    {{--            categories: ['Current Year : {{ $currentYearBenchMarkWithOrderTotal[3] }}','Last Year : {{ $currentYearBenchMarkWithOrderTotal[4] }}']--}}
    {{--        },--}}
    {{--       colors: ['#128728', '#775DD0'] // Example colors for each day--}}
    {{--    }--}}


    {{--    var yearEarningsChart = new ApexCharts(document.querySelector("#runningYear"), earningsOptions);--}}
    {{--  //  var yearEarningsBenchmark = new ApexCharts(document.querySelector("#yearEarningsBenchmark"), benchmarkOptions);--}}

    {{--    yearEarningsChart.render();--}}
    {{--  //  yearEarningsBenchmark.render();--}}

    {{--});--}}

</script>
