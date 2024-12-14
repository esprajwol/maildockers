<script>
    document.addEventListener('DOMContentLoaded', function () {
        var options2 = {
            chart: {
                type: 'line',
                height: 380
            },
            series: [
                {
                    name: 'Current Month Orders',
                    data: @json($chartOrders->pluck('orders')),
                    color:'#650cab',

                },
                {
                    name: 'Current Month Earnings',
                    data: @json($chartOrders->pluck('total_earnings')),
                    color:'#de07da',
                    type:"column"
                },

                {{--{--}}
                {{--    name: 'Last Month Orders',--}}
                {{--    data: @json($chartOrders->pluck('prevOrders')),--}}
                {{--    color:'#27e014',--}}
                {{--},--}}
                {{--{--}}
                {{--    name: 'Last Month Earnings',--}}
                {{--    data: @json($chartOrders->pluck('prev_total_earnings')),--}}
                {{--    color:'#07b089',--}}
                {{--    type:"column"--}}
                {{--},--}}
            ],
            xaxis: {
                categories: @json($chartOrders->pluck('day')),
                title: {
                    text: 'Days'
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val.toFixed(0);
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '80%',
                    endingShape: 'rounded'
                }
            },
            stroke: {
                colors: ["transparent"],
                width: 5
            }
        };

        var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
        chart2.render();
    });
</script>
