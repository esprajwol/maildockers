
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let daysOfWeek   = @json($currentWeekOrders[0]);
        let orderCounts  = @json($currentWeekOrders[1]);
        let total_order  = @json($currentWeekOrders[2]);
        let total_income = @json($currentWeekOrders[3]);

        let colors = ['#FF4560', '#00E396', '#FEB019', '#008FFB', '#775DD0', '#FF7F00', '#00BFFF']; // Example colors for each day

        var options = {
            series: [{
                name: 'Total Order',
                type: 'column',
                data: orderCounts  // Update with your data for each day
            }, {
                name: 'Total Income',
                type: 'line',
                data: total_income  // Update with your data for each day
            }],
            chart: {
                height: 280,
                type: 'line',
            },
            stroke: {
                width: [0, 4]
            },
            title: {
                text: 'This Week Report'
            },
            dataLabels: {
                enabled: true,
                enabledOnSeries: [1]
            },
            labels: daysOfWeek,  // Update with days of the week
            xaxis: {
                type: 'category'
            },

        };

        var chart = new ApexCharts(document.querySelector("#chart7Days"), options);
        chart.render();

    });
</script>
