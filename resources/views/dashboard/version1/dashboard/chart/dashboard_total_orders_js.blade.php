@php
    $year = \Illuminate\Support\Carbon::now()->year;
@endphp

<script>
    console.log("Months : ",@json($ordersData["reports"]->pluck('month')));
    console.log("Order Count : ",@json($ordersData["reports"]->pluck('order_count')));
    console.log("Total Paid : ",@json($ordersData["reports"]->pluck('total_paid')));

    document.addEventListener('DOMContentLoaded', function () {
        var options = {
            series: [
                {
                    name: 'Orders',
                    data: @json($ordersData["reports"]->pluck('order_count'))
                },
                {
                    name: 'Earnings',
                    data: @json($ordersData["reports"]->pluck('total_paid'))
                }
            ],
            chart: {
                type: 'bar',
                height: 350
            },
            // plotOptions: {
            //     bar: {
            //         horizontal: false,
            //         columnWidth: '55%',
            //         endingShape: 'rounded',
            //         dataLabels: {
            //             position: 'top',
            //         }
            //     },
            // },
            plotOptions: {
                bar: {
                    dataLabels: {
                        orientation: 'vertical',
                        position: 'center' // bottom/center/top
                    },
                    minHeight: '550px', // Adjust this value as per your needs
                }
            },
            // dataLabels: {
            //     enabled: false
            // },

            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: @json($ordersData["reports"]->pluck('month')->map(function($month) use ($year) {
                    return \Carbon\Carbon::createFromDate($year, $month)->format('F');
                }))
            },
            fill: {
                opacity: 1
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart1"), options);
        chart.render();
    });

    {{--document.addEventListener('DOMContentLoaded', function() {--}}
    {{--    var ordersData = @json($ordersData);--}}

    {{--    var chartData = [];--}}
    {{--    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];--}}

    {{--    var numberOfYears = {{ $numberOfYears }};--}}
    {{--    var currentYear = new Date().getFullYear();--}}
    {{--    var dataByYear = {};--}}

    {{--    for (var i = 0; i < numberOfYears; i++) {--}}
    {{--        var year = currentYear - i;--}}
    {{--        dataByYear[year.toString()] = Array.from({ length: 12 }, () => 0);--}}
    {{--    }--}}

    {{--    // Populate data structure with actual order counts--}}
    {{--    ordersData.forEach(function(item) {--}}
    {{--        let orderCount = 0;--}}
    {{--        if(item && item.order_count){--}}
    {{--            let orderCount = item.order_count;--}}
    {{--            let year = item.year;--}}
    {{--            let month = item.month - 1;--}}

    {{--            console.log("Orders Data Console Item : ", item,"Order Count : ", orderCount);--}}
    {{--            dataByYear[item.year][month] = 10;--}}
    {{--        }--}}

    {{--        console.log("Orders Data Console : ");--}}
    {{--    });--}}

    {{--    // Prepare chart data in series format--}}
    {{--    var seriesData = [];--}}
    {{--    // for (var year in dataByYear) {--}}
    {{--    //     seriesData.push({--}}
    {{--    //         name: year,--}}
    {{--    //         data: dataByYear[year],--}}
    {{--    //         type: 'line', // Use 'line' type for each year--}}
    {{--    //     });--}}
    {{--    // }--}}

    {{--    // Add an area chart with combined data--}}
    {{--    var combinedData = Array.from({ length: 12 }, () => 0);--}}
    {{--    for (var year in dataByYear) {--}}
    {{--        for (var month = 0; month < 12; month++) {--}}
    {{--            combinedData[month] += dataByYear[year][month];--}}
    {{--        }--}}
    {{--    }--}}

    {{--    seriesData.push({--}}
    {{--        name: 'Orders',--}}
    {{--        data: combinedData,--}}
    {{--        type: 'area',--}}
    {{--    });--}}

    {{--    let monthWiseOrderAmount = {};--}}
    {{--    for (let i = 1; i <= 12; i++) {--}}
    {{--        monthWiseOrderAmount[i] = 0;--}}
    {{--    }--}}

    {{--    ordersData.map(order => {--}}
    {{--        console.log("Order Data : ",order);--}}

    {{--        if (monthWiseOrderAmount.hasOwnProperty(order.month)) {--}}
    {{--            monthWiseOrderAmount[order.month] =  (order.total_income).toFixed(2);--}}
    {{--        }--}}
    {{--    })--}}

    {{--    console.log(" Month wise data is : ",monthWiseOrderAmount);--}}

    {{--    seriesData.push({--}}
    {{--        name: 'Earning',--}}
    {{--        data: Object.values(monthWiseOrderAmount),--}}
    {{--        type: 'area',--}}
    {{--    });--}}


    {{--    console.log(" Month wise data is : ",monthWiseOrderAmount);--}}

    {{--    var options = {--}}
    {{--        chart: {--}}
    {{--            type: 'line',--}}
    {{--            height: 280,--}}
    {{--            stacked: false,--}}
    {{--        },--}}
    {{--        colors: ["#87262a", "#ceb46b", ],--}}
    {{--        series: seriesData,--}}
    {{--        xaxis: {--}}
    {{--            categories: months,--}}
    {{--            title: {--}}
    {{--                text: 'Months'--}}
    {{--            }--}}
    {{--        },--}}
    {{--        yaxis: {--}}
    {{--            title: {--}}
    {{--                text: 'Total Orders: ' + {{ $orderCounts->total_orders }},--}}
    {{--            },--}}
    {{--        },--}}
    {{--        tooltip: {--}}
    {{--            shared: true,--}}
    {{--            intersect: false,--}}
    {{--            y: {--}}
    {{--                formatter: function (val) {--}}
    {{--                    return val + " orders";--}}
    {{--                }--}}
    {{--            }--}}
    {{--        },--}}
    {{--        legend: {--}}
    {{--            position: 'top',--}}
    {{--            horizontalAlign: 'left',--}}
    {{--            offsetY: -20--}}
    {{--        }--}}
    {{--    };--}}

    {{--    var chart = new ApexCharts(document.querySelector("#chart1"), options);--}}
    {{--    chart.render();--}}
    {{--});--}}
</script>
