<script>
    "use strict";

    // Initialize the chart with empty data
    var orderOptions = {
        chart: {
            type: 'area',
            height:450
        },
        series: [{
            name: 'Orders',
            data: []
        }],

        xaxis: {
            categories: []
        }
    };

    var revenueOptions = {
        chart: {
            type: 'area',
            height:450
        },
        series: [{
            name: 'Earning',
            data: []
        }],
        xaxis: {
            categories: []
        }
    };

    var chart = new ApexCharts(document.querySelector("#grandChart"), orderOptions);
    var revenueGrandChart = new ApexCharts(document.querySelector("#revenueGrandChart"), revenueOptions);

    $(document).ready(function() {

        // Order Analytics
        chart.render();

        // Revenue
        revenueGrandChart.render();

        /* For Date Range Picker */
        flatpickr("#daterange", {
            mode: "range",
            dateFormat: "Y-m-d",
            onClose: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 2) {
                    const startDate = instance.formatDate(selectedDates[0], "Y-m-d");
                    const endDate = instance.formatDate(selectedDates[1], "Y-m-d");

                  //  alert("Start Date : "+startDate+" End Date : "+endDate);
                    // const startDate = selectedDates[0].toISOString().split('T')[0];
                    // const endDate = selectedDates[1].toISOString().split('T')[0];
                    fetchReport("dateRange", startDate, endDate);
                }
            }
        });



        let reportType = "today";

        fetchReport(reportType);

        // Update report based on dropdown selection
        $('#reportType').change(function() {
            var reportType = $(this).val();
            fetchReport(reportType);
        });
    });

    // Fetch and update the chart data
    function fetchReport(reportType, startDate = null, endDate = null) {

        $.ajax({
            url: '{{ route(currentRoute()) }}',
            method: 'GET',
            data: { type: reportType, start_date : startDate, end_date : endDate },
            success: function(response) {
                console.log("Response Data : ", response);

                if(reportType == "dateRange") {
                    var orders = response.orders;
                    var dates  = orders.map(order => order.date);
                    var counts = orders.map(order => order.count);
                    var totals = orders.map(order => order.total_paid.toFixed(2));

                    let totalCounts = 0;

                    orders.map(function(order){
                        totalCounts = Number(totalCounts)+Number(order.count)
                    });

                    $(".totalOrders").text(totalCounts);

                    chart.updateSeries([
                        {
                            name: 'Order Count',
                            data: counts
                        }
                    ]);


                    chart.updateOptions({
                        xaxis: {
                            categories: dates
                        },
                        title: {
                            text: response.title,
                            align: 'center', // Optional: to align the title
                            style: {
                                fontSize: '10px', // Optional: to style the title
                                color: '#263238' // Optional: to set the color
                            }
                        }
                    });

                    revenueGrandChart.updateSeries([
                        {
                            name: 'Earnings',
                            data: totals

                        }
                    ]);

                    revenueGrandChart.updateOptions({
                        xaxis: {
                            categories: dates
                        },
                        title: {
                            text: response.title,
                            align: 'center', // Optional: to align the title
                            style: {
                                fontSize: '10px', // Optional: to style the title
                                color: '#263238' // Optional: to set the color
                            }
                        }
                    });
                }
                else{
                   let totalOrders = 0;

                    response.orderCounts.map(function(item, index) {
                        totalOrders += Number(item);
                        console.log("Response Data : ", item, index);
                    });

                    $(".totalOrders").text(totalOrders);


                    let totalRevenue = 0;
                    response.data.map(function(item, index) {
                        totalRevenue += Number(item);
                        console.log("Revenue Data : ", item, index);
                    });

                    $(".totalEarnings").text(totalRevenue.toFixed(2));

                    let benchMark = response.benchMark;
                    setBenchMark(benchMark);

                    let earningBenchmark = response.earningBenchmark;
                    setBenchMark(earningBenchmark,'customReportRevenueBenchMark');

                    // Order Analytics
                    chart.updateSeries([
                        {
                            name: 'Series 1 - Orders',
                            data: response.orderCounts
                        },
                        {
                            name: 'Series 2 - Orders',
                            data: response.pastOrderCounts
                        }
                    ]);

                    chart.updateOptions({
                        xaxis: {
                            categories: response.categories
                        },
                        title: {
                            text: response.title,
                            align: 'center', // Optional: to align the title
                            style: {
                                fontSize: '10px', // Optional: to style the title
                                color: '#263238' // Optional: to set the color
                            }
                        }
                    });

                    //updateOrderAnalytics(response, chart);

                    // Update Revenue
                    revenueGrandChart.updateSeries([
                        {
                            name: 'Series 1 - Order Amount',
                            data: response.data

                        },
                        {
                            name: 'Series 2 - Order Amount',
                            data: response.pastData

                        }
                    ]);

                    revenueGrandChart.updateOptions({
                        xaxis: {
                            categories: response.categories
                        },
                        title: {
                            text: response.title,
                            align: 'center', // Optional: to align the title
                            style: {
                                fontSize: '10px', // Optional: to style the title
                                color: '#263238' // Optional: to set the color
                            }
                        }
                    });
                    //updateRevenueAnalytics(response, revenueGrandChart);
                }
            }
        });
    }

    function updateOrderAnalytics(response, orderAnalyticsChart){
        console.log("Response from Order Analytics", response);
        console.log("Series 1 ", response.data);
        console.log("Series 2 ", response.pastData);

        orderAnalyticsChart.updateSeries([
            {
                name: 'Series 1 - Orders',
                data: response.data
            },
            {
                name: 'Series 2 - Orders',
                data: response.pastData
            }
        ]);

        orderAnalyticsChart.updateOptions({
            xaxis: {
                categories: response.categories
            }
        });
    }


    function updateRevenueAnalytics(response, revenueGrandChart){
        console.log("Response from Revenue Analytics", response);

        revenueGrandChart.updateSeries([
            {
                name: 'Series 1 - Order Amount',
                data: response.orderCounts
            },
            {
                name: 'Series 2 - Order Amount',
                data: response.pastOrderCounts
            }
        ]);

        revenueGrandChart.updateOptions({
            xaxis: {
                categories: response.categories
            }
        });
    }


    function updateDateRangeChart(response, chart){
        var orders = response.orders;
        var dates  = orders.map(order => order.date);
        var counts = orders.map(order => order.count);
        var totals = orders.map(order => order.total_paid);

        chart.updateSeries([
            {
                name: 'Order Amount',
                data: totals.toFixed(2)
            },
            {
                name: 'Order Count',
                data: counts
            }
        ]);

        chart.updateOptions({
            xaxis: {
                categories: dates
            }
        });

    }

    function setBenchMark(benchMark, className = "customReportBenchMark") {
        let benchMarkHTML = '';

        if(benchMark > 0) {
            benchMarkHTML = `<span class="text-success d-inline-block fs-12 ms-2 fw-semibold customReportBenchMark">
                            <i class="ti ti-trending-up align-middle me-1"></i>
                            ${benchMark.toFixed(2)} %
                        </span>`;
        } else {
            benchMarkHTML = `<span class="text-danger d-inline-block fs-12 ms-2 fw-semibold customReportBenchMark">
                            <i class="ti ti-trending-down align-middle me-1"></i>
                            ${benchMark.toFixed(2)} %
                        </span>`;
        }

        $(`.${className}`).html(benchMarkHTML);
    }

    function getTotalOrders(response){
        let totalOrders = 0

        return response.orderCounts.map(function(item, index) {
            totalOrders += Number(item);
            console.log("Response Data : ", item, index);
        });
    }


</script>
